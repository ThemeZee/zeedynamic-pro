<?php
/***
 * Header Spacing
 *
 * Adds extra settings to handle spacings in the header area
 *
 * @package zeeDynamic Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'zeeDynamic_Pro_Header_Spacing' ) ) :

class zeeDynamic_Pro_Header_Spacing {

	/**
	 * Site Logo Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if zeeDynamic Theme is not active
		if ( ! current_theme_supports( 'zeedynamic-pro'  ) ) {
			return;
		}
		
		// Add Custom Spacing CSS code to custom stylesheet output
		add_filter( 'zeedynamic_pro_custom_css_stylesheet', array( __CLASS__, 'custom_spacing_css' ) ); 
		
		// Add Header Spacing Settings
		add_action( 'customize_register', array( __CLASS__, 'header_spacing_settings' ) );
	}
	
	/**
	 * Adds custom Margin CSS styling for the logo and navigation spacing
	 *
	 */
	static function custom_spacing_css( $custom_css ) { 
		
		// Get Theme Options from Database
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Set CSS Variable
		$spacing_css = '';
		
		// Set Logo Spacing
		if ( $theme_options['logo_spacing'] <> 0 ) { 
		
			$margin = $theme_options['logo_spacing'] / 10;
		
			$spacing_css .= '
				.site-branding {
					margin: '. $margin .'em 0;
				}
				';
				
		}
		
		// Set Navigation Spacing
		if ( $theme_options['header_spacing'] <> 20 ) { 
		
			$margin = $theme_options['header_spacing'] / 10;
		
			$spacing_css .= '
				@media only screen and (min-width: 60em) {

					.header-main {
						padding-top: '. $margin .'em;
						padding-bottom: '. $margin .'em;
					}
					
				}
				';
				
		}
		
		// Add Spacing CSS to existing CSS code
		$custom_css .= $spacing_css;
		
		return $custom_css;
		
	}
	
	/**
	 * Adds header spacing settings
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function header_spacing_settings( $wp_customize ) {

		// Add Sections for Site Logo
		$wp_customize->add_section( 'zeedynamic_pro_section_header', array(
			'title'    => __( 'Header Spacing', 'zeedynamic-pro' ),
			'priority' => 20,
			'panel' => 'zeedynamic_options_panel' 
			)
		);
		
		// Add Logo Spacing setting
		$wp_customize->add_setting( 'zeedynamic_theme_options[logo_spacing]', array(
			'default'           => 0,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[logo_spacing]', array(
			'label'    => __( 'Logo Spacing (default: 0)', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_pro_section_header',
			'settings' => 'zeedynamic_theme_options[logo_spacing]',
			'type'     => 'text',
			'priority' => 2
			)
		);
		
		// Add Header Spacing setting
		$wp_customize->add_setting( 'zeedynamic_theme_options[header_spacing]', array(
			'default'           => 20,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[header_spacing]', array(
			'label'    => __( 'Header Spacing (default: 20)', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_pro_section_header',
			'settings' => 'zeedynamic_theme_options[header_spacing]',
			'type'     => 'text',
			'priority' => 3
			)
		);

	}

}

// Run Class
add_action( 'init', array( 'zeeDynamic_Pro_Header_Spacing', 'setup' ) );

endif;