<?php
/***
 * Front Page Template Loading
 *
 * This file loads the right template to be displayed on the front page depending which 
 * content the user wants and has configured in theme options and WordPress reading settings.
 *
 */

	// Get Theme Options
	$options = get_option('zeedynamic_options');

	// Check Theme Options if user wants to display the custom frontpage template (override Reading Settings)
	if ( isset($options['themeZee_frontpage_activate']) and $options['themeZee_frontpage_activate'] == 'true' ) :
		
		locate_template('template-frontpage.php', true);
	
	// Check if static page is selected in the "Front page displays" option on Settings > Reading
	elseif ( get_option('show_on_front') == 'page' ) :
		
		// Get selected Page from Reading Settings
		$template = get_post_meta(get_option( 'page_on_front' ), '_wp_page_template', true);

		// Check if template file exists and if front page = post template
		if( locate_template($template) and $template != 'default' ) :
			
			locate_template($template, true);
			
		else :
		
			locate_template('page.php', true);
			
		endif;
		
	// Display the latest blog posts (default option)
	else:
	
		locate_template('index.php', true);
	
	endif;
	
?>