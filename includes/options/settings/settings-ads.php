<?php
	
	function themezee_sections_ads() {
		$themezee_sections = array();
		
		$themezee_sections[] = array("id" => "themeZee_ads_header",
					"name" => __('Header Banner', 'zeeDynamicPro_language'));
					
		$themezee_sections[] = array("id" => "themeZee_ads_banner",
					"name" => __('125x125 Sidebar Banner', 'zeeDynamicPro_language'));
					
		return $themezee_sections;
	}
	
	function themezee_settings_ads() {

		$default_banner = get_template_directory_uri() . '/images/ad_125x125.png';
		$themezee_settings = array();
		
		### Header Banner Settings
		#######################################################################################
		$themezee_settings[] = array("name" => __('About Header Banner', 'zeeDynamicPro_language'),
						"desc" => __('Please note: You can display your configured header banner in the header area if configured on <b>General tab.</b>', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_header_information",
						"type" => "info",
						"std" => '',
						"section" => "themeZee_ads_header");
						
		$themezee_settings[] = array("name" => __('468x60 Adbanner Image URL', 'zeeDynamicPro_language'),
						"desc" => __('Enter the image URL for the banner ad.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_header_image",
						"std" => '',
						"type" => "image",
						"section" => "themeZee_ads_header");
						
		$themezee_settings[] = array("name" => __('468x60 Adbanner Destination URL', 'zeeDynamicPro_language'),
						"desc" => __('Enter the URL where the banner ad points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_header_url",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_header");
						
		### 125x125 Banner Settings
		#######################################################################################
		$themezee_settings[] = array("name" => __('About Sidebar Banner', 'zeeDynamicPro_language'),
						"desc" => __('Please note: You can display your 125x125 banner ads configured below with the <b>Banner Ads Widget</b> on Appearance > Widgets.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_information",
						"type" => "info",
						"std" => '',
						"section" => "themeZee_ads_banner");
						
		$themezee_settings[] = array("name" => __('Rotate banners?', 'zeeDynamicPro_language'),
						"desc" => __('Check this to randomly rotate the ad spots.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_rotate",
						"std" => "false",
						"type" => "checkbox",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #1',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_1",
						"std" => $default_banner,
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" =>  __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #1',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_1",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #2',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_2",
						"std" => $default_banner,
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #2',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_2",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #3',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_3",
						"std" => $default_banner,
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #3',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_3",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #4',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_4",
						"std" => $default_banner,
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #4',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_4",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #5',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_5",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #5',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_5",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #6',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_6",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #6',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_6",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");
						
		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #7',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_7",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #7',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_7",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");

		$themezee_settings[] = array("name" => __('Ad Spot Image URL', 'zeeDynamicPro_language') . ' #8',
						"desc" => __('Enter the image URL for this ad spot.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_image_8",
						"std" => "",
						"type" => "image",
						"section" => "themeZee_ads_banner");
							
		$themezee_settings[] = array("name" => __('Ad Spot Destination', 'zeeDynamicPro_language') . ' #8',
						"desc" => __('Enter the URL where this ad spot points to.', 'zeeDynamicPro_language'),
						"id" => "themeZee_ads_url_8",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_ads_banner");
	
		return $themezee_settings;
	}

?>