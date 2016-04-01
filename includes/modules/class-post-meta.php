<?php
/***
 * Post Meta Settings
 *
 * Adds post meta settings to disable date, author or other meta information of posts
 *
 * @package zeeDynamic Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'zeeDynamic_Pro_Post_Meta' ) ) :

class zeeDynamic_Pro_Post_Meta {

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
		
		// Add Post Meta Settings
		add_action( 'customize_register', array( __CLASS__, 'post_meta_settings' ) );
	
	}
	
	/**
	 * Adds post meta settings
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function post_meta_settings( $wp_customize ) {

		// Add Post Meta Settings
		$wp_customize->add_setting( 'zeedynamic_theme_options[postmeta_headline]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control( new zeeDynamic_Customize_Header_Control(
			$wp_customize, 'zeedynamic_theme_options[postmeta_headline]', array(
				'label' => esc_html__( 'Post Meta', 'zeedynamic-pro' ),
				'section' => 'zeedynamic_section_post',
				'settings' => 'zeedynamic_theme_options[postmeta_headline]',
				'priority' => 4
				)
			)
		);
		
		$wp_customize->add_setting( 'zeedynamic_theme_options[meta_date]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[meta_date]', array(
			'label'    => esc_html__( 'Display post date', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_section_post',
			'settings' => 'zeedynamic_theme_options[meta_date]',
			'type'     => 'checkbox',
			'priority' => 5
			)
		);
		
		$wp_customize->add_setting( 'zeedynamic_theme_options[meta_author]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[meta_author]', array(
			'label'    => esc_html__( 'Display post author', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_section_post',
			'settings' => 'zeedynamic_theme_options[meta_author]',
			'type'     => 'checkbox',
			'priority' => 6
			)
		);
		
		$wp_customize->add_setting( 'zeedynamic_theme_options[meta_category]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[meta_category]', array(
			'label'    => esc_html__( 'Display post categories', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_section_post',
			'settings' => 'zeedynamic_theme_options[meta_category]',
			'type'     => 'checkbox',
			'priority' => 7
			)
		);

		// Add Post Footer Settings
		$wp_customize->add_setting( 'zeedynamic_theme_options[single_posts_headline]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control( new zeeDynamic_Customize_Header_Control(
			$wp_customize, 'zeedynamic_theme_options[single_posts_headline]', array(
				'label' => esc_html__( 'Single Posts', 'zeedynamic-pro' ),
				'section' => 'zeedynamic_section_post',
				'settings' => 'zeedynamic_theme_options[single_posts_headline]',
				'priority' => 8
				)
			)
		);
		
		$wp_customize->add_setting( 'zeedynamic_theme_options[post_image]', array(
			'default'           => false,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[post_image]', array(
			'label'    => esc_html__( 'Display featured image on single posts', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_section_post',
			'settings' => 'zeedynamic_theme_options[post_image]',
			'type'     => 'checkbox',
			'priority' => 9
			)
		);
		
		$wp_customize->add_setting( 'zeedynamic_theme_options[meta_tags]', array(
			'default'           => false,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[meta_tags]', array(
			'label'    => esc_html__( 'Display post tags on single posts', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_section_post',
			'settings' => 'zeedynamic_theme_options[meta_tags]',
			'type'     => 'checkbox',
			'priority' => 10
			)
		);
		$wp_customize->add_setting( 'zeedynamic_theme_options[post_navigation]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'zeedynamic_sanitize_checkbox'
			)
		);
		$wp_customize->add_control( 'zeedynamic_theme_options[post_navigation]', array(
			'label'    => esc_html__( 'Display post navigation on single posts', 'zeedynamic-pro' ),
			'section'  => 'zeedynamic_section_post',
			'settings' => 'zeedynamic_theme_options[post_navigation]',
			'type'     => 'checkbox',
			'priority' => 11
			)
		);

	}

}

// Run Class
add_action( 'init', array( 'zeeDynamic_Pro_Post_Meta', 'setup' ) );

endif;