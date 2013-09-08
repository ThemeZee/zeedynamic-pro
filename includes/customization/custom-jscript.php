<?php 
/***
 * Custom Javascript Options
 *
 * Passing Variables from custom Theme Options to the javascript files
 * of theme navigation and frontpage slider. 
 *
 */

// Passing Variables to Theme Navigation ( js/navigation.js)
add_action('wp_enqueue_scripts', 'themezee_custom_jscript_navigation');

if ( ! function_exists( 'themezee_custom_jscript_navigation' ) ):
function themezee_custom_jscript_navigation() { 

	// Set Parameters array
	$params = array(
		'menuTitle' => __('Menu', 'zeeDynamicPro_language')
	);
	
	// Passing Parameters to Javascript
	wp_localize_script( 'themezee_jquery_navigation', 'themezeeNavigationParams', $params );
}
endif;


// Passing Variables to Frontpage Slider ( js/slider.js)
add_action('wp_enqueue_scripts', 'themezee_custom_jscript_slider');

if ( ! function_exists( 'themezee_custom_jscript_slider' ) ):
function themezee_custom_jscript_slider() { 
	
	// Get Theme Options
	$options = get_option('themezee_options');
	
	// Set Parameters array
	$params = array();
	
	// Define Slider Animation
	if( isset($options['themeZee_frontpage_slider_animation']) ) :
		$params['animation'] = esc_attr($options['themeZee_frontpage_slider_animation']);
	endif;
	
	// Define Slider Speed
	if( isset($options['themeZee_frontpage_slider_speed']) ) :
		$params['speed'] = esc_attr($options['themeZee_frontpage_slider_speed']);
	endif;
	
	// Passing Parameters to Javascript
	wp_localize_script( 'themezee_jquery_frontpage_slider', 'themezeeSliderParams', $params );
}
endif;


// Passing Variables to Load More Posts function( js/posts.js)
add_action('wp_enqueue_scripts', 'themezee_custom_jscript_posts');

if ( ! function_exists( 'themezee_custom_jscript_posts' ) ):
function themezee_custom_jscript_posts() { 

	// Get Pagination query
	if ( get_query_var('paged') ) :
		$paged = (int)get_query_var('paged');
	else :
		$paged = 1;
	endif;
		
	// Get Frontpage Posts
	$zee_frontpage_posts_query = themezee_frontpage_posts_query($paged);

	// Set max
	$max = $zee_frontpage_posts_query->max_num_pages;
 	
	// Set Parameters array
	$params = array(
		'loadMoreText' => __('Load More Posts', 'zeeDynamicPro_language'),
		'loadingText' => __('Loading posts...', 'zeeDynamicPro_language'),
		'noMoreText' => __('No more posts to load.', 'zeeDynamicPro_language'),
		'startPage' => $paged,
		'maxPages' => $max,
		'nextLink' => next_posts($max, false)
	);
	
	// Passing Parameters to Javascript
	wp_localize_script( 'themezee_jquery_load_posts', 'themezeeLoadPostsParams', $params );
}
endif;

?>