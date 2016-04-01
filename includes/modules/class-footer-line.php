<?php
/***
 * Footer Line
 *
 * Displays credit link and footer text based on theme options
 * Registers and displays footer navigation
 *
 * @package zeeDynamic Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions
if ( ! class_exists( 'zeeDynamic_Pro_Footer_Line' ) ) :

class zeeDynamic_Pro_Footer_Line {

	/**
	 * Footer Line Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		// Display footer navigation
		add_action( 'zeedynamic_before_footer', array( __CLASS__, 'display_footer_navigation' ), 20 );
		
		// Remove default footer text function and replace it with new one
		remove_action( 'zeedynamic_footer_text', 'zeedynamic_footer_text' );
		add_action( 'zeedynamic_footer_text', array( __CLASS__, 'display_footer_text' ) );
		
		// Display social icons in footer
		add_action( 'zeedynamic_footer_menu', array( __CLASS__, 'display_footer_social_menu' ) );
		
		// Add Footer Settings in Customizer
		add_action( 'customize_register', array( __CLASS__, 'footer_settings' ) );
		
	}
	
	/**
	 * Display footer navigation menu
	 *
	 * @return void
	*/
	static function display_footer_navigation() {
		
		// Check if there is a footer menu
		if( has_nav_menu( 'footer' ) ) {
			
			echo '<nav id="footer-navigation" class="footer-navigation navigation clearfix" role="navigation">';
			
			echo '<span class="today">' . date( get_option( 'date_format' ) . ' / ' . get_option( 'time_format' ) ) . '</span>';
			
			wp_nav_menu( array(
				'theme_location' => 'footer', 
				'container' => false, 
				'menu_class' => 'footer-navigation-menu', 
				'echo' => true, 
				'fallback_cb' => '',
				'depth' => 1)
			);

			echo '</nav><!-- #footer-navigation -->';
			
		}
		
	}
	
	/**
	 * Displays Credit Link and user defined Footer Text based on theme settings.
	 *
	 * @return void
	*/
	static function display_footer_text() { 

		// Get Theme Options from Database
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();
		
		// Display Footer Text
		if ( $theme_options['footer_text'] <> '' ) :
			
			echo do_shortcode( wp_kses_post( $theme_options['footer_text'] ) );
				
		endif; 
		
		// Call Credit Link function of theme if credit link is activated
		if ( true == $theme_options['credit_link'] ) :
		
			if ( function_exists( 'zeedynamic_footer_text' ) ) :
			
				zeedynamic_footer_text();
				
			endif;
			
		endif;

	}
	
	/**
	 * Display social icons in footer
	 *
	 * @return void
	*/
	static function display_footer_social_menu() {
		
		// Check if there is a social menu
		if( has_nav_menu( 'footer-social' ) ) {

			echo '<div id="footer-social-icons" class="footer-social-icons social-icons-navigation clearfix">';

			// Display Social Icons Menu
			wp_nav_menu( array(
				'theme_location' => 'footer-social',
				'container' => false,
				'menu_class' => 'social-icons-menu',
				'echo' => true,
				'fallback_cb' => '',
				'link_before' => '<span class="screen-reader-text">',
				'link_after' => '</span>',
				'depth' => 1
				)
			); 

			echo '</div>';
		
		}
		
	}
	
	/**
	 * Adds footer text and credit link setting
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function footer_settings( $wp_customize ) {

		// Add Sections for Footer Settings
		$wp_customize->add_section( 'zeedynamic_pro_section_footer', array(
			'title'    => __( 'Footer Settings', 'zeedynamic-pro' ),
			'priority' => 90,
			'panel' => 'zeedynamic_options_panel' 
			)
		);
		
		// Add Footer Text setting
		$wp_customize->add_setting( 'zeedynamic_theme_options[footer_text]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => array( __CLASS__, 'sanitize_footer_text' )
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[footer_text]', array(
			'label'    => __( 'Footer Text', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_pro_section_footer',
			'settings' => 'zeedynamic_theme_options[footer_text]',
			'type'     => 'textarea',
			'priority' => 1
			)
		);
		
		// Add Credit Link setting
		$wp_customize->add_setting( 'zeedynamic_theme_options[credit_link]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[credit_link]', array(
			'label'    => __( 'Display Credit Link to ThemeZee on footer line', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_pro_section_footer',
			'settings' => 'zeedynamic_theme_options[credit_link]',
			'type'     => 'checkbox',
			'priority' => 2
			)
		);
		
	}
	
	/**
	 *  Sanitize footer content textarea
	 *
	 * @param string $value / Value of the setting
	 * @return string
	 */
	static function sanitize_footer_text( $value ) {

		if ( current_user_can('unfiltered_html') ) :
			return $value;
		else :
			return stripslashes( wp_filter_post_kses( addslashes($value) ) );
		endif;
	}
	
	/**
	 * Register footer navigation menu
	 *
	 * @return void
	*/
	static function register_footer_menu() {
	
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		register_nav_menus( array(
			'footer' => esc_html__( 'Footer Navigation', 'zeedynamic-pro' ),
			'footer-social' => esc_html__( 'Footer Social Icons', 'zeedynamic-pro' ),
		) );
		
	}

}

// Run Class
add_action( 'init', array( 'zeeDynamic_Pro_Footer_Line', 'setup' ) );

// Register footer navigation in backend
add_action( 'after_setup_theme', array( 'zeeDynamic_Pro_Footer_Line', 'register_footer_menu' ), 30 );

endif;