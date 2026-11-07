import importlib.util
import sys
import unittest


SPEC = importlib.util.spec_from_file_location(
    "prepare_bluehost_sql",
    "Automation/BluehostDatabasePrep/prepare_bluehost_sql.py",
)
MODULE = importlib.util.module_from_spec(SPEC)
assert SPEC.loader is not None
sys.modules[SPEC.name] = MODULE
SPEC.loader.exec_module(MODULE)

LOCAL = "http://localhost/yoursite"
PUBLIC = "https://example.com"


class BluehostPrepTests(unittest.TestCase):
    def test_serialized_scalars_keep_one_separator(self):
        for value in ("i:8;", "b:1;", "d:1.25;", "r:1;", "R:1;"):
            with self.subTest(value=value):
                self.assertEqual(MODULE.rewrite_serialized(value, [], MODULE.PrepStats()), value)

    def test_serialized_array_preserves_numeric_values(self):
        local = LOCAL + "/forum/"
        public = PUBLIC + "/forum/"
        source = f'a:3:{{s:6:"forums";i:8;s:7:"enabled";b:1;s:3:"url";s:{len(local)}:"{local}";}}'
        expected = f'a:3:{{s:6:"forums";i:8;s:7:"enabled";b:1;s:3:"url";s:{len(public)}:"{public}";}}'
        actual = MODULE.rewrite_serialized(
            source,
            MODULE.replacement_forms(LOCAL, PUBLIC),
            MODULE.PrepStats(),
        )
        self.assertEqual(actual, expected)
        self.assertNotIn("i::", actual)
        self.assertNotIn("b::", actual)

    def test_root_path_mapping_preserves_boundary(self):
        mappings = MODULE.replacement_forms("/yoursite/", "/")
        value = MODULE.apply_mappings(
            "href='/yoursite/forum/' src='/yoursite/wp-content/a.png'",
            mappings,
            MODULE.PrepStats(),
        )
        self.assertIn("href='/forum/'", value)
        self.assertIn("src='/wp-content/a.png'", value)
        self.assertNotIn("//forum/", value)
        quoted = MODULE.apply_mappings(
            'href="/yoursite/packing/"',
            mappings,
            MODULE.PrepStats(),
        )
        self.assertEqual(quoted, 'href="/packing/"')
        escaped = MODULE.apply_mappings(
            r'href=\"\/yoursite\/packing\/\"',
            mappings,
            MODULE.PrepStats(),
        )
        self.assertEqual(escaped, r'href=\"\/packing\/\"')
        public = MODULE.apply_mappings(
            "https://example.com/yoursite/",
            mappings,
            MODULE.PrepStats(),
        )
        self.assertEqual(public, "https://example.com/yoursite/")

    def test_serialized_url_lengths_are_repaired(self):
        serialized = f's:{len(LOCAL.encode("utf-8"))}:"{LOCAL}";'
        rewritten = MODULE.rewrite_serialized(
            serialized,
            MODULE.replacement_forms(LOCAL, PUBLIC),
            MODULE.PrepStats(),
        )
        self.assertEqual(rewritten, f's:{len(PUBLIC.encode("utf-8"))}:"{PUBLIC}";')

    def test_validation_reports_domain_root_local_paths(self):
        text = (
            "CREATE TABLE " + chr(96) + "wp_options" + chr(96) + " (id int);"
            "(1,'siteurl','https://example.com'),"
            "(2,'home','https://example.com'),"
            "http://127.0.0.1/yoursite /yoursite/forum/"
        )
        validation = MODULE.validate_output(
            text,
            "wp_",
            [(LOCAL, PUBLIC)],
            LOCAL,
        )
        self.assertEqual(validation["loopbackReferenceCounts"]["ipv4Loopback"], 1)
        self.assertGreater(validation["remainingLocalPathReferences"], 0)

        same_folder = MODULE.validate_output(
            'href="/yoursite/"',
            "wp_",
            [(LOCAL, "https://example.com/yoursite")],
            LOCAL,
        )
        self.assertEqual(same_folder["remainingLocalPathReferences"], 0)

    def test_normalize_prefix_case_repairs_wordpress_metadata_keys(self):
        text = (
            "CREATE TABLE `wp_options` (id int);"
            "INSERT INTO `wp_usermeta` VALUES "
            "(1,1,'Wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),"
            "(2,1,'Wp_user_level','10');"
        )
        normalized = MODULE.normalize_prefix_case(text, "wp_")
        self.assertIn("'wp_capabilities'", normalized)
        self.assertIn("'wp_user_level'", normalized)
        self.assertNotIn("Wp_", normalized)
        validation = MODULE.validate_output(
            normalized,
            "wp_",
            [(LOCAL, PUBLIC)],
            LOCAL,
        )
        self.assertTrue(validation["prefixCaseOk"])
        self.assertTrue(validation["wordpressPrefixKeysOk"])

    def test_validation_rejects_mixed_case_capability_metadata(self):
        text = (
            "CREATE TABLE `wp_options` (id int);"
            "INSERT INTO `wp_usermeta` VALUES "
            "(1,1,'Wp_capabilities','a:1:{}'),"
            "(2,1,'Wp_user_level','10');"
        )
        validation = MODULE.validate_output(
            text,
            "wp_",
            [(LOCAL, PUBLIC)],
            LOCAL,
        )
        self.assertFalse(validation["wordpressPrefixKeysOk"])


if __name__ == "__main__":
    unittest.main()
