<?php
	
	
	// Get available default Fonts
function themezee_get_web_fonts() { 
	
	// Default font array
	$themezee_fonts = array(
		'Arial' => 'Arial',
		'Alef' => 'Alef',
		'Carme' => 'Carme',
		'Droid Sans' => 'Droid Sans',
		'Francois One' => 'Francois One',
		'Josefin Slab' => 'Josefin Slab',
		'Lobster' => 'Lobster',
		'Luckiest Guy' => 'Luckiest Guy',
		'Jockey One' => 'Jockey One',
		'Maven Pro' => 'Maven Pro',
		'Modern Antiqua' => 'Modern Antiqua',
		'Nobile' => 'Nobile',
		'Oswald' => 'Oswald',
		'Permanent Marker' => 'Permanent Marker',
		'Roboto' => 'Roboto',
		'Share' => 'Share',
		'Tahoma' => 'Tahoma',
		'Ubuntu' => 'Ubuntu',
		'Verdana' => 'Verdana');
		
	// Add fonts installed by User
	$options = get_option('themezee_options');
	if ( isset($options['themeZee_fonts_installed']) and $options['themeZee_fonts_installed'] != '' ) :
		
		$fonts = explode(";", $options['themeZee_fonts_installed']);
		foreach ( $fonts as $value) {
			$themezee_fonts[trim($value)] = trim($value);
		}
		asort($themezee_fonts);
	endif;
	
	return $themezee_fonts; 
}


	function themezee_sections_fonts() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_fonts_active",
					"name" => __('Activate Custom Fonts', 'zeeDynamicPro_language'));
		
		$themezee_sections[] = array("id" => "themeZee_fonts_family",
					"name" => __('Font Families', 'zeeDynamicPro_language'));

		return $themezee_sections;
	}
	
	function themezee_settings_fonts() {
	
		// Array with all available Fonts to choose from
		$default_fonts = themezee_get_web_fonts();
	
		### FONTS SETTINGS
		#######################################################################################
		
		$themezee_settings[] = array("name" => __('Active Custom Fonts?', 'zeeDynamicPro_language'),
						"desc" => __('Check this to activate Custom Fonts.', 'zeeDynamicPro_language'),
						"id" => "themeZee_fonts_activate",
						"std" => "false",
						"type" => "checkbox",
						"section" => "themeZee_fonts_active");
						
		$themezee_settings[] = array("name" => __('Install more Fonts', 'zeeDynamicPro_language'),
						"desc" => __('You want more fonts? You can install further fonts from the <a target="_blank" href="http://www.google.com/webfonts/">Google Font API</a> here. 
									Just insert a list of fonts separated by Semicolon, i.e  Arial; Galindo; Cantora One; ...', 'zeeDynamicPro_language'),
						"id" => "themeZee_fonts_installed",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_fonts_active");
						
		$themezee_settings[] = array("name" => __('Text Font', 'zeeDynamicPro_language'),
						"desc" => __("Select the font family of text here. (default = Droid Sans)", 'zeeDynamicPro_language'),
						"id" => "themeZee_fonts_text",
						"std" => "Droid Sans",
						"type" => "fontpicker",
						'choices' => $default_fonts,
						"section" => "themeZee_fonts_family");
		
		$themezee_settings[] = array("name" => __('Navigation Font', 'zeeDynamicPro_language'),
						"desc" => __("Select the navigation font here. (default = Francois One)", 'zeeDynamicPro_language'),
						"id" => "themeZee_fonts_navi",
						"std" => "Francois One",
						"type" => "fontpicker",
						'choices' => $default_fonts,
						"section" => "themeZee_fonts_family");
						
		$themezee_settings[] = array("name" => __('Post/Page Title Fonts', 'zeeDynamicPro_language'),
						"desc" => __("Select the title font here. (default = Francois One)", 'zeeDynamicPro_language'),
						"id" => "themeZee_fonts_title",
						"std" => "Francois One",
						"type" => "fontpicker",
						'choices' => $default_fonts,
						"section" => "themeZee_fonts_family");
						
		$themezee_settings[] = array("name" => __('Widget Title Fonts', 'zeeDynamicPro_language'),
						"desc" => __("Select the widget title font here. (default = Droid Sans)", 'zeeDynamicPro_language'),
						"id" => "themeZee_fonts_widget",
						"std" => "Droid Sans",
						"type" => "fontpicker",
						'choices' => $default_fonts,
						"section" => "themeZee_fonts_family");
		
		return $themezee_settings;
	}
?>