<?php
/**
 * This file is used to create setting menu and setting links
 *
 * PluginSettings
 */
class PluginSettings {
	/**
	 * Varible used to load settings of it.
	 *
	 * @var string
	 */
	public $pagename;
	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		$this->pagename = esc_html( 'plgs_settings' );
		add_action( 'admin_menu', array( $this, 'plgs_add_admin_menu' ) );
		add_filter( 'plugin_action_links_' . PLUGIN_BASENAME, array( $this, 'plgs_register_setting_function' ), 10 );
	}
	/**
	 * Method plgs_register_setting_function
	 *
	 * @param $links $links It returns array of links.
	 *
	 * @return array
	 */
	public function plgs_register_setting_function( $links ) {
		$settings_link['settings'] = '<a href="admin.php?page=plgs_settings" id="settings-post-listing-gallery-slider" aria-label="Settings of plugin">' . esc_html__( 'Settings', 'plgs' ) . '</a>';

		$links = array_merge( $settings_link, $links );

		return $links;
	}

	/**
	 * Method plgs_add_admin_menu used to add menu for plugin setting
	 *
	 * @return void
	 */
	public function plgs_add_admin_menu() {
		add_menu_page(
			__( 'Post List Slider Settings', 'plgs' ),
			__( 'Post List Slider Settings', 'plgs' ),
			'manage_options',
			'plgs_settings',
			array( $this, 'plgs_load_plugin_settins' ),
			'dashicons-slides',
			25
		);
	}

	/**
	 * Method plgs_load_plugin_settins to load plugin settings
	 *
	 * @return void
	 */
	public function plgs_load_plugin_settins() {
		if ( get_query_var( 'page' ) === $this->pagename ) {
			include PLUGIN_VIEWS_DIR_PATH . 'class-load-plugin-settings.php';
		}
	}
}

if ( class_exists( 'PluginSettings' ) ) {
	$plugin_setting_obj = new PluginSettings();
}
