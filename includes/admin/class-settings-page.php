<?php
/***
 * zeeDynamic Pro Settings Page Class
 *
 * Adds a new tab on the themezee plugins page and displays the settings page.
 *
 * @package zeeDynamic Pro
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists('zeeDynamic_Pro_Settings_Page') ) :

class zeeDynamic_Pro_Settings_Page {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	*/
	static function setup() {
		
		// Add settings page to appearance menu
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ), 12 );
		
	}
	
	/**
	 * Add Settings Page to Admin menu
	 *
	 * @return void
	*/
	static function add_settings_page() {
	
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
			
		add_theme_page(
			esc_html__( 'Pro Version', 'zeedynamic-pro' ),
			esc_html__( 'Pro Version', 'zeedynamic-pro' ),
			'manage_options',
			'zeedynamic-pro',
			array( __CLASS__, 'display_settings_page' )
		);
		
	}
	
	/**
	 * Display settings page
	 *
	 * @return void
	*/
	static function display_settings_page() { 
	
		ob_start();
	?>

		<div id="zeedynamic-pro-settings" class="zeedynamic-pro-settings-wrap wrap">
			
			<h1><?php esc_html_e( 'zeeDynamic Pro', 'zeedynamic-pro' ); ?></h1>
			<?php settings_errors(); ?>
			
			<form class="zeedynamic-pro-settings-form" method="post" action="options.php">
				<?php
					settings_fields( 'zeedynamic_pro_settings' );
					do_settings_sections( 'zeedynamic_pro_settings' );
					submit_button();
				?>
			</form>
			
		</div>
<?php
		echo ob_get_clean();
	}
	
}

// Run zeeDynamic Pro Settings Page Class
zeeDynamic_Pro_Settings_Page::setup();

endif;