<?php
	
	function themezee_sections_social() {
		$themezee_sections = array();

		$themezee_sections[] = array("id" => "themeZee_buttons",
					"name" => __('Social Media Icons', 'zeeDynamicPro_language'));
					
		return $themezee_sections;
	}
	
	function themezee_settings_social() {
		
		$themezee_settings = array();
		
		### SOCIALMEDIA ICON SETTINGS
		#######################################################################################
						
		$themezee_settings[] = array("name" => __('Information about Social Media Icons', 'zeeDynamicPro_language'),
						"desc" => __('Please note: You can display the Social Icons with the <b>Social Media Widget</b> or in the header area if configured on General tab.', 'zeeDynamicPro_language'),
						"id" => "themeZee_socialmedia_header",
						"type" => "info",
						"std" => '',
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Twitter",
						"desc" => __('Enter the URL to your Twitter Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_twitter",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Facebook",
						"desc" => __('Enter the URL to your Facebook Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_facebook",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Google+",
						"desc" => __('Enter the URL to your Google+ profile.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_googleplus",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Pinterest",
						"desc" => __('Enter the URL to your Pinterest profile.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_pinterest",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Instagram",
						"desc" => __('Enter the URL to your Instagram profile.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_instagram",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "LinkedIn",
						"desc" => __('Enter the URL to your LinkedIn Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_linkedin",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");	
						
		$themezee_settings[] = array("name" => "Blogger",
						"desc" => __('Enter the URL to your Blogger Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_blogger",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");	
						
		$themezee_settings[] = array("name" => "Tumblr",
						"desc" => __('Enter the URL to your Tumblr Blog here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_tumblr",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Typepad",
						"desc" => __('Enter the URL to your Typepad Blog here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_typepad",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Wordpress",
						"desc" => __('Enter the URL to your Wordpress.com Blog here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_wordpress",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Flickr",
						"desc" => __('Enter the URL to your Flickr Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_flickr",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
					
		$themezee_settings[] = array("name" => "Soundcloud",
						"desc" => __('Enter the URL to your Soundcloud Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_soundcloud",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Spotify",
						"desc" => __('Enter the URL to your Spotify Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_spotify",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Last.fm",
						"desc" => __('Enter the URL to your Last.fm Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_lastfm",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Youtube",
						"desc" => __('Enter the URL to your Youtube Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_youtube",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Vimeo",
						"desc" => __('Enter the URL to your Vimeo Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_vimeo",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "DeviantART",
						"desc" => __('Enter the URL to your DeviantART Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_deviantart",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Dribbble",
						"desc" => __('Enter the URL to your Dribbble Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_dribbble",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
		
		$themezee_settings[] = array("name" => "Delicious",
						"desc" => __('Enter the URL to your Delicious Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_delicious",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Digg",
						"desc" => __('Enter the URL to your Digg Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_digg",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "StumpleUpon",
						"desc" => __('Enter the URL to your StumpleUpon Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_stumbleupon",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "RSS URL",
						"desc" => __('Enter your RSS URL (e.g. Feedburner Feed) here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_rss",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Email",
						"desc" => __('Enter your Email URL (e.g. Feedburner Email Subscription) here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_email",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Friendfeed",
						"desc" => __('Enter the URL to your Friendfeed Profile here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_friendfeed",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		$themezee_settings[] = array("name" => "Skype",
						"desc" => __('Enter your Skype Contact here.', 'zeeDynamicPro_language'),
						"id" => "themeZee_social_skype",
						"std" => "",
						"type" => "text",
						"section" => "themeZee_buttons");
						
		return $themezee_settings;
	}

?>