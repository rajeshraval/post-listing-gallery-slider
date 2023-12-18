<?php
/**
 * Plugin Name: Post Listing Gallery Slider
 * Description: Enhance your WordPress post listings by replacing the single featured image with an engaging image slider showcasing the gallery images. This plugin transforms how your posts are displayed, presenting a dynamic slider that exhibits the entire gallery for each post on the listing page. Elevate the visual appeal of your website's post listings with this intuitive and captivating gallery slider plugin.
 * Version: 1.0
 * Author: Rajesh Raval
 * Text Domain: plgs
 * Domain Path: /languages/
 * GitHub Plugin URI: https://github.com/rajeshraval/post-listing-gallery-slider
 * Tested up to: 6.4.1
 * WC tested up to: 8.3.1
 *
 * @package Post_Listing_Gallery_Slider
 */

defined( 'ABSPATH' ) || die( 'Hey, what are you doing here? You silly human!' );

define( 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'PLUGIN_FILE_PATH', __FILE__ );
define( 'PLUGIN_VIEWS_DIR_PATH', plugin_dir_path( __FILE__ ) . 'inc/views/' );


/**
 * Post_Listing_Gallery_Slider
 */
class Post_Listing_Gallery_Slider {
	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {
		if ( ! is_admin() ) {
			add_action( 'plugin_loaded', array( $this, 'plgs_load_css_js' ), 10 );
		}
		add_action( 'init', array( $this, 'plgs_init_admin_settings' ), 10 );
	}
	/**
	 * Method plgs_init_admin_settings used to create setting section
	 *
	 * @return void
	 */
	public function plgs_init_admin_settings() {
		include 'inc/admin/class-plugin-settings.php';
	}
	/**
	 * Method plgs_load_css_js used to load css and js on front-end
	 *
	 * @return void
	 */
	public function plgs_load_css_js() {
		// include 'inc/admin/class-admin-load-css-js.php';
	}
}

if ( class_exists( 'Post_Listing_Gallery_Slider' ) ) {
	$plgs_obj = new Post_Listing_Gallery_Slider();
}

register_activation_hook( PLUGIN_FILE_PATH, array( $plgs_obj, 'plgs_init_admin_settings' ) );

add_action(
	'before_woocommerce_init',
	function () {

		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );

		}
	}
);
