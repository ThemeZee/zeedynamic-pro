<?php
	// Add Social Media Widget
	class themeZee_SocialMedia_Widget extends WP_Widget {
		function themeZee_SocialMedia_Widget() {
			$widget_ops = array('classname' => 'theme_socialmedia', 'description' => __('Show your Social Media Buttons', 'zeeDynamicPro_language') );
			$this->WP_Widget('theme_socialmedia', 'ThemeZee SocialMedia Buttons Widget', $widget_ops);
		}
	 
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			
			$url = get_template_directory_uri() . '/images/icons';
			$options = get_option('zeedynamic_options');
			$networks = '';
			
			if( isset($instance['target']) and $instance['target'] == 1) :
				$target = 'target="_blank"';
			else:
				$target = '';
			endif;
			
			// Output
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		?>
			<div class="widget-social-icons">
				
			<?php 
				
				// Add hook before social icons
				themezee_socialmedia_widget_before();
				
				// Twitter Button
				if ( isset($options['themeZee_social_twitter']) and $options['themeZee_social_twitter'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_twitter']) .'"><img src="'. $url .'/twitter.png" alt="twitter" /></a>';
				endif;
							
				// Facebook Button
				if ( isset($options['themeZee_social_facebook']) and $options['themeZee_social_facebook'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_facebook']) .'"><img src="'. $url .'/facebook.png" alt="facebook" /></a>';
				endif;
							
				// GooglePlus Button
				if ( isset($options['themeZee_social_googleplus']) and $options['themeZee_social_googleplus'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_googleplus']) .'"><img src="'. $url .'/googleplus.png" alt="googleplus" /></a>';
				endif;
				
				// Pinterest Button
				if ( isset($options['themeZee_social_pinterest']) and $options['themeZee_social_pinterest'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_pinterest']) .'"><img src="'. $url .'/pinterest.png" alt="pinterest" /></a>';
				endif;
				
				// Instagram Button
				if ( isset($options['themeZee_social_instagram']) and $options['themeZee_social_instagram'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_instagram']) .'"><img src="'. $url .'/instagram.png" alt="instagram" /></a>';
				endif;
							
				// LinkedIn Button
				if ( isset($options['themeZee_social_linkedin']) and $options['themeZee_social_linkedin'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_linkedin']) .'"><img src="'. $url .'/linkedin.png" alt="linkedin" /></a>';
				endif;

				// Blogger Button
				if ( isset($options['themeZee_social_blogger']) and $options['themeZee_social_blogger'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_blogger']) .'"><img src="'. $url .'/blogger.png" alt="blogger" /></a>';
				endif;
				
				// Tumblr Button
				if ( isset($options['themeZee_social_tumblr']) and $options['themeZee_social_tumblr'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_tumblr']) .'"><img src="'. $url .'/tumblr.png" alt="tumblr" /></a>';
				endif;
				
				// Typepad Button
				if ( isset($options['themeZee_social_typepad']) and $options['themeZee_social_typepad'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_typepad']) .'"><img src="'. $url .'/typepad.png" alt="typepad" /></a>';
				endif;
				
				// Wordpress Button
				if ( isset($options['themeZee_social_wordpress']) and $options['themeZee_social_wordpress'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_wordpress']) .'"><img src="'. $url .'/wordpress.png" alt="wordpress" /></a>';
				endif;

				// Flickr Button
				if ( isset($options['themeZee_social_flickr']) and $options['themeZee_social_flickr'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_flickr']) .'"><img src="'. $url .'/flickr.png" alt="flickr" /></a>';
				endif;
				
				// Soundcloud Button
				if ( isset($options['themeZee_social_soundcloud']) and $options['themeZee_social_soundcloud'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_soundcloud']) .'"><img src="'. $url .'/soundcloud.png" alt="soundcloud" /></a>';
				endif;
				
				// Spotify Button
				if ( isset($options['themeZee_social_spotify']) and $options['themeZee_social_spotify'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_spotify']) .'"><img src="'. $url .'/spotify.png" alt="spotify" /></a>';
				endif;
				
				// Last.fm Button
				if ( isset($options['themeZee_social_lastfm']) and $options['themeZee_social_lastfm'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_lastfm']) .'"><img src="'. $url .'/lastfm.png" alt="lastfm" /></a>';
				endif;
				
				// Youtube Button
				if ( isset($options['themeZee_social_youtube']) and $options['themeZee_social_youtube'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_youtube']) .'"><img src="'. $url .'/youtube.png" alt="youtube" /></a>';
				endif;
				
				// Vimeo Button
				if ( isset($options['themeZee_social_vimeo']) and $options['themeZee_social_vimeo'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_vimeo']) .'"><img src="'. $url .'/vimeo.png" alt="vimeo" /></a>';
				endif;
				
				// DeviantART Button
				if ( isset($options['themeZee_social_deviantart']) and $options['themeZee_social_deviantart'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_deviantart']) .'"><img src="'. $url .'/deviantart.png" alt="deviantart" /></a>';
				endif;
				
				// Dribbble Button
				if ( isset($options['themeZee_social_dribbble']) and $options['themeZee_social_dribbble'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_dribbble']) .'"><img src="'. $url .'/dribbble.png" alt="dribbble" /></a>';
				endif;
				
				// Delicious Button
				if ( isset($options['themeZee_social_delicious']) and $options['themeZee_social_delicious'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_delicious']) .'"><img src="'. $url .'/delicious.png" alt="delicious" /></a>';
				endif;
				
				// Digg Button
				if ( isset($options['themeZee_social_digg']) and $options['themeZee_social_digg'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_digg']) .'"><img src="'. $url .'/digg.png" alt="digg" /></a>';
				endif;
				
				// StumbleUpon Button
				if ( isset($options['themeZee_social_stumbleupon']) and $options['themeZee_social_stumbleupon'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_stumbleupon']) .'"><img src="'. $url .'/stumbleupon.png" alt="stumbleupon" /></a>';
				endif;
				
				// RSS Button
				if ( isset($options['themeZee_social_rss']) and $options['themeZee_social_rss'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_rss']) .'"><img src="'. $url .'/rss.png" alt="rss" /></a>';
				endif;
				
				// Email Button
				if ( isset($options['themeZee_social_email']) and $options['themeZee_social_email'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_attr($options['themeZee_social_email']) .'"><img src="'. $url .'/email.png" alt="email" /></a>';
				endif;
				
				// Friendfeed Button
				if ( isset($options['themeZee_social_friendfeed']) and $options['themeZee_social_friendfeed'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_url($options['themeZee_social_friendfeed']) .'"><img src="'. $url .'/friendfeed.png" alt="friendfeed" /></a>';
				endif;
				
				// Skype Button
				if ( isset($options['themeZee_social_skype']) and $options['themeZee_social_skype'] <> '' ) :
					$networks .= '<a '.$target.' href="'. esc_attr($options['themeZee_social_skype']) .'"><img src="'. $url .'/skype.png" alt="skype" /></a>';
				endif;

				if($networks == '') {
					_e('Go to WP-Admin-> Appearance-> Theme Options to configure this widget', 'zeeDynamicPro_language');
				} else {
					echo $networks;
				}
				
				// Add hook after social icons
				themezee_socialmedia_widget_after();
			?>
			</div>
		<?php
			echo $after_widget;
		}
	 
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = isset($new_instance['title']) ? esc_attr($new_instance['title']) : '';
			$instance['target'] = isset($new_instance['target']) ? 1 : 0;
			return $instance;
		}
	 
		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
			$target = (isset($instance['target']) and $instance['target'] == 1) ? 'checked="checked"' : '';
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		
			<p><input class="checkbox" type="checkbox" <?php echo $target; ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" />
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Open links in a new window', 'zeeDynamicPro_language'); ?></label></p>
		<?php
		}
	}
	register_widget('themeZee_SocialMedia_Widget');
?>