<?php
/**
 * @file googleanalytics.install.php
 * @author Will Steinmetz
 */
class googleanalytics_install {
	public function install() {
		$mod = new Modules();
		$mod->getModuleByName('googleanalytics');
		
		// set module as installed
		$mod->installed = 1;
		$mod->update();
	}
	
	public function configure() {
		global $_FAPP;
		if (!$_FAPP['templating']) {
			global $configs;
		}
		$configs = new ModuleConfigs();
		$configs->getForModule('googleanalytics');
		if ($_FAPP['templating']) {
			FabriqTemplates::set_var('module_configs', $configs);
		}
		
		if (isset($_POST['submit'])) {
			$configs[$configs->configs['apikey']]->val = $_POST['%CONFIG'];
			$configs->update($configs->configs['apikey']);
			Fabriq::render('none');
			echo json_encode(array('success' => true));
		}
	}
	
	public function uninstall() {
		$mod = new Modules();
		$mod->getModuleByName('googleanalytics');
		
		// set module as not installed
		$mod->installed = 0;
		$mod->update();
	}
}
	