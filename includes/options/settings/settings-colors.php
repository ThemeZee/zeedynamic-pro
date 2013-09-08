<?php
	
	function themezee_sections_colors() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_colors_schemes",
					"name" => __('Predefined Color Schemes', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_colors_custom",
					"name" => __('Custom Colors', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_colors_layout",
					"name" => __('General Color Settings', 'zeeDynamicPro_language'));
				
		$themezee_sections[] = array("id" => "themeZee_colors_navi",
					"name" => __('Navigation Color Settings', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_colors_post",
					"name" => __('Post Color Settings', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_colors_sidebar",
					"name" => __('Sidebar Color Settings', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_colors_frontpage",
					"name" => __('Frontpage Color Settings', 'zeeDynamicPro_language'));
		
		return $themezee_sections;
	}
	
	function themezee_settings_colors() {
	
		$color_schemes = array(
			'#1562a5' => __('Blue', 'zeeDynamicPro_language'),
			'#725639' => __('Brown', 'zeeDynamicPro_language'),
			'#777777' => __('Gray', 'zeeDynamicPro_language'),
			'#2d912e' => __('Green', 'zeeDynamicPro_language'),
			'#e34c00' => __('Orange', 'zeeDynamicPro_language'),
			'#9215a5' => __('Purple', 'zeeDynamicPro_language'),
			'#007896' => __('Teal', 'zeeDynamicPro_language'),
			'default' => __('Standard', 'zeeDynamicPro_language'));
		
		$themezee_settings = array();
	
		### COLOR SETTINGS
		#######################################################################################
							
		$themezee_settings[] = array("name" => __('Set Color Scheme', 'zeeDynamicPro_language'),
						"desc" => __('Please select your color scheme here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_color_scheme",
						"std" => "default",
						"type" => "select",
						'choices' => $color_schemes,
						"section" => "themeZee_colors_schemes"
						);
		
		$themezee_settings[] = array("name" => __('Active Custom Colors?', 'zeeDynamicPro_language'),
						"desc" => __('Check this to activate the Custom Color Function.', 'zeeDynamicPro_language'),
						"id" => "themeZee_color_activate",
						"std" => "false",
						"type" => "checkbox",
						"section" => "themeZee_colors_custom");	
						
		### GENERAL COLOR SETTINGS			
		#######################################################################################			
		$themezee_settings[] = array("name" => __('Link and Button Color', 'zeeDynamicPro_language'),
						"desc" => __('Select the color of links and buttons here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_link",
						"std" => "#e84747",
						"type" => "colorpicker",
						"section" => "themeZee_colors_layout");
						
		$themezee_settings[] = array("name" => __('Footer Color', 'zeeDynamicPro_language'),
						"desc" => __('Select the background color of the footer area here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_footer",
						"std" => "#333333",
						"type" => "colorpicker",
						"section" => "themeZee_colors_layout");
						
		### NAVIGATION COLOR SETTINGS			
		#######################################################################################			
		$themezee_settings[] = array("name" => __('Navigation Background', 'zeeDynamicPro_language'),
						"desc" => __('Select the background color of the navigation menu here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_navi_bg",
						"std" => "#333333",
						"type" => "colorpicker",
						"section" => "themeZee_colors_navi");
						
		$themezee_settings[] = array("name" => __('Navigation Hover Color', 'zeeDynamicPro_language'),
						"desc" => __('Select the hover color of the navigation menu items here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_navi_hover",
						"std" => "#e84747",
						"type" => "colorpicker",
						"section" => "themeZee_colors_navi");
		
		### POST COLOR SETTINGS			
		#######################################################################################			
		$themezee_settings[] = array("name" => __('Post Color', 'zeeDynamicPro_language'),
						"desc" => __('Select the color of post titles and post categories here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_post_color",
						"std" => "#333333",
						"type" => "colorpicker",
						"section" => "themeZee_colors_post");
						
		$themezee_settings[] = array("name" => __('Post Hover Color', 'zeeDynamicPro_language'),
						"desc" => __('Select the hover color of post titles and post categories here', 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_post_hover_color",
						"std" => "#e84747",
						"type" => "colorpicker",
						"section" => "themeZee_colors_post");
		
		### SIDEBAR COLOR SETTINGS		
		#######################################################################################	
		$themezee_settings[] = array("name" => __('Widget Title Color', 'zeeDynamicPro_language'),
						"desc" => __("Select the background color of the sidebar widget titles here.", 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_sidebar_title",
						"std" => "#333333",
						"type" => "colorpicker",
						"section" => "themeZee_colors_sidebar");
						
		$themezee_settings[] = array("name" => __('Widget Link Color', 'zeeDynamicPro_language'),
						"desc" => __("Select the color of sidebar widget links here.", 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_sidebar_link",
						"std" => "#e84747",
						"type" => "colorpicker",
						"section" => "themeZee_colors_sidebar");
						
		### FRONTPAGE COLOR SETTINGS		
		#######################################################################################	
		$themezee_settings[] = array("name" => __('Frontpage Slider Color', 'zeeDynamicPro_language'),
						"desc" => __("Select the color of slideshow navigation buttons here.", 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_frontpage_slider",
						"std" => "#e84747",
						"type" => "colorpicker",
						"section" => "themeZee_colors_frontpage");
						
		$themezee_settings[] = array("name" => __('Frontpage Title Colors', 'zeeDynamicPro_language'),
						"desc" => __("Select the background color of the frontpage category titles here.", 'zeeDynamicPro_language'),
						"id" => "themeZee_colors_frontpage_title",
						"std" => "#333333",
						"type" => "colorpicker",
						"section" => "themeZee_colors_frontpage");
		
		return $themezee_settings;
	}

?>