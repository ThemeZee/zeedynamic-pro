<?php
/***
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the zeeDynamic theme to display widgets
 *
 * @package zeeDynamic Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'zeeDynamic_Pro_Header_Bar' ) ) :

class zeeDynamic_Pro_Header_Bar {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		// Display Header Bar
		add_action( 'zeedynamic_header_bar', array( __CLASS__, 'display_header_bar' ) );
		
	}
	
	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return string HTML output
	*/
	static function display_header_bar() { 

		echo '<div id="header-bar" class="header-bar clearfix">';
		
		// Check if there is a social menu
		if( has_nav_menu( 'social' ) ) {

			echo '<div id="header-social-icons" class="header-social-icons social-icons-navigation clearfix">';

			// Display Social Icons Menu
			wp_nav_menu( array(
				'theme_location' => 'social',
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
		
		// Check if there is a top navigation menu
		if ( has_nav_menu( 'secondary' ) ) {		
		
			echo '<nav id="top-navigation" class="secondary-navigation navigation clearfix" role="navigation">';

			// Display Top Navigation
			wp_nav_menu( array(
				'theme_location' => 'secondary', 
				'container' => false, 
				'menu_class' => 'top-navigation-menu', 
				'echo' => true, 
				'fallback_cb' => '')
			);
				
			echo '</nav>';
		
		}
		
		echo '</div>';

	}
	
	/**
	 * Register navigation menus
	 *
	 * @return void
	*/
	static function register_nav_menus() {
	
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		register_nav_menus( array(
			'secondary' => esc_html__( 'Top Navigation', 'zeedynamic-pro' ),
			'social' => esc_html__( 'Header Social Icons', 'zeedynamic-pro' ),
		) );
		
	}

}

// Run Class
add_action( 'init', array( 'zeeDynamic_Pro_Header_Bar', 'setup' ) );

// Register navigation menus in backend
add_action( 'after_setup_theme', array( 'zeeDynamic_Pro_Header_Bar', 'register_nav_menus' ), 20 );

endif;