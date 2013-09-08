<?php
// Add ThemeZee Recent Posts Widget
class themezee_Tabbed_Widget extends WP_Widget {

	var $number = 7;
	var $thumbs = 0;
	
	function __construct() {
		$widget_ops = array('classname' => 'themezee_tabbed', 'description' => __('Show recent posts with post thumbnails.', 'zeeDynamicPro_language') );
		$control_ops = array('width' => 360, 'id_base' => 'themezee_tabbed');
		$this->WP_Widget('themezee_tabbed', 'ThemeZee Tabbed Widget', $widget_ops, $control_ops);

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'widget_tabbed_javascript') );
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}
	
	function widget_tabbed_javascript($args) { ?>
		<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function($) {
				
					$.fn.tabbedWidget = function( options ) {

						var instance = '#' + options.instance;
						
						$(instance + ' .widget-tabnavi li a:first').addClass('current-tab'); //add active class to the first li
						$(instance + ' .tabdiv').hide(); //hide all content classes.
						$(instance + ' .tabdiv:first').show(); //show only first div content
					
						$(instance + ' .widget-tabnavi li a').click(function(){ //add the click function
							$(instance + ' .widget-tabnavi li a').removeClass('current-tab'); //remove current-tab class from previous li
							$(this).addClass('current-tab'); //add current-tab class to the active li.
							$(instance + ' .tabdiv').hide(); //hide all content classes
							var activeTab = $(this).attr('href'); //find the href attribute of the active tab
							$(activeTab).fadeIn('fast'); //fade in the content of active tab
							return false;
						});
					};
				});
			//]]>
		</script>
<?php
	}
	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_themezee_tabbed', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		
		// Tab Titles
		$tab_one_title = empty( $instance['tab_one_title'] ) ? 'Tab 1' : $instance['tab_one_title'];
		$tab_two_title = empty( $instance['tab_two_title'] ) ? 'Tab 2' : $instance['tab_two_title'];
		$tab_three_title = empty( $instance['tab_three_title'] ) ? 'Tab 3' : $instance['tab_three_title'];
		$tab_four_title = empty( $instance['tab_four_title'] ) ? 'Tab 4' : $instance['tab_four_title'];
		
		// Tab Contents
		$tab_one_content = empty( $instance['tab_one_content'] ) ? 0 : $instance['tab_one_content'];
		$tab_two_content = empty( $instance['tab_two_content'] ) ? 0 : $instance['tab_two_content'];
		$tab_three_content = empty( $instance['tab_three_content'] ) ? 0 : $instance['tab_three_content'];
		$tab_four_content = empty( $instance['tab_four_content'] ) ? 0 : $instance['tab_four_content'];
		
		// Other Variables
		if ( empty( $instance['number'] ) || ! $this->number = absint( $instance['number'] ) )
 			$this->number = 10;
			
		$this->thumbs = (int)$instance['thumbnails'];
		
		// Output Widget
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		
		$i = $args['widget_id'];
		echo "<script type=\"text/javascript\">
				//<![CDATA[
					jQuery(document).ready(function($) {
						$('body').tabbedWidget({'instance'  :  '".$i."'});
					});
				//]]>
				</script>";
	?>
		<div class="widget-tabbed">
			<div class="widget-tabnavi">
				<ul class="widget-tabnav">
				<?php if ( $tab_one_content != 0 ) : ?><li><a href="#<?php echo $i; ?>-tabbed-1"><?php echo $tab_one_title; ?></a></li><?php endif; ?>
				<?php if ( $tab_two_content != 0 ) : ?><li><a href="#<?php echo $i; ?>-tabbed-2"><?php echo $tab_two_title; ?></a></li><?php endif; ?>
				<?php if ( $tab_three_content != 0 ) : ?><li><a href="#<?php echo $i; ?>-tabbed-3"><?php echo $tab_three_title; ?></a></li><?php endif; ?>
				<?php if ( $tab_four_content != 0 ) : ?><li><a href="#<?php echo $i; ?>-tabbed-4"><?php echo $tab_four_title; ?></a></li><?php endif; ?>
				</ul>
			</div>
			
			
			<?php if ( $tab_one_content != 0 ) : ?><div id="<?php echo $i; ?>-tabbed-1" class="tabdiv"><?php echo $this->widget_content($tab_one_content); ?></div><?php endif; ?>
			<?php if ( $tab_two_content != 0 ) : ?><div id="<?php echo $i; ?>-tabbed-2" class="tabdiv"><?php echo $this->widget_content($tab_two_content); ?></div><?php endif; ?>
			<?php if ( $tab_three_content != 0 ) : ?><div id="<?php echo $i; ?>-tabbed-3" class="tabdiv"><?php echo $this->widget_content($tab_three_content); ?></div><?php endif; ?>
			<?php if ( $tab_four_content != 0 ) : ?><div id="<?php echo $i; ?>-tabbed-4" class="tabdiv"><?php echo $this->widget_content($tab_four_content); ?></div><?php endif; ?>
			
		</div>
		
	<?php
		echo $after_widget;
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_themezee_tabbed', $cache, 'widget');
	}
	
	function widget_content($tab) {
	
		switch($tab) {
			
			case 1: // Archives
				$content = '<ul>' . wp_get_archives(apply_filters('zee_widget_tabbed_archives_args', array('type' => 'monthly', 'show_post_count' => 1, 'echo' => 0))) . '</ul>';
			break;
			
			case 2: // Categories
				$cat_args = array('title_li' => '', 'orderby' => 'name', 'show_count' => 1, 'hierarchical' => false, 'echo' => 0);
				$content = '<ul>' . wp_list_categories(apply_filters('zee_widget_tabbed_categories_args', $cat_args)) . '</ul>';
			break;
			
			case 3: // Links
				$content = wp_list_bookmarks(apply_filters('zee_widget_tabbed_links_args', array(
						'title_li' => '', 'title_before' => '<span class="widget_links_cat">', 'title_after' => '</span>', 'category_before' => '', 
						'category_after' => '', 'show_images' => false, 'show_description' => false, 'show_name' => true, 'show_rating' => false, 'echo' => 0)));
			break;
			
			case 4: // Meta
				$content = '<ul>' . wp_register('<li>', '</li>', false) . '<li>' . wp_loginout('', false) . '</li>';
				$content .= '<li><a href="'.get_bloginfo('rss2_url').'" title="'.esc_attr(__('Syndicate this site using RSS 2.0', 'zeeDynamicPro_language')).'">'. __('Entries <abbr title="Really Simple Syndication">RSS</abbr>', 'zeeDynamicPro_language').'</a></li>';
				$content .= '<li><a href="'.get_bloginfo('comments_rss2_url').'" title="'.esc_attr(__('The latest comments to all posts in RSS', 'zeeDynamicPro_language')).'">'. __('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'zeeDynamicPro_language').'</a></li>';
				$content .= '<li><a href="'.esc_url('http://wordpress.org/').'" title="'.esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'zeeDynamicPro_language')).'">'. __( 'WordPress.org', 'zeeDynamicPro_language') .'</a></li>';
				$content .= wp_meta() . '</ul>';
			break;
			
			case 5: // Pages
				$content = '<ul>' . wp_list_pages( apply_filters('zee_widget_tabbed_pages_args', array('title_li' => '', 'echo' => 0) ) ) . '</ul>';
			break;
			
			case 6: // Popular Posts		
				$posts = new WP_Query( apply_filters( 'zee_widget_tabbed_popular_posts_args', array( 'posts_per_page' => $this->number, 'orderby' => 'comment_count', 'order' => 'DESC', 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
				if ($posts->have_posts()) :
					$content = '<ul>';
					while ($posts->have_posts()) : $posts->the_post();
						
						if ( $this->thumbs == 1 ) : // add thumbnail
							$content .= '<li class="widget-thumb"><a href="'. get_permalink() .'" title="'. esc_attr(get_the_title() ? get_the_title() : get_the_ID()) .'">'. get_the_post_thumbnail(get_the_ID(), 'widget_post_thumb') .'</a>';
						else:
							$content .= '<li>';
						endif;
						
						$content .= '<a href="'. get_permalink() .'" title="'. esc_attr(get_the_title() ? get_the_title() : get_the_ID()) .'">';
						if ( get_the_title() ) $content .= get_the_title(); else $content .= get_the_ID();
						$content .= '</a>';
						
						if ( $this->thumbs == 1 ) : // add date
							$content .= '<div class="widget-postmeta"><span class="widget-date">'. get_the_time(get_option('date_format')).'</span></div>';
						endif;
							
						$content .= '</li>';
					endwhile;
					$content .= '</ul>';
				endif;
			break;
			
			case 7: // Recent Comments
				global $comments, $comment;
				$comments = get_comments( apply_filters( 'zee_widget_tabbed_comments_args', array( 'number' => $this->number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
				$content = '<ul class="widget-tabbed-comments">';
				if ( $comments ) {
					foreach ( (array) $comments as $comment) {
						if ( $this->thumbs == 1 ) : // add avatar
							$content .= '<li class="widget-avatar"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_avatar( $comment, 55 ) . '</a>';
						else:
							$content .=  '<li>';
						endif;
						$content .=  sprintf(_x('%1$s on %2$s', 'widgets', 'zeeDynamicPro_language'), get_comment_author_link(), '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
					}
				}
				$content .= '</ul>';
			break;
			
			case 8: // Recent Posts
				$posts = new WP_Query( apply_filters( 'zee_widget_tabbed_recent_posts_args', array( 'posts_per_page' => $this->number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
				if ($posts->have_posts()) :
					$content = '<ul>';
					while ($posts->have_posts()) : $posts->the_post();
						
						if ( $this->thumbs == 1 ) : // add thumbnail
							$content .= '<li class="widget-thumb"><a href="'. get_permalink() .'" title="'. esc_attr(get_the_title() ? get_the_title() : get_the_ID()) .'">'. get_the_post_thumbnail(get_the_ID(), 'widget_post_thumb') .'</a>';
						else:
							$content .= '<li>';
						endif;
						
						$content .= '<a href="'. get_permalink() .'" title="'. esc_attr(get_the_title() ? get_the_title() : get_the_ID()) .'">';
						if ( get_the_title() ) $content .= get_the_title(); else $content .= get_the_ID();
						$content .= '</a>';
						
						if ( $this->thumbs == 1 ) : // add date
							$content .= '<div class="widget-postmeta"><span class="widget-date">'. get_the_time(get_option('date_format')).'</span></div>';
						endif;
							
						$content .= '</li>';
					endwhile;
					$content .= '</ul>';
				endif;
			break;
			
			case 9: // Tag Cloud
				$content = '<div class="tagcloud">';
				$content .= wp_tag_cloud( apply_filters('zee_widget_tabbed_tagcloud_args', array('taxonomy' => 'post_tag', 'echo' => false) ) );
				$content .= "</div>\n";
			break;
			
			default: 
				$content = "Please select the Tab Content in the Widget Settings.";
			break;
		}
		return $content;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? esc_attr($new_instance['title']) : '';
		
		$instance['tab_one_title'] = strip_tags($new_instance['tab_one_title']);
		$instance['tab_two_title'] = strip_tags($new_instance['tab_two_title']);
		$instance['tab_three_title'] = strip_tags($new_instance['tab_three_title']);
		$instance['tab_four_title'] = strip_tags($new_instance['tab_four_title']);
		
		$instance['tab_one_content'] = $new_instance['tab_one_content'] ? (int)$new_instance['tab_one_content'] : 0;
		$instance['tab_two_content'] = $new_instance['tab_two_content'] ? (int)$new_instance['tab_two_content'] : 0;
		$instance['tab_three_content'] = $new_instance['tab_three_content'] ? (int)$new_instance['tab_three_content'] : 0;
		$instance['tab_four_content'] = $new_instance['tab_four_content'] ? (int)$new_instance['tab_four_content'] : 0;
		
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumbnails'] = $new_instance['thumbnails'] ? 1 : 0;

		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_themezee_tabbed', 'widget');
	}
	
	function widget_select_options($tab) {
		$options = '<option ' . selected( $tab, 0 ) .' value="0"></option>
					<option ' . selected( $tab, 1 ) .' value="1">'. __('Archives', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 2 ) .' value="2">'. __('Categories', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 3 ) .' value="3">'. __('Links', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 4 ) .' value="4">'. __('Meta', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 5 ) .' value="5">'. __('Pages', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 6 ) .' value="6">'. __('Popular Posts', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 7 ) .' value="7">'. __('Recent Comments', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 8 ) .' value="8">'. __('Recent Posts', 'zeeDynamicPro_language') . '</option>
					<option ' . selected( $tab, 9 ) .' value="9">'. __('Tag Cloud', 'zeeDynamicPro_language') . '</option>';
		return $options;
	}
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		
		$tab_one_title = isset($instance['tab_one_title']) ? esc_attr($instance['tab_one_title']) : '';
		$tab_two_title = isset($instance['tab_two_title']) ? esc_attr($instance['tab_two_title']) : '';
		$tab_three_title = isset($instance['tab_three_title']) ? esc_attr($instance['tab_three_title']) : '';
		$tab_four_title = isset($instance['tab_four_title']) ? esc_attr($instance['tab_four_title']) : '';
		
		$current_tab_one_content = isset($instance['tab_one_content']) ? (int)$instance['tab_one_content'] : 0;
		$current_tab_two_content = isset($instance['tab_two_content']) ? (int)$instance['tab_two_content'] : 0;
		$current_tab_three_content = isset($instance['tab_three_content']) ? (int)$instance['tab_three_content'] : 0;
		$current_tab_four_content = isset($instance['tab_four_content']) ? (int)$instance['tab_four_content'] : 0;
		
		$number = isset($instance['number']) ? absint($instance['number']) : 7;
		$thumbnails = (isset($instance['thumbnails']) and $instance['thumbnails'] == 1) ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
	
		<div style="background: #eee; padding: 10px; margin-bottom: 10px;">
			<p><label for="<?php echo $this->get_field_id('tab_one_content'); ?>"><strong><?php _e('Tab 1:', 'zeeDynamicPro_language') ?></strong></label>
				<select id='<?php echo $this->get_field_id('tab_one_content'); ?>' name='<?php echo $this->get_field_name('tab_one_content'); ?>'>
					<?php echo $this->widget_select_options($current_tab_one_content); ?>
				</select>
				<label for="<?php echo $this->get_field_id('tab_one_title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?></label>
				<input id="<?php echo $this->get_field_id('tab_one_title'); ?>" name="<?php echo $this->get_field_name('tab_one_title'); ?>" type="text" value="<?php echo $tab_one_title; ?>" /></p>
			</p>
			
			<p><label for="<?php echo $this->get_field_id('tab_one_content'); ?>"><strong><?php _e('Tab 2:', 'zeeDynamicPro_language') ?></strong></label>
				<select id='<?php echo $this->get_field_id('tab_two_content'); ?>' name='<?php echo $this->get_field_name('tab_two_content'); ?>'>
					<?php echo $this->widget_select_options($current_tab_two_content); ?>
				</select>
				<label for="<?php echo $this->get_field_id('tab_two_title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?></label>
				<input id="<?php echo $this->get_field_id('tab_two_title'); ?>" name="<?php echo $this->get_field_name('tab_two_title'); ?>" type="text" value="<?php echo $tab_two_title; ?>" /></p>
			</p>
			
			<p><label for="<?php echo $this->get_field_id('tab_one_content'); ?>"><strong><?php _e('Tab 3:', 'zeeDynamicPro_language') ?></strong></label>
				<select id='<?php echo $this->get_field_id('tab_three_content'); ?>' name='<?php echo $this->get_field_name('tab_three_content'); ?>'>
					<?php echo $this->widget_select_options($current_tab_three_content); ?>
				</select>
				<label for="<?php echo $this->get_field_id('tab_three_title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?></label>
				<input id="<?php echo $this->get_field_id('tab_three_title'); ?>" name="<?php echo $this->get_field_name('tab_three_title'); ?>" type="text" value="<?php echo $tab_three_title; ?>" /></p>
			</p>
			
			<p><label for="<?php echo $this->get_field_id('tab_one_content'); ?>"><strong><?php _e('Tab 4:', 'zeeDynamicPro_language') ?></strong></label>
				<select id='<?php echo $this->get_field_id('tab_four_content'); ?>' name='<?php echo $this->get_field_name('tab_four_content'); ?>'>
					<?php echo $this->widget_select_options($current_tab_four_content); ?>
				</select>
				<label for="<?php echo $this->get_field_id('tab_four_title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?></label>
				<input id="<?php echo $this->get_field_id('tab_four_title'); ?>" name="<?php echo $this->get_field_name('tab_four_title'); ?>" type="text" value="<?php echo $tab_four_title; ?>" /></p>
			</p>
		</div>
		
		<strong><?php _e('Settings for Recent/Popular Posts and Recent Comments', 'zeeDynamicPro_language'); ?></strong>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries:', 'zeeDynamicPro_language'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		<input class="checkbox" type="checkbox" <?php echo $thumbnails; ?> id="<?php echo $this->get_field_id('thumbnails'); ?>" name="<?php echo $this->get_field_name('thumbnails'); ?>" />
		<label for="<?php echo $this->get_field_id('thumbnails'); ?>"><?php _e('Show Thumbnails?', 'zeeDynamicPro_language'); ?></label></p>
<?php
	}
}
register_widget('themezee_Tabbed_Widget');
?>