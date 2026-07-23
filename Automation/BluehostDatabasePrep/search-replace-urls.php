<?php
/**
 * Serialize-aware URL search/replace for a WordPress MySQL database (CLI).
 *
 * Usage:
 *   php search-replace-urls.php --host=localhost --user=root --pass= --db=NAME \
 *     --from=http://localhost/yoursite --to=https://www.example.com
 */

if ( PHP_SAPI !== 'cli' ) {
	fwrite( STDERR, "CLI only.\n" );
	exit( 1 );
}

$opts = getopt( '', array( 'host:', 'user:', 'pass::', 'db:', 'from:', 'to:', 'dry-run' ) );
foreach ( array( 'host', 'user', 'db', 'from', 'to' ) as $req ) {
	if ( empty( $opts[ $req ] ) ) {
		fwrite( STDERR, "Missing --$req\n" );
		exit( 1 );
	}
}

$host = $opts['host'];
$user = $opts['user'];
$pass = array_key_exists( 'pass', $opts ) ? (string) $opts['pass'] : '';
$db   = $opts['db'];
$from = rtrim( $opts['from'], '/' );
$to   = rtrim( $opts['to'], '/' );
$dry  = array_key_exists( 'dry-run', $opts );

$from_variants = array_values(
	array_unique(
		array(
			$from,
			preg_replace( '#^https:#', 'http:', $from ),
			preg_replace( '#^http:#', 'https:', $from ),
			preg_replace( '#^https?:#', '', $from ),
		)
	)
);
$to_scheme_less = preg_replace( '#^https?:#', '', $to );

$mysqli = @new mysqli( $host, $user, $pass, $db );
if ( $mysqli->connect_error ) {
	fwrite( STDERR, 'Connect failed: ' . $mysqli->connect_error . "\n" );
	exit( 1 );
}
$mysqli->set_charset( 'utf8mb4' );

/**
 * @param mixed $data
 * @return mixed
 */
function ges_replace_in_data( $data, array $from_variants, $to, $to_scheme_less ) {
	if ( is_string( $data ) ) {
		$out = $data;
		foreach ( $from_variants as $f ) {
			if ( $f === '' ) {
				continue;
			}
			$replacement = ( strpos( $f, '//' ) === 0 ) ? $to_scheme_less : $to;
			$out         = str_replace( $f, $replacement, $out );
			$out         = str_replace( str_replace( '/', '\\/', $f ), str_replace( '/', '\\/', $replacement ), $out );
		}
		return $out;
	}
	if ( is_array( $data ) ) {
		foreach ( $data as $k => $v ) {
			$data[ $k ] = ges_replace_in_data( $v, $from_variants, $to, $to_scheme_less );
		}
		return $data;
	}
	if ( is_object( $data ) ) {
		foreach ( get_object_vars( $data ) as $k => $v ) {
			$data->$k = ges_replace_in_data( $v, $from_variants, $to, $to_scheme_less );
		}
		return $data;
	}
	return $data;
}

/**
 * @param string $value
 * @return string
 */
function ges_replace_value( $value, array $from_variants, $to, $to_scheme_less ) {
	if ( $value === '' || $value === null ) {
		return $value;
	}

	$un = @unserialize( $value );
	if ( $un !== false || $value === 'b:0;' ) {
		$replaced = ges_replace_in_data( $un, $from_variants, $to, $to_scheme_less );
		return serialize( $replaced );
	}

	// JSON
	if ( ( $value[0] === '{' || $value[0] === '[' ) ) {
		$json = json_decode( $value, true );
		if ( json_last_error() === JSON_ERROR_NONE && ( is_array( $json ) || is_object( $json ) ) ) {
			$replaced = ges_replace_in_data( $json, $from_variants, $to, $to_scheme_less );
			return wp_json_encode_compat( $replaced );
		}
	}

	return ges_replace_in_data( $value, $from_variants, $to, $to_scheme_less );
}

function wp_json_encode_compat( $data ) {
	return json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
}

$tables_res = $mysqli->query( 'SHOW TABLES' );
$tables     = array();
while ( $row = $tables_res->fetch_row() ) {
	$tables[] = $row[0];
}

$changed_rows = 0;
$scanned_cols = 0;

foreach ( $tables as $table ) {
	$cols_res = $mysqli->query( "SHOW COLUMNS FROM `$table`" );
	$text_cols = array();
	$pk_cols   = array();
	while ( $col = $cols_res->fetch_assoc() ) {
		$type = strtolower( $col['Type'] );
		if ( preg_match( '/char|text|blob|json/', $type ) ) {
			$text_cols[] = $col['Field'];
		}
		if ( $col['Key'] === 'PRI' ) {
			$pk_cols[] = $col['Field'];
		}
	}
	if ( ! $text_cols || ! $pk_cols ) {
		continue;
	}

	$select_cols = array_unique( array_merge( $pk_cols, $text_cols ) );
	$col_sql     = '`' . implode( '`,`', $select_cols ) . '`';
	$result = $mysqli->query( "SELECT $col_sql FROM `$table`" );
	if ( ! $result ) {
		fwrite( STDERR, "Skip $table: " . $mysqli->error . "\n" );
		continue;
	}

	$pending = array();
	while ( $row = $result->fetch_assoc() ) {
		$updates = array();
		foreach ( $text_cols as $field ) {
			$original = $row[ $field ];
			if ( $original === null || $original === '' ) {
				continue;
			}
			$scanned_cols++;
			$contains = false;
			foreach ( $from_variants as $f ) {
				if ( $f !== '' && strpos( $original, $f ) !== false ) {
					$contains = true;
					break;
				}
			}
			if ( ! $contains ) {
				continue;
			}
			$new_val = ges_replace_value( $original, $from_variants, $to, $to_scheme_less );
			if ( $new_val !== $original ) {
				$updates[ $field ] = $new_val;
			}
		}
		if ( $updates ) {
			$pending[] = array(
				'updates' => $updates,
				'row'     => $row,
			);
		}
	}
	$result->free();

	foreach ( $pending as $item ) {
		$changed_rows++;
		if ( $dry ) {
			continue;
		}
		$set_parts = array();
		foreach ( $item['updates'] as $field => $val ) {
			$set_parts[] = '`' . $field . '`=\'' . $mysqli->real_escape_string( $val ) . '\'';
		}
		$where_parts = array();
		foreach ( $pk_cols as $pk ) {
			$where_parts[] = '`' . $pk . '`=\'' . $mysqli->real_escape_string( $item['row'][ $pk ] ) . '\'';
		}
		$sql = 'UPDATE `' . $table . '` SET ' . implode( ',', $set_parts ) . ' WHERE ' . implode( ' AND ', $where_parts );
		if ( ! $mysqli->query( $sql ) ) {
			fwrite( STDERR, "Update failed on $table: " . $mysqli->error . "\n" );
			exit( 1 );
		}
	}
}

echo json_encode(
	array(
		'database'    => $db,
		'from'        => $from,
		'to'          => $to,
		'dryRun'      => $dry,
		'changedRows' => $changed_rows,
		'cellsScanned'=> $scanned_cols,
	),
	JSON_PRETTY_PRINT
) . "\n";

$mysqli->close();
