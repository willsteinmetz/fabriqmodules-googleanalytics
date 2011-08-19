<?php

class %MODULE%_install {
	public function install() {
		$mod = new Modules();
		$mod->getModuleByName('%MODULE%');
		$perms = array();
		
		$perm_ids = FabriqModules::register_perms($mod->id, $perms);
		
		global $db;
		$sql = "";
		$db->query($sql);
		
		// map paths
		$pathmap = &FabriqModules::module('pathmap');
		$pathmap->register_path('%PATH%', '%MODULE%', '%ACTION%', 'module');

		// register events
		FabriqModules::register_handler('%EVENTMODULE%', '%EVENTACTION%', '%EVENT%', '%MODULE%', '%ACTION%');
		
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
		$configs->getForModule('%MODULE%');
		if ($_FAPP['templating']) {
			FabriqTemplates::set_var('module_configs', $configs);
		}
		
		if (isset($_POST['submit'])) {
			$configs[$configs->configs['%CONFIG%']]->val = $_POST['%CONFIG'];
			$configs->update($configs->configs['%CONFIG%']);
			Fabriq::render('none');
			echo json_encode(array('success' => true));
		}
	}
	
	public function uninstall() {
		$mod = new Modules();
		$mod->getModuleByName('%MODULE%');
		
		// remove perms
		FabriqModules::remove_perms($mod->id);
		
		// remove paths
		$pathmap = &FabriqModules::module('pathmap');
		$pathmap->remove_path('%PATH%');
		
		// delete database table
		global $db;
		$sql = "DROP TABLE `fabmod_%MODULE%_%TABLE%`;";
		$db->query($sql);
		
		// set module as not installed
		$mod->installed = 0;
		$mod->update();
	}
}
	