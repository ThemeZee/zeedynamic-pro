<?php
/***
 * Header Content
 *
 * This template displays the content in the right-hand header area based on theme options.
 * You can choose from "Nothing, Search Form, Banner Ad, Social Media Icons or Textline" to display.
 *
 */

// Get Theme Options
$options = get_option('themezee_options');

$header_content = esc_attr($options['themeZee_general_header_content']);

switch ($header_content): 


	// Display Search Form
	case 'search': ?>
		<div class="header-search">
			<?php get_search_form(true); ?> 
		</div>
	<?php
	break;
	
	
	// Display Banner Ad
	case 'ads': ?>
		<div class="header-banner">
			<?php if( isset($options['themeZee_ads_header_image']) and $options['themeZee_ads_header_image'] <> "" ) : ?>
				<a href="<?php echo esc_url($options['themeZee_ads_header_url']); ?>"><img src="<?php echo esc_url($options['themeZee_ads_header_image']); ?>" alt="banner" /></a>
			<?php endif; ?>
		</div>
	<?php
	break;
	
	
	// Display Text Line
	case 'text': ?>
		<div class="header-text">
			<?php if( isset($options['themeZee_general_header_content_text']) and $options['themeZee_general_header_content_text'] <> "" ) : ?>
				<p><?php echo $options['themeZee_general_header_content_text']; ?></p>
			<?php endif; ?>
		</div>
	<?php
	break;
	
	
	// Display Social Media Icons
	case 'social': 
	
		// Set Icon URL
		$url = get_template_directory_uri() . '/images/icons';
		$networks = '';

		// Twitter Button
		if ( isset($options['themeZee_social_twitter']) and $options['themeZee_social_twitter'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_twitter']) .'"><img src="'. $url .'/twitter.png" alt="twitter" /></a>';
		endif;
		
		// Facebook Button
		if ( isset($options['themeZee_social_facebook']) and $options['themeZee_social_facebook'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_facebook']) .'"><img src="'. $url .'/facebook.png" alt="facebook" /></a>';
		endif;
		
		// GooglePlus Button
		if ( isset($options['themeZee_social_googleplus']) and $options['themeZee_social_googleplus'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_googleplus']) .'"><img src="'. $url .'/googleplus.png" alt="googleplus" /></a>';
		endif;
		
		// Pinterest Button
		if ( isset($options['themeZee_social_pinterest']) and $options['themeZee_social_pinterest'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_pinterest']) .'"><img src="'. $url .'/pinterest.png" alt="pinterest" /></a>';
		endif;
		
		// Instagram Button
		if ( isset($options['themeZee_social_instagram']) and $options['themeZee_social_instagram'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_instagram']) .'"><img src="'. $url .'/instagram.png" alt="instagram" /></a>';
		endif;
		
		// LinkedIn Button
		if ( isset($options['themeZee_social_linkedin']) and $options['themeZee_social_linkedin'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_linkedin']) .'"><img src="'. $url .'/linkedin.png" alt="linkedin" /></a>';
		endif;
		
		// Blogger Button
		if ( isset($options['themeZee_social_blogger']) and $options['themeZee_social_blogger'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_blogger']) .'"><img src="'. $url .'/blogger.png" alt="blogger" /></a>';
		endif;
		
		// Tumblr Button
		if ( isset($options['themeZee_social_tumblr']) and $options['themeZee_social_tumblr'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_tumblr']) .'"><img src="'. $url .'/tumblr.png" alt="tumblr" /></a>';
		endif;
		
		// Typepad Button
		if ( isset($options['themeZee_social_typepad']) and $options['themeZee_social_typepad'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_typepad']) .'"><img src="'. $url .'/typepad.png" alt="typepad" /></a>';
		endif;
		
		// Wordpress Button
		if ( isset($options['themeZee_social_wordpress']) and $options['themeZee_social_wordpress'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_wordpress']) .'"><img src="'. $url .'/wordpress.png" alt="wordpress" /></a>';
		endif;

		// Flickr Button
		if ( isset($options['themeZee_social_flickr']) and $options['themeZee_social_flickr'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_flickr']) .'"><img src="'. $url .'/flickr.png" alt="flickr" /></a>';
		endif;
		
		// Soundcloud Button
		if ( isset($options['themeZee_social_soundcloud']) and $options['themeZee_social_soundcloud'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_soundcloud']) .'"><img src="'. $url .'/soundcloud.png" alt="soundcloud" /></a>';
		endif;
		
		// Spotify Button
		if ( isset($options['themeZee_social_spotify']) and $options['themeZee_social_spotify'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_spotify']) .'"><img src="'. $url .'/spotify.png" alt="spotify" /></a>';
		endif;
		
		// Last.fm Button
		if ( isset($options['themeZee_social_lastfm']) and $options['themeZee_social_lastfm'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_lastfm']) .'"><img src="'. $url .'/lastfm.png" alt="lastfm" /></a>';
		endif;
		
		// Youtube Button
		if ( isset($options['themeZee_social_youtube']) and $options['themeZee_social_youtube'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_youtube']) .'"><img src="'. $url .'/youtube.png" alt="youtube" /></a>';
		endif;
		
		// Vimeo Button
		if ( isset($options['themeZee_social_vimeo']) and $options['themeZee_social_vimeo'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_vimeo']) .'"><img src="'. $url .'/vimeo.png" alt="vimeo" /></a>';
		endif;
		
		// DeviantART Button
		if ( isset($options['themeZee_social_deviantart']) and $options['themeZee_social_deviantart'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_deviantart']) .'"><img src="'. $url .'/deviantart.png" alt="deviantart" /></a>';
		endif;
		
		// Dribbble Button
		if ( isset($options['themeZee_social_dribbble']) and $options['themeZee_social_dribbble'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_dribbble']) .'"><img src="'. $url .'/dribbble.png" alt="dribbble" /></a>';
		endif;
		
		// Delicious Button
		if ( isset($options['themeZee_social_delicious']) and $options['themeZee_social_delicious'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_delicious']) .'"><img src="'. $url .'/delicious.png" alt="delicious" /></a>';
		endif;

		// Digg Button
		if ( isset($options['themeZee_social_digg']) and $options['themeZee_social_digg'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_digg']) .'"><img src="'. $url .'/digg.png" alt="digg" /></a>';
		endif;
		
		// StumbleUpon Button
		if ( isset($options['themeZee_social_stumbleupon']) and $options['themeZee_social_stumbleupon'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_stumbleupon']) .'"><img src="'. $url .'/stumbleupon.png" alt="stumbleupon" /></a>';
		endif;
		
		// RSS Button
		if ( isset($options['themeZee_social_rss']) and $options['themeZee_social_rss'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_rss']) .'"><img src="'. $url .'/rss.png" alt="rss" /></a>';
		endif;
		
		// Email Button
		if ( isset($options['themeZee_social_email']) and $options['themeZee_social_email'] <> '' ) :
			$networks .= '<a href="'. esc_attr($options['themeZee_social_email']) .'"><img src="'. $url .'/email.png" alt="email" /></a>';
		endif;
		
		// Friendfeed Button
		if ( isset($options['themeZee_social_friendfeed']) and $options['themeZee_social_friendfeed'] <> '' ) :
			$networks .= '<a href="'. esc_url($options['themeZee_social_friendfeed']) .'"><img src="'. $url .'/friendfeed.png" alt="friendfeed" /></a>';
		endif;
		
		// Skype Button
		if ( isset($options['themeZee_social_skype']) and $options['themeZee_social_skype'] <> '' ) :
			$networks .= '<a href="'. esc_attr($options['themeZee_social_skype']) .'"><img src="'. $url .'/skype.png" alt="skype" /></a>';
		endif;
		
		?>
		
		<div class="header-icons">
			<?php echo $networks; ?> 
		</div>
	<?php
	break;
	
	default: break;
	
endswitch;

?>