<?php
// Add ThemeZee Recent Posts Widget
class themezee_RecentPosts_Widget extends WP_Widget {

	var $excerpt_length = 10;
	
	function __construct() {
		$widget_ops = array('classname' => 'themezee_recent_posts', 'description' => __('Show recent posts with post thumbnails.', 'zeeDynamicPro_language') );
		$this->WP_Widget('themezee_recent_posts', 'ThemeZee Recent Posts Widget', $widget_ops);

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_themezee_recent_posts', 'widget');

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

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
		
		$thumbs = (int)$instance['thumbnails'];
		$excerpt_length = empty( $instance['excerpt_length'] ) ? 0 : $instance['excerpt_length'];
		$postmeta = (int)$instance['postmeta'];

		// Change Excerpt Length
		$this->excerpt_length = $excerpt_length;
		add_filter('excerpt_length', array(&$this, 'widget_excerpt_length')); 
	
		$r = new WP_Query( apply_filters( 'zee_widget_recent_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		
		<div class="widget-recent-posts">
			<ul>
			<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<?php if ( $thumbs == 1 ) : ?>
				<li class="widget-thumb"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php the_post_thumbnail('widget_post_thumb'); ?></a>
				<?php else: ?>
				<li>
				<?php endif; ?>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
				
				<?php 
				if ( $excerpt_length > 0 ) :
					the_excerpt();
				endif;
				
				if ( $postmeta == 1 ) : ?>
					<div class="widget-postmeta">
						<span class="widget-date"><?php the_time(get_option('date_format')); ?></span>
						<span class="widget-comment"><a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'zeeDynamicPro_language'),__('One comment','zeeDynamicPro_language'),__('% comments','zeeDynamicPro_language')); ?></a></span> 
					</div>
				<?php endif; ?>
			</li>
			<?php endwhile; ?>
			</ul>
		</div>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		
		// Remove Excerpt Filter
		remove_filter('excerpt_length',  array(&$this, 'widget_excerpt_length'));

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_themezee_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? esc_attr($new_instance['title']) : '';
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumbnails'] = $new_instance['thumbnails'] ? 1 : 0;
		$instance['excerpt_length'] = (int) $new_instance['excerpt_length'];
		$instance['postmeta'] = $new_instance['postmeta'] ? 1 : 0;
		
		$this->flush_widget_cache();

		return $instance;
	}
	
	function widget_excerpt_length($length) {
		return $this->excerpt_length;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_themezee_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$thumbnails = (isset($instance['thumbnails']) and $instance['thumbnails'] == 1) ? 'checked="checked"' : '';
		$excerpt_length = isset($instance['excerpt_length']) ? absint($instance['excerpt_length']) : 10;
		$postmeta = (isset($instance['postmeta']) and $instance['postmeta'] == 1) ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'zeeDynamicPro_language'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'zeeDynamicPro_language'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		
		<p><input class="checkbox" type="checkbox" <?php echo $thumbnails; ?> id="<?php echo $this->get_field_id('thumbnails'); ?>" name="<?php echo $this->get_field_name('thumbnails'); ?>" />
		<label for="<?php echo $this->get_field_id('thumbnails'); ?>"><?php _e('Show Post Thumbnails?', 'zeeDynamicPro_language'); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt length in number of words:', 'zeeDynamicPro_language'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $excerpt_length; ?>" /></p>

		<p><input class="checkbox" type="checkbox" <?php echo $postmeta; ?> id="<?php echo $this->get_field_id('postmeta'); ?>" name="<?php echo $this->get_field_name('postmeta'); ?>" />
		<label for="<?php echo $this->get_field_id('postmeta'); ?>"><?php _e('Show Postmeta(Date, Comments)?', 'zeeDynamicPro_language'); ?></label></p>
<?php
	}
}
register_widget('themezee_RecentPosts_Widget');
?>