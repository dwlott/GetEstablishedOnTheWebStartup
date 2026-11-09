"""Isolated runner contract tests. No installed WordPress, database or network is used.
Run: python test_build_runner.py --php /absolute/path/php.exe
"""
import argparse
import hashlib
import json
from pathlib import Path
import shutil
import subprocess
import tempfile
import unittest

parser = argparse.ArgumentParser()
parser.add_argument('--php', required=True)
parser.add_argument('--source-root', type=Path, default=Path(__file__).resolve().parents[2])
opts, remaining = parser.parse_known_args()
SOURCE = opts.source_root.resolve()
PHP = str(Path(opts.php).resolve())
STEPS = ['ges-theme-css-sync', 'ges-content-setup', 'ges-front-page-sync', 'ges-nav-menu-sync']

class BuildContract(unittest.TestCase):
    def setUp(self):
        self.temp = tempfile.TemporaryDirectory(prefix='ges-build-test-')
        self.addCleanup(self.temp.cleanup)
        self.root = Path(self.temp.name)
        self.repo = self.root / 'adopted project & source'
        self.build = self.repo / 'Workspace/LocalWordPressBuild'
        shutil.copytree(SOURCE / 'Workspace/LocalWordPressBuild', self.build)
        self.site = self.root / 'custom www & runtime' / 'fixture-site'
        self.theme = self.site / 'wp-content/themes/fixture-theme'
        self.theme.mkdir(parents=True)
        (self.theme/'functions.php').write_text('<?php\n', encoding='utf-8')
        self.marker = self.site/'bootstrap-marker'
        # A bootstrap tripwire catches any unintended WP loading during plan.
        (self.site/'wp-load.php').write_text("<?php file_put_contents(__DIR__.'/bootstrap-marker', 'loaded'); exit(23);", encoding='utf-8')
        (self.site/'wp-config.php').write_text("<?php $table_prefix = 'fx_';", encoding='utf-8')
        self.config = {'siteKey':'fixture-site', 'theme':'fixture-theme', 'tablePrefix':'fx_',
                       'localUrl':'http://localhost:8187/fixture-site', 'wampWwwRoot':str(self.site.parent)}
        self.manifest = self.build/'site-manifest.json'
        self.save_config()

    def save_config(self):
        self.manifest.write_text(json.dumps(self.config),encoding='utf-8')

    def run_php(self, *args, child='ges-build.php'):
        return subprocess.run([PHP, str(self.build/child), *args], cwd=self.repo, capture_output=True, text=True, timeout=20)

    def snapshot(self):
        return {str(p.relative_to(self.root)): (hashlib.sha256(p.read_bytes()).hexdigest(),p.stat().st_mtime_ns)
                if p.is_file() else None for p in self.root.rglob('*')}

    def reject(self, *args, child='ges-build.php'):
        before=self.snapshot()
        result=self.run_php(*args,child=child)
        self.assertNotEqual(result.returncode,0,result.stdout)
        self.assertFalse(self.marker.exists())
        self.assertEqual(before,self.snapshot())
        return result

    def stub_children(self, failing=None):
        # The real runner launches controlled children to verify argument forwarding,
        # dependency order and stop-on-failure without calling WordPress APIs.
        for step in STEPS:
            status=17 if step==failing else 0
            body="<?php $p=__DIR__.'/child-log.json'; $a=file_exists($p)?json_decode(file_get_contents($p),true):array(); $a[]=array(basename(__FILE__,'.php'),array_slice($argv,1)); file_put_contents($p,json_encode($a)); exit(%d);"%status
            (self.build/(step+'.php')).write_text(body,encoding='utf-8')

    def log(self):
        return json.loads((self.build/'child-log.json').read_text())

    def test_default_plan_is_read_only_and_resolves_nondefault_target(self):
        # Even executable PHP manifest side effects must not run during static plan.
        (self.build/'content-manifest.php').write_text("<?php file_put_contents(__DIR__.'/manifest-marker','bad'); return array();",encoding='utf-8')
        before=self.snapshot(); result=self.run_php()
        self.assertEqual(result.returncode,0,result.stdout+result.stderr)
        self.assertIn('localhost:8187',result.stdout)
        self.assertIn('fixture-theme',result.stdout)
        self.assertEqual(before,self.snapshot())

    def test_each_direct_child_plan_is_read_only(self):
        (self.build/'front-page-manifest.php').write_text('<?php return array("sections"=>array());',encoding='utf-8')
        for child in STEPS+['ges-local-setup']:
            with self.subTest(child=child):
                before=self.snapshot(); result=self.run_php('--plan',child=child+'.php')
                self.assertEqual(result.returncode,0,result.stdout+result.stderr)
                self.assertEqual(before,self.snapshot())

    def test_unadopted_template_rejected(self):
        self.config['siteKey']='yoursite';self.save_config();self.reject()

    def test_placeholder_rejected(self):
        self.config['siteKey']='{siteKey}';self.save_config();self.reject('--write')

    def test_missing_config_field(self):
        del self.config['theme'];self.save_config();self.reject()

    def test_bad_json(self):
        self.manifest.write_text('{broken',encoding='utf-8');self.reject()

    def test_external_url_rejected(self):
        self.config['localUrl']='https://example.com/site';self.save_config();self.reject('--write')

    def test_missing_target_rejected(self):
        self.config['wampWwwRoot']='';self.save_config();self.reject()

    def test_explicit_target_supported(self):
        self.config['wampWwwRoot']='';self.save_config()
        result=self.run_php('--wp-root='+str(self.site));self.assertEqual(result.returncode,0,result.stdout+result.stderr)

    def test_conflicting_targets_rejected(self):
        other=self.root/'other';other.mkdir();self.reject('--wp-root='+str(other),'--write')

    def test_prefix_mismatch_rejected(self):
        self.config['tablePrefix']='other_';self.save_config();self.reject('--write')

    def test_dynamic_prefix_rejected(self):
        (self.site/'wp-config.php').write_text("<?php $table_prefix=getenv('PREFIX');",encoding='utf-8');self.reject()

    def test_unknown_option_and_step_rejected(self):
        for args in [('--wrtie',),('--only=unknown',),('--only=ges-nav-menu-sync,',),('--only=',),('--write=false',),('--write','--write'),('--plan','--write'),('--only=ges-nav-menu-sync,ges-nav-menu-sync',)]:
            with self.subTest(args=args):self.reject(*args)

    def test_relative_target_rejected(self):
        self.reject('--wp-root=relative')

    def test_step_flags_require_step(self):
        self.reject('--sections=front-page-1')
        self.reject('--only=ges-content-setup','--section-anchors')
        self.reject('--sections=x',child='ges-content-setup.php')

    def test_missing_front_manifest_stops_before_css_apply(self):
        (self.build/'front-page-manifest.php').unlink(missing_ok=True)
        self.reject('--write','--only='+','.join(STEPS))

    def test_missing_late_child_stops_before_any_apply(self):
        (self.build/'ges-nav-menu-sync.php').unlink();self.reject('--write')

    def test_apply_forwards_identity_flags_and_dependency_order(self):
        self.stub_children()
        result=self.run_php('--write','--only=ges-nav-menu-sync,ges-content-setup','--section-anchors','--force')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr)
        log=self.log();self.assertEqual([x[0] for x in log],['ges-content-setup','ges-nav-menu-sync'])
        for name,args in log:
            self.assertIn('--write',args);self.assertIn('--wp-root='+self.site.as_posix(),args)
            self.assertIn('--manifest='+self.manifest.as_posix(),args);self.assertIn('--force',args)
        self.assertIn('--section-anchors',log[1][1]);self.assertNotIn('--section-anchors',log[0][1])

    def test_optional_front_page_is_registered_and_forwarded(self):
        (self.build/'front-page-manifest.php').write_text('<?php return array();',encoding='utf-8')
        self.stub_children()
        result=self.run_php('--write','--only=ges-front-page-sync','--sections=front-page-1')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr)
        self.assertEqual(self.log()[0][0],'ges-front-page-sync')
        self.assertIn('--sections=front-page-1',self.log()[0][1])

    def test_failure_propagates_and_stops_later_children(self):
        self.stub_children(failing='ges-content-setup')
        result=self.run_php('--write');self.assertEqual(result.returncode,17,result.stderr)
        self.assertEqual([x[0] for x in self.log()],['ges-theme-css-sync','ges-content-setup'])

    def test_legacy_initializer_cannot_apply(self):
        self.reject('--write',child='ges-local-setup.php')

    def test_real_content_apply_loads_only_explicit_fixture(self):
        result=self.run_php('--write','--only=ges-content-setup')
        self.assertEqual(result.returncode,23,result.stderr);self.assertTrue(self.marker.exists())

    def test_real_css_apply_repeat_is_noop(self):
        result=self.run_php('--write','--only=ges-theme-css-sync')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr)
        self.assertFalse(self.marker.exists())
        self.assertTrue((self.theme/'ges-custom/ges-altitude-custom.css').is_file())
        before=self.snapshot();result=self.run_php('--write','--only=ges-theme-css-sync')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr);self.assertEqual(before,self.snapshot())

    def test_front_apply_requires_configured_sections_before_bootstrap(self):
        (self.build/'front-page-manifest.php').write_text('<?php return array("sections"=>array());',encoding='utf-8')
        self.reject('--write',child='ges-front-page-sync.php')

    def test_loaded_site_identity_mismatch_stops_mutation(self):
        for prefix,url,theme in [('wrong_','http://localhost:8187/fixture-site/','fixture-theme'),
                                 ('fx_','http://localhost:9999/wrong/','fixture-theme'),
                                 ('fx_','http://localhost:8187/fixture-site/','wrong-theme')]:
            with self.subTest(prefix=prefix,url=url,theme=theme):
                bootstrap="<?php $table_prefix='%s'; function home_url($p){return '%s';} function get_option($k){return '%s';}"%(prefix,url,theme)
                (self.site/'wp-load.php').write_text(bootstrap,encoding='utf-8')
                self.reject('--write',child='ges-nav-menu-sync.php')

    def test_real_content_apply_empty_manifest_and_repeat(self):
        (self.site/'wp-load.php').write_text("<?php $table_prefix='fx_'; function home_url($p='/'){return 'http://localhost:8187/fixture-site/';} function get_option($k){return 'fixture-theme';}",encoding='utf-8')
        (self.build/'content-manifest.php').write_text("<?php return array('categories'=>array(),'archive_pages'=>array(),'sample_posts'=>array());",encoding='utf-8')
        result=self.run_php('--write','--only=ges-content-setup')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr)
        register=self.repo/'Workspace/Reference/WordPressGenesisOperatingGuide/Examples/ges-category-id-register.md'
        self.assertTrue(register.is_file())
        before=self.snapshot();result=self.run_php('--write','--only=ges-content-setup')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr);self.assertEqual(before,self.snapshot())

    def test_real_front_apply_with_isolated_option_store(self):
        # Execute the actual front-page child against a tiny WP option API double.
        # This exercises widget wiring; it is not a full WordPress/database test.
        database=self.site/'options.json'
        database.write_text(json.dumps({'stylesheet':'fixture-theme','unrelated':'preserved'}),encoding='utf-8')
        bootstrap="""<?php
$table_prefix = 'fx_';
function home_url($path='/'){return 'http://localhost:8187/fixture-site/';}
function get_option($name,$default=false){$all=json_decode(file_get_contents(__DIR__.'/options.json'),true); return $all[$name]??$default;}
function update_option($name,$value){$p=__DIR__.'/options.json';$all=json_decode(file_get_contents($p),true);if(isset($all[$name]) && $all[$name]===$value){return false;}$all[$name]=$value;file_put_contents($p,json_encode($all));return true;}
"""
        (self.site/'wp-load.php').write_text(bootstrap,encoding='utf-8')
        (self.build/'front-page-manifest.php').write_text("<?php return array('sections'=>array('front-page-1'=>array('widgets'=>array(array('type'=>'custom_html','title'=>'Fixture','html'=>'<p>Fixture</p>')))));",encoding='utf-8')
        result=self.run_php('--write','--only=ges-front-page-sync')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr)
        state=json.loads(database.read_text());self.assertEqual(state['unrelated'],'preserved')
        self.assertEqual(state['sidebars_widgets']['front-page-1'],['custom_html-1'])
        before=self.snapshot();result=self.run_php('--write','--only=ges-front-page-sync')
        self.assertEqual(result.returncode,0,result.stdout+result.stderr);self.assertEqual(before,self.snapshot())

    def test_packaged_copy_keeps_same_execution_contract(self):
        copied=self.root/'packaged copy'
        shutil.copytree(self.repo,copied)
        for name in ['ges-build-contract.php','ges-build.php']+[x+'.php' for x in STEPS]:
            self.assertEqual((copied/'Workspace/LocalWordPressBuild'/name).read_bytes(),(self.build/name).read_bytes())
        result=subprocess.run([PHP,str(copied/'Workspace/LocalWordPressBuild/ges-build.php')],capture_output=True,text=True,timeout=20)
        self.assertEqual(result.returncode,0,result.stdout+result.stderr);self.assertFalse(self.marker.exists())

if __name__=='__main__':
    unittest.main(argv=[__file__,*remaining])
