<?php
/*
Plugin Name: zeeDynamic Pro
Plugin URI: http://themezee.com/addons/zeedynamic-pro/
Description: Adds additional features like custom colors, google fonts, widget areas and footer copyright to the zeeDynamic theme.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0.1
Text Domain: zeedynamic-pro
Domain Path: /languages/
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

zeeDynamic Pro
Copyright(C) 2016, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions
if ( ! class_exists( 'zeeDynamic_Pro' ) ) :


/**
 * Main zeeDynamic_Pro Class
 *
 * @package zeeDynamic Pro
 */
class zeeDynamic_Pro {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses zeeDynamic_Pro::constants() Setup the constants needed
	 * @uses zeeDynamic_Pro::includes() Include the required files
	 * @uses zeeDynamic_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {
	
		// Setup Constants
		self::constants();
		
		// Setup Translation
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );
	
		// Include Files
		self::includes();
		
		// Setup Action Hooks
		self::setup_actions();
		
	}
	
	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {
		
		// Define Plugin Name
		define( 'ZEE_DYNAMIC_PRO_NAME', 'zeeDynamic Pro' );

		// Define Version Number
		define( 'ZEE_DYNAMIC_PRO_VERSION', '1.0.1' );
		
		// Define Plugin Name
		define( 'ZEE_DYNAMIC_PRO_PRODUCT_ID', 58567 );

		// Define Update API URL
		define( 'ZEE_DYNAMIC_PRO_STORE_API_URL', 'https://themezee.com' ); 

		// Plugin Folder Path
		define( 'ZEE_DYNAMIC_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL
		define( 'ZEE_DYNAMIC_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File
		define( 'ZEE_DYNAMIC_PRO_PLUGIN_FILE', __FILE__ );
		
	}
	
	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'zeedynamic-pro', false, dirname( plugin_basename( ZEE_DYNAMIC_PRO_PLUGIN_FILE ) ) . '/languages/' );
		
	}
	
	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {
	
		// Include Admin Classes
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/admin/class-plugin-updater.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/admin/class-settings.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/admin/class-settings-page.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/admin/class-admin-notices.php';
		
		// Include Customizer Classes
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/customizer/class-customizer.php';
		
		// Include Pro Features
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-custom-colors.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-custom-fonts.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-footer-line.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-footer-widgets.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-header-bar.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-header-spacing.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/modules/class-post-meta.php';
		
		// Include Magazine Widgets
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-boxed.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-list.php';
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-single.php';
		
		// Include Custom Stylesheet class
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/class-custom-stylesheet.php';

	}
	
	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {
		
		// Enqueue Frontend Widget Styles
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );
		
		// Register additional Magazine Post Widgets
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );
		
		// Add Settings link to Plugin actions
		add_filter( 'plugin_action_links_' . plugin_basename( ZEE_DYNAMIC_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );
		
		// Add automatic plugin updater from ThemeZee Store API
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );
		
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		// Enqueue Plugin Stylesheet
		wp_enqueue_style( 'zeedynamic-pro', ZEE_DYNAMIC_PRO_PLUGIN_URL . 'assets/css/zeedynamic-pro.css', array(), ZEE_DYNAMIC_PRO_VERSION );
		
	}
	
	/**
	 * Register Magazine Widgets
	 *
	 * @return void
	 */
	static function register_widgets() {
		
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		register_widget( 'zeeDynamic_Pro_Magazine_Posts_Boxed_Widget' );
		register_widget( 'zeeDynamic_Pro_Magazine_Posts_List_Widget' );
		register_widget( 'zeeDynamic_Pro_Magazine_Posts_Single_Widget' );
		
	}
	
	/**
	 * Add Settings link to the plugin actions
	 *
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'themes.php?page=zeedynamic-pro' ), __( 'Settings', 'zeedynamic-pro' ) ) );
		
		return array_merge( $settings_link, $actions );
	}
	
	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {

		if( ! is_admin() ) :
			return;
		endif;
		
		$options = zeeDynamic_Pro_Settings::instance();

		if( $options->get( 'license_key' ) <> '' ) :
			
			$license_key = $options->get( 'license_key' );
			
			// setup the updater
			$zeedynamic_pro_updater = new zeeDynamic_Pro_Plugin_Updater( ZEE_DYNAMIC_PRO_STORE_API_URL, __FILE__, array(
					'version' 	=> ZEE_DYNAMIC_PRO_VERSION,
					'license' 	=> $license_key,
					'item_name' => ZEE_DYNAMIC_PRO_NAME,
					'item_id'   => ZEE_DYNAMIC_PRO_PRODUCT_ID,
					'author' 	=> 'ThemeZee'
				)
			);
			
		endif;
		
	}
	
}

// Run Plugin
zeeDynamic_Pro::setup();

endif;