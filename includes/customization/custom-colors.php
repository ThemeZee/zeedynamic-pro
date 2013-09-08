<?php
/***
 * Custom Color Options
 *
 * Get custom colors from theme options and embed CSS color settings 
 * in the <head> area of the theme. 
 *
 */


// Add Custom Colors
add_action('wp_head', 'themezee_custom_colors');
function themezee_custom_colors() { 
	
	// Get Theme Options
	$options = get_option('themezee_options');
	
	// Check if Custom Colors are active
	if ( isset($options['themeZee_color_activate']) and $options['themeZee_color_activate'] == 'true' ) :
	
		// Set Custom Colors
		$link_color = esc_attr($options['themeZee_colors_link']);
		$footer_color = esc_attr($options['themeZee_colors_footer']);
		$navi_color = esc_attr($options['themeZee_colors_navi_bg']);
		$navi_hover_color = esc_attr($options['themeZee_colors_navi_hover']);
		$post_color = esc_attr($options['themeZee_colors_post_color']);
		$post_hover_color = esc_attr($options['themeZee_colors_post_hover_color']);
		$sidebar_title_color = esc_attr($options['themeZee_colors_sidebar_title']);
		$sidebar_link_color = esc_attr($options['themeZee_colors_sidebar_link']);
		$frontpage_slider_color = esc_attr($options['themeZee_colors_frontpage_slider']);
		$frontpage_title_color = esc_attr($options['themeZee_colors_frontpage_title']);
		
		// No Color Scheme used
		$color_scheme = 'none';
		
	else :
	
		// Get Color Scheme and set color scheme to default if nothing is selected)
		$color_scheme = $options['themeZee_color_scheme'] <> '' ? esc_attr($options['themeZee_color_scheme']) : 'default';
		
		$link_color = $color_scheme;
		$footer_color = '#333333';
		$navi_color = '#333333';
		$navi_hover_color = $color_scheme;
		$post_color = '#333333';
		$post_hover_color =  $color_scheme;
		$sidebar_title_color = '#333333';
		$sidebar_link_color = $color_scheme;
		$frontpage_slider_color = $color_scheme;
		$frontpage_title_color = '#333333';
	
	endif;
	
	
	// Set CSS settings except color scheme is default (=> default colors are already defined in style.css)
	if( $color_scheme <> 'default') :
	
		$color_css = '<style type="text/css">';
		$color_css .= '
			a, a:link, a:visited, .comment a:link, .comment a:visited,
			.wp-pagenavi a:link, .wp-pagenavi a:visited, #image-nav .nav-previous a, #image-nav .nav-next a {
				color: '. $link_color .';
			}
			input[type="submit"], .more-link span, .read-more, #commentform #submit {
				background-color: '. $link_color .';
			}
			#footer-widgets-bg, #footer-wrap {
				background-color: '. $footer_color .';
			}
			#navi-wrap {
				background-color: '. $navi_color .';
			}
			#mainnav-menu a:hover, #mainnav-menu ul a:hover, #mainnav-icon:hover {
				background-color: '. $navi_hover_color .';
			}
			#logo .site-title, .page-title, .post-title, .post-title a:link, .post-title a:visited, .archive-title span,
			.postmeta a:link, .postmeta a:visited, #comments .comments-title, #respond #reply-title {
				color: '. $post_color .';
			}
			.page-title, .post-title, #comments .comments-title, #respond #reply-title {
				border-bottom: 5px solid '. $post_color .';
			}
			#logo a:hover .site-title, .post-title a:hover, .post-title a:active{
				color: '. $post_hover_color .';
			}
			.postinfo .meta-category a, .comment-author .fn {
				background-color: '. $post_color .';
			}
			.postinfo .meta-category a:hover, .postinfo .meta-category a:active,
			.bypostauthor .fn, .comment-author-admin .fn {
				background-color: '. $post_hover_color .';
			}
			#sidebar .widgettitle, #sidebar .widget-tabnav li a {
				background-color: '. $sidebar_title_color .';
			}
			#sidebar a:link, #sidebar a:visited{
				color: '. $sidebar_link_color .';
			}
			.slide-entry {
				border-top: 10px solid '. $frontpage_slider_color .';
			}
			#frontpage-slider:hover .zeeflex-next:hover, #frontpage-slider:hover .zeeflex-prev:hover,
			#frontpage-slider .zeeflex-control-paging li a.zeeflex-active {
				background-color: '. $frontpage_slider_color .';
			}
			.frontpage-category-title {
				background-color: '. $frontpage_title_color .';
			}
		';
		$color_css .= '</style>';
		
		// Print Color CSS
		echo $color_css;
	
	endif;
}