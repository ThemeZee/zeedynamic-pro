<?php

// Include Fonts from Google Web Fonts API
function themezee_load_web_fonts() { 

	$options = get_option('zeedynamic_options');
	
	// Default Fonts which haven't to be load from Google
	$default_fonts = array('Arial', 'Verdana', 'Tahoma', 'Times New Roman');

	// Load Fonts ?
	if ( isset($options['themeZee_fonts_activate']) and $options['themeZee_fonts_activate'] == 'true' ) :
	
		// Load Text Font
		if(isset($options['themeZee_fonts_text']) and !in_array($options['themeZee_fonts_text'], $default_fonts)) :
			wp_register_style('themezee_text_font', 'http://fonts.googleapis.com/css?family=' . $options['themeZee_fonts_text']);
			wp_enqueue_style('themezee_text_font');
			$default_fonts[] = $options['themeZee_fonts_text']; // add font to array to prevent second font embed
		endif;
		
		// Load Navigation Font
		if(isset($options['themeZee_fonts_navi']) and !in_array($options['themeZee_fonts_navi'], $default_fonts)) :
			wp_register_style('themezee_navi_font', 'http://fonts.googleapis.com/css?family=' . $options['themeZee_fonts_navi']);
			wp_enqueue_style('themezee_navi_font');
			$default_fonts[] = $options['themeZee_fonts_navi']; // add font to array to prevent second font embed
		endif;
		
		// Load Title Font
		if(isset($options['themeZee_fonts_title']) and !in_array($options['themeZee_fonts_title'], $default_fonts)) :
			wp_register_style('themezee_title_font', 'http://fonts.googleapis.com/css?family=' . $options['themeZee_fonts_title']);
			wp_enqueue_style('themezee_title_font');
			$default_fonts[] = $options['themeZee_fonts_title']; // add font to array to prevent second font embed
		endif;
		
		// Load Widget Font
		if(isset($options['themeZee_fonts_widget']) and !in_array($options['themeZee_fonts_widget'], $default_fonts)) :
			wp_register_style('themezee_widget_font', 'http://fonts.googleapis.com/css?family=' . $options['themeZee_fonts_widget']);
			wp_enqueue_style('themezee_widget_font');
		endif;
		
	// Load Standard Font
	else: 
		wp_register_style('themezee_default_font', 'http://fonts.googleapis.com/css?family=Droid+Sans');
		wp_enqueue_style('themezee_default_font');
		wp_register_style('themezee_default_title_font', 'http://fonts.googleapis.com/css?family=Francois+One');
		wp_enqueue_style('themezee_default_title_font');
	endif;
}
add_action('wp_enqueue_scripts', 'themezee_load_web_fonts');

// Web Fonts Wrapper Function for Admin
function themezee_load_web_fonts_admin() { 
	
	$default_fonts = themezee_get_web_fonts();
			
	// Make sure to load Fonts only at Theme Options Page in the Backend
	if ( isset($_GET['page']) and $_GET['page'] == 'themezee' and isset($_GET['tab']) and $_GET['tab'] == 'fonts' ) :
		
		foreach ( $default_fonts as $value => $label ) {
			wp_register_style('themezee_font_' . $label, 'http://fonts.googleapis.com/css?family=' . $value);
			wp_enqueue_style('themezee_font_' . $label);
		}
		
	endif; 
}
add_action('admin_enqueue_scripts', 'themezee_load_web_fonts_admin');


add_action('wp_head', 'themezee_css_fonts');
function themezee_css_fonts() {
	
	echo '<style type="text/css">';
	$options = get_option('zeedynamic_options');
	
	if ( isset($options['themeZee_fonts_activate']) and $options['themeZee_fonts_activate'] == 'true' ) {
	
		echo '
			body, input, textarea {
				font-family: "'.esc_attr($options['themeZee_fonts_text']).'";
			}
			#mainnav-icon, #mainnav-menu a {
				font-family: "'.esc_attr($options['themeZee_fonts_navi']).'";
			}
			#logo .site-title, .page-title, .post-title, .slide-title,
			#comments .comments-title, #respond #reply-title, .comment-author .fn {
				font-family: "'.esc_attr($options['themeZee_fonts_title']).'";
			}
			.widgettitle, .frontpage-category-title {
				font-family: "'.esc_attr($options['themeZee_fonts_widget']).'";
			}
		';
	}
	echo '</style>';
}


