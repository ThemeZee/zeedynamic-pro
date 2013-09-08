<?php
/***
 * Setup Theme Options
 *
 * Includes all settings from the /includes/options/settings/ folder
 * (setting arrays are splitted in multiple files for reasons of clarity)
 *
 * Defines the theme options array containing all tabs, sections and settings.
 * Contain functions to display the welcome screen and sidebar content on options screen.
 *
 */

// Include all Setting Files
require( get_template_directory() . '/includes/options/settings/settings-general.php' );
require( get_template_directory() . '/includes/options/settings/settings-colors.php' );
require( get_template_directory() . '/includes/options/settings/settings-fonts.php' );
require( get_template_directory() . '/includes/options/settings/settings-frontpage.php' );
require( get_template_directory() . '/includes/options/settings/settings-social.php' );
require( get_template_directory() . '/includes/options/settings/settings-ads.php' );


// Creates theme options array with all sections and settings
function themezee_options_array() {

	/* Section and Setting functions come from setting files included above */
	
	$theme_options = array();
	
	$theme_options['general'] = array(
			"name" => __('General', 'zeeDynamicPro_language'),
			"sections" => themezee_sections_general(),
			"settings" => themezee_settings_general());
	
	$theme_options['colors'] = array(
			"name" => __('Colors', 'zeeDynamicPro_language'),
			"sections" => themezee_sections_colors(),
			"settings" => themezee_settings_colors());
			
	$theme_options['fonts'] = array(
			"name" => __('Fonts', 'zeeDynamicPro_language'),
			"sections" => themezee_sections_fonts(),
			"settings" => themezee_settings_fonts());
			
	$theme_options['frontpage'] = array(
			"name" => __('Front Page', 'zeeDynamicPro_language'),
			"sections" => themezee_sections_frontpage(),
			"settings" => themezee_settings_frontpage());
	
	$theme_options['social'] = array(
			"name" => __('Social Media', 'zeeDynamicPro_language'),
			"sections" => themezee_sections_social(),
			"settings" => themezee_settings_social());	
			
	$theme_options['ads'] = array(
			"name" => __('Ads', 'zeeDynamicPro_language'),
			"sections" => themezee_sections_ads(),
			"settings" => themezee_settings_ads());
	
	return $theme_options;
}
	

// Display Sidebar
function themezee_options_sidebar() {
	$theme_data = wp_get_theme(); 
?>
	<div class="zee_options_sidebar">
	
		<dl><dt><h4><?php _e('Theme Data', 'zeeDynamicPro_language'); ?></h4></dt>
			<dd>
				<p><?php _e('Name', 'zeeDynamicPro_language'); ?>: <?php echo $theme_data->Name; ?><br/>
				<?php _e('Version', 'zeeDynamicPro_language'); ?>: <b><?php echo $theme_data->Version; ?></b>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('(Changelog)', 'zeeDynamicPro_language'); ?></a><br/>
				<?php _e('Author', 'zeeDynamicPro_language'); ?>: <a href="http://themezee.com/" target="_blank">ThemeZee</a><br/>
				</p>
			</dd>
		</dl>
		
		<dl><dt><h4><?php echo $theme_data->Name; ?> <?php _e('Quick Links', 'zeeDynamicPro_language'); ?> </h4></dt>
			<dd>
				<ul>
					<li><a href="http://themezee.com/pro-themes/" target="_blank"><?php _e('Check Theme Updates', 'zeeDynamicPro_language'); ?></a></li>
					<li><a href="http://themezee.com/docs/" target="_blank"><?php _e('Theme Documentation', 'zeeDynamicPro_language'); ?></a></li>
					<li><a href="http://themezee.com/forums/" target="_blank"><?php _e('Support Forum', 'zeeDynamicPro_language'); ?></a></li>
				</ul>
			</dd>
		</dl>
		
		<dl><dt><h4><?php _e('Help to translate', 'zeeDynamicPro_language'); ?> </h4></dt>
			<dd>
				<p><?php _e('You want to use this WordPress theme in your native language? Then help out to translate it!', 'zeeDynamicPro_language'); ?></p>
				<ul>
					<li><a href="http://translate.themezee.org/projects/zeedynamic" target="_blank"><?php _e('Join the Online Translation Project', 'zeeDynamicPro_language'); ?></a></li>
				</ul>
			</dd>
		</dl>
				
		<dl><dt><h4><?php _e('Subscribe Now', 'zeeDynamicPro_language'); ?></h4></dt>
			<dd>
				<p><?php _e('Subscribe now and get informed about each <b>Theme Release</b> from ThemeZee.', 'zeeDynamicPro_language'); ?></p>
				<ul class="subscribe">
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/rss.png"/><a href="http://themezee.com/feed/" target="_blank"><?php _e('RSS Feed', 'zeeDynamicPro_language'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/email.png"/><a href="http://feedburner.google.com/fb/a/mailverify?uri=Themezee" target="_blank"><?php _e('Email Subscription', 'zeeDynamicPro_language'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/twitter.png"/><a href="http://twitter.com/ThemeZee" target="_blank"><?php _e('Follow me on Twitter', 'zeeDynamicPro_language'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/facebook.png"/><a href="http://www.facebook.com/ThemeZee" target="_blank"><?php _e('Become a Facebook Fan', 'zeeDynamicPro_language'); ?></a></li>
				</ul>
			</dd>
		</dl>
	</div>
	<div class="clear"></div>
<?php
}


// Display Welcome Page
function themezee_options_welcome_page() { 
	$theme_data = wp_get_theme();
?>
	<div id="zee_welcome">
		<h3><?php _e('Thank you for installing this theme!', 'zeeDynamicPro_language'); ?></h3>
		<div class="container">
			<h1><?php _e('Welcome to', 'zeeDynamicPro_language'); ?> <?php echo $theme_data->Name; ?></h1>
			<div class="zee_intro">
				<?php _e("First of all, the theme options might alarm you, <b>but don't panic</b>. Everything is organized and documented well enough for you.", 'zeeDynamicPro_language'); ?>
			</div>
		</div>
		<div class="welcome_halfed">
			<div class="welcome_left">
				<h3><?php _e('Learn more about ', 'zeeDynamicPro_language'); ?> <?php echo $theme_data->Name; ?></h3>
				<div class="container">
					<h2><?php _e('Theme Documentation', 'zeeDynamicPro_language'); ?></h2>
					<p><?php _e('The <b>Theme Docs</b> provides a lot of tutorials to install and configure your theme and learn everything about WordPress and ThemeZee Themes.', 'zeeDynamicPro_language'); ?></p>
					<p><a class="welcome_button" href="http://themezee.com/docs/" target="_blank"><?php _e('Visit Theme Docs', 'zeeDynamicPro_language'); ?></a>
					</p>
				</div>
			</div>
			<div class="welcome_right">
				<h3><?php _e('Need any help?', 'zeeDynamicPro_language'); ?></h3>
				<div class="container">
					<h2><?php _e('Theme Support Forum', 'zeeDynamicPro_language'); ?></h2>
					<p><?php _e('If you have any questions beyond the theme documentation, just jump over to the <b>Support Forum</b> and ask for help!', 'zeeDynamicPro_language'); ?></p>
					<p><a class="welcome_button" href="http://themezee.com/forums/" target="_blank"><?php _e('Visit Support Forum', 'zeeDynamicPro_language'); ?></a>
					</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php
}
?>