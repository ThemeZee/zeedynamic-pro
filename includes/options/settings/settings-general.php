<?php
	
	function themezee_sections_general() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_general_header",
					"name" => __('Header Settings', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_general_layout",
					"name" => __('Layout Settings', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_general_css_section",
					"name" => __('Custom CSS Code', 'zeeDynamicPro_language'));
					
		return $themezee_sections;
	}
	
	function themezee_settings_general() {

		$themezee_settings = array();
	
		### HEADER SETTINGS
		#######################################################################################
		$themezee_settings[] = array("name" => __('Logo Image', 'zeeDynamicPro_language'),
						"desc" => __('Paste the full Image URL of your logo or click Upload Image. Leave this field blank to display the site title instead of a logo image.', 'zeeDynamicPro_language'),
						"id" => "themeZee_general_logo",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_general_header");

		$themezee_settings[] = array("name" => __('Show Tagline?', 'zeeDynamicPro_language'),
						"desc" => __('Check this if you want to show your tagline(blog description) below the logo', 'zeeDynamicPro_language'),
						"id" => "themeZee_general_tagline",
						"std" => "true",
						"type" => "checkbox",
						"section" => "themeZee_general_header");
						
		$themezee_settings[] = array("name" => __('Header displays', 'zeeDynamicPro_language'),
						"desc" => __('Select which content is displayed in the right handed header area.', 'zeeDynamicPro_language'),
						"id" => "themeZee_general_header_content",
						"std" => 'nothing',
						"type" => "radio",
						'choices' => array(
									'nothing' => __('Nothing', 'zeeDynamicPro_language'),
									'search' => __('Search Form', 'zeeDynamicPro_language'),
									'ads' => __('468x60px Banner Ad (see Ads tab)', 'zeeDynamicPro_language'),
									'text' => __('Text Line (add content below)', 'zeeDynamicPro_language'),
									'social' => __('Social Media Icons (see Social Media tab)', 'zeeDynamicPro_language')),
						"section" => "themeZee_general_header"
						);
						
		$themezee_settings[] = array("name" => __('Header Text Line', 'zeeDynamicPro_language'),
						"desc" => __('Enter a textline which can be displayed in the header area (see option above).', 'zeeDynamicPro_language'),
						"id" => "themeZee_general_header_content_text",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_general_header");
						
		### LAYOUT SETTINGS
		#######################################################################################				
		$themezee_settings[] = array("name" => __('Theme Layout', 'zeeDynamicPro_language'),
						"desc" => "",
						"id" => "themeZee_general_theme_layout",
						"std" => 'boxed',
						"type" => "radio",
						'choices' => array(
									'boxed' => __('Boxed (default)', 'zeeDynamicPro_language'),
									'wide' => __('Wide', 'zeeDynamicPro_language')),
						"section" => "themeZee_general_layout"
						);
						
		$themezee_settings[] = array("name" => __('Sidebar Options', 'zeeDynamicPro_language'),
						"desc" => "",
						"id" => "themeZee_general_sidebars",
						"std" => 'right',
						"type" => "radio",
						'choices' => array(
									'left' => __('Left Sidebar', 'zeeDynamicPro_language'),
									'right' => __('Right Sidebar', 'zeeDynamicPro_language')),
						"section" => "themeZee_general_layout"
						);
						
		$themezee_settings[] = array("name" => __('Hide Credit Link?', 'zeeDynamicPro_language'),
						"desc" => __('Check this if you want to hide the credit link to themezee.com', 'zeeDynamicPro_language'),
						"id" => "themeZee_show_credit_link",
						"std" => "false",
						"type" => "checkbox",
						"section" => "themeZee_general_layout");
						
		$themezee_settings[] = array("name" => __('Footer Content', 'zeeDynamicPro_language'),
						"desc" => __('Enter the content which is displayed in the footer here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_general_footer",
						"std" => "Place your Footer Content here",
						"type" => "html",
						"section" => "themeZee_general_layout");
						
		### CUSTOM CSS
		#######################################################################################					
		$themezee_settings[] = array("name" => __('Custom CSS', 'zeeDynamicPro_language'),
						"desc" => __('Place your Custom CSS code here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_general_css",
						"std" => "",
						"type" => "textarea",
						"section" => "themeZee_general_css_section");
										
		return $themezee_settings;
	}

?>