<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package zeeDynamic Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Colors Class
 */
class zeeDynamic_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if zeeDynamic Theme is not active.
		if ( ! current_theme_supports( 'zeedynamic-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'zeedynamic_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color CSS code to the Gutenberg editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'custom_editor_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Set Top Navigation Color.
		if ( $theme_options['top_navi_color'] != $default_options['top_navi_color'] ) {

			$custom_css .= '
				/* Top Navigation Color Setting */
				.header-bar-wrap,
				.top-navigation-menu ul {
					background: ' . $theme_options['top_navi_color'] . ';
				}
			';
		}

		// Set Primary Navigation Color.
		if ( $theme_options['navi_primary_color'] != $default_options['navi_primary_color'] ) {

			$custom_css .= '
				/* Primary Navigation Color Setting */
				.main-navigation-menu a:hover,
				.main-navigation-menu a:active,
				.main-navigation-menu li.current-menu-item > a,
				.main-navigation-toggle:hover,
				.main-navigation-toggle:focus,
				.main-navigation-toggle:active {
					background: ' . $theme_options['navi_primary_color'] . ';
				}
			';
		}

		// Set Secondary Navigation Color.
		if ( $theme_options['navi_secondary_color'] != $default_options['navi_secondary_color'] ) {

			$custom_css .= '

				/* Secondary Navigation Color Setting */
				.primary-navigation,
				.main-navigation-toggle,
				.main-navigation-menu ul {
					background: ' . $theme_options['navi_secondary_color'] . ';
				}
			';
		}

		// Set Primary Content Color.
		if ( $theme_options['content_primary_color'] != $default_options['content_primary_color'] ) {

			$custom_css .= '
				/* Content Primary Color Setting */
				a,
				a:link,
				a:visited,
				.site-title,
				.site-title a:link,
				.site-title a:visited,
				.has-primary-color {
					color: ' . $theme_options['content_primary_color'] . ';
				}

				a:hover,
				a:focus,
				a:active,
				.site-title a:hover,
				.site-title a:active {
				    color: #333333;
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.more-link,
				.entry-tags .meta-tags a,
				.widget_tag_cloud .tagcloud a,
				.pagination .current,
				.infinite-scroll #infinite-handle span,
				.tzwb-social-icons .social-icons-menu li a,
				.post-slider-controls .zeeflex-direction-nav a,
				.post-slider-controls .zeeflex-control-nav li a:hover,
				.post-slider-controls .zeeflex-control-nav li a.zeeflex-active,
				.scroll-to-top-button,
				.scroll-to-top-button:focus,
				.scroll-to-top-button:active {
				    color: #fff;
					background: ' . $theme_options['content_primary_color'] . ';
				}

				.post-slider .zeeslide .slide-post {
					border-color: ' . $theme_options['content_primary_color'] . ';
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.more-link:hover,
				.more-link:focus,
				.more-link:active,
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:focus,
				.entry-tags .meta-tags a:active,
				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:focus,
				.widget_tag_cloud .tagcloud a:active,
				.infinite-scroll #infinite-handle span:hover,
				.infinite-scroll #infinite-handle span:active,
				.tzwb-social-icons .social-icons-menu li a:hover,
				.tzwb-social-icons .social-icons-menu li a:focus,
				.tzwb-social-icons .social-icons-menu li a:active {
				    background: #333333;
				}

				.has-primary-background-color {
					background-color: ' . $theme_options['content_primary_color'] . ';
				}
			';
		}

		// Set Link Color.
		if ( $theme_options['content_secondary_color'] != $default_options['content_secondary_color'] ) {

			$custom_css .= '
				/* Content Secondary Color Setting */
				a:hover,
				a:focus,
				a:active,
				.site-title a:hover,
				.site-title a:active,
				.page-title,
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited {
					color: ' . $theme_options['content_secondary_color'] . ';
				}

				.entry-title a:hover,
				.entry-title a:active {
				    color: #e84747;
				}

				.widget-header,
				.page-header,
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.more-link:hover,
				.more-link:focus,
				.more-link:active,
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:focus,
				.entry-tags .meta-tags a:active,
				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:focus,
				.widget_tag_cloud .tagcloud a:active,
				.pagination a:link,
				.pagination a:visited,
				.infinite-scroll #infinite-handle span:hover,
				.infinite-scroll #infinite-handle span:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a,
				.tzwb-tabbed-content .tzwb-tabnavi li a:link,
				.tzwb-tabbed-content .tzwb-tabnavi li a:visited,
				.tzwb-social-icons .social-icons-menu li a:hover,
				.tzwb-social-icons .social-icons-menu li a:focus,
				.tzwb-social-icons .social-icons-menu li a:active,
				.post-slider .zeeslide .slide-post,
				.post-slider-controls .zeeflex-direction-nav a:hover,
				.post-slider-controls .zeeflex-direction-nav a:active,
				.post-slider-controls .zeeflex-control-nav li a,
				.scroll-to-top-button:hover {
					background: ' . $theme_options['content_secondary_color'] . ';
				}

				.pagination a:hover,
				.pagination a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
				    background: #e84747;
				}
			';
		}

		// Set Primary Hover Content Color.
		if ( $theme_options['content_primary_color'] != $default_options['content_primary_color'] ) {

			$custom_css .= '
				/* Content Primary Hover Color Setting */
				.entry-title a:hover,
				.entry-title a:active {
					color: ' . $theme_options['content_primary_color'] . ';
				}

				.pagination a:hover,
				.pagination a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
					background: ' . $theme_options['content_primary_color'] . ';
				}
			';
		}

		// Set Footer Widgets Color.
		if ( $theme_options['footer_area_color'] != $default_options['footer_area_color'] ) {

			$custom_css .= '

				/* Footer Area Color Setting */
				.footer-wrap,
				.footer-widgets-background {
					background: ' . $theme_options['footer_area_color'] . ';
				}
			';
		}

		// Set Footer Line Color.
		if ( $theme_options['footer_navi_color'] != $default_options['footer_navi_color'] ) {

			$custom_css .= '

				/* Footer Navigation Color Setting */
				.footer-navigation {
					background: ' . $theme_options['footer_navi_color'] . ';
				}
			';
		}

		return $custom_css;
	}

	/**
	 * Adds Color CSS styles in the Gutenberg Editor to override default colors
	 *
	 * @return void
	 */
	static function custom_editor_colors_css() {

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {

			$custom_css = '
				.has-primary-color,
				.edit-post-visual-editor .editor-block-list__block a {
					color: ' . $theme_options['content_primary_color'] . ';
				}
				.has-primary-background-color {
					background-color: ' . $theme_options['content_primary_color'] . ';
				}
			';

			wp_add_inline_style( 'zeedynamic-editor-styles', $custom_css );
		}
	}

	/**
	 * Change primary color in Gutenberg Editor.
	 *
	 * @return array $editor_settings
	 */
	static function change_primary_color( $color ) {
		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {
			$color = $theme_options['content_primary_color'];
		}

		return $color;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'zeedynamic_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'zeedynamic-pro' ),
			'priority' => 60,
			'panel'    => 'zeedynamic_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[top_navi_color]', array(
				'label'    => _x( 'Top Navigation', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[top_navi_color]',
				'priority' => 1,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[navi_primary_color]', array(
			'default'           => $default_options['navi_primary_color'],
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[navi_primary_color]', array(
				'label'    => _x( 'Navigation (primary)', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[navi_primary_color]',
				'priority' => 2,
			)
		) );

		// Add Navigation Secondary Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[navi_secondary_color]', array(
			'default'           => $default_options['navi_secondary_color'],
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[navi_secondary_color]', array(
				'label'    => _x( 'Navigation (secondary)', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[navi_secondary_color]',
				'priority' => 3,
			)
		) );

		// Add Post Primary Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[content_primary_color]', array(
			'default'           => $default_options['content_primary_color'],
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[content_primary_color]', array(
				'label'    => _x( 'Content (primary)', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[content_primary_color]',
				'priority' => 4,
			)
		) );

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[content_secondary_color]', array(
			'default'           => $default_options['content_secondary_color'],
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[content_secondary_color]', array(
				'label'    => _x( 'Content (secondary)', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[content_secondary_color]',
				'priority' => 5,
			)
		) );

		// Add Footer Widgets Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[footer_area_color]', array(
			'default'           => $default_options['footer_area_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[footer_area_color]', array(
				'label'    => _x( 'Footer', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[footer_area_color]',
				'priority' => 7,
			)
		) );

		// Add Footer Line Color setting.
		$wp_customize->add_setting( 'zeedynamic_theme_options[footer_navi_color]', array(
			'default'           => $default_options['footer_navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'zeedynamic_theme_options[footer_navi_color]', array(
				'label'    => _x( 'Footer Navigation', 'color setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_colors',
				'settings' => 'zeedynamic_theme_options[footer_navi_color]',
				'priority' => 8,
			)
		) );
	}
}

// Run Class.
add_action( 'init', array( 'zeeDynamic_Pro_Custom_Colors', 'setup' ) );
add_filter( 'zeedynamic_primary_color', array( 'zeeDynamic_Pro_Custom_Colors', 'change_primary_color' ) );
