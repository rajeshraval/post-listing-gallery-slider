<?php

/**
 * LoadPluginSettings
 */
class LoadPluginSettings {

	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_setting_template' ) );
	}
	/**
	 * Method load_setting_template
	 *
	 * @return void
	 */
	public function load_setting_template() {
		include PLUGIN_VIEWS_DIR_PATH . 'templates/plgs-settings-template.php';
	}
}

if ( class_exists( 'LoadPluginSettings' ) ) {
	$plgs_setting_obj = new LoadPluginSettings();
}
