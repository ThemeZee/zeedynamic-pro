<?php
/***
 * Magazine Posts Single Widget
 *
 * Display the latest posts from a selected category in a single layout. 
 * Intented to be used in the Magazine Homepage widget area to built a magazine layouted page.
 *
 * @package zeeDynamic
 */

class zeeDynamic_Pro_Magazine_Posts_Single_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 */
	function __construct() {
		
		// Setup Widget
		parent::__construct(
			'zeedynamic-magazine-posts-single', // ID
			sprintf( esc_html__( 'Magazine Posts: Single (%s)', 'zeedynamic-pro' ), 'zeeDynamic Pro' ), // Name
			array( 
				'classname' => 'zeedynamic_magazine_posts_single', 
				'description' => esc_html__( 'Displays a single post from a selected category. Please use this widget ONLY in the Magazine Homepage widget area.', 'zeedynamic-pro' ) 
			) // Args
		);

		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}
	
	
	/**
	 * Set default settings of the widget
	 */
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'meta_date'			=> true,
			'meta_author'		=> true,
			'meta_category'		=> true,
		);
		
		return $defaults;
		
	}

	
	/**
	 * Main Function to display the widget
	 * 
	 * @uses this->render()
	 * 
	 * @param array $args / Parameters from widget area created with register_sidebar()
	 * @param array $instance / Settings for this widget instance
	 */
	function widget( $args, $instance ) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_zeedynamic_magazine_posts_single', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		// Display Widget from Cache if exists
		if ( isset( $cache[ $this->id ] ) ) {
			echo $cache[ $this->id ];
			return;
		}
		
		// Start Output Buffering
		ob_start();

		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() );
		
		// Output
		echo $args['before_widget'];
	?>
		<div class="widget-magazine-posts-single widget-magazine-posts clearfix">

			<?php // Display Title
			$this->widget_title( $args, $settings ); ?>
			
			<div class="widget-magazine-posts-content">
			
				<?php $this->render( $settings ); ?>
				
			</div>
			
		</div>
	<?php
		echo $args['after_widget'];
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_zeedynamic_magazine_posts_single', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	
	/**
	 * Renders the Widget Content
	 *
	 * Switches between horizontal and vertical layout style based on widget settings
	 * 
	 * @uses this->magazine_posts_horizontal() or this->magazine_posts_vertical()
	 * @used-by this->widget()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function render( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 1,
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;
		
		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter( 'excerpt_length', 'zeedynamic_magazine_posts_excerpt_length' );
			
			// Display Posts
			while( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
					<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
						<?php the_post_thumbnail(); ?>
					</a>
					
					<header class="entry-header">

						<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
						
						<?php $this->entry_meta( $settings ); ?>
					
					</header><!-- .entry-header -->

					<div class="entry-content clearfix">
						
						<?php the_excerpt(); ?>
						<?php zeedynamic_more_link(); ?>
					
					</div><!-- .entry-content -->

				</article>
			
			<?php 
			endwhile;
			
			// Remove excerpt filter
			remove_filter('excerpt_length', 'zeedynamic_magazine_posts_excerpt_length');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	}
	
	/**
	 * Displays Entry Meta of Posts
	 */
	function entry_meta( $settings ) { 

		$postmeta = '';
		
		if( true == $settings['meta_date'] ) {
		
			$postmeta .= zeedynamic_meta_date();
			
		}
		
		if( true == $settings['meta_author'] ) {
		
			$postmeta .= zeedynamic_meta_author();
			
		}
		
		if( true == $settings['meta_category'] ) {
		
			$postmeta .= zeedynamic_meta_category();
			
		}
		
		if( $postmeta ) {
		
			echo '<div class="entry-meta">' . $postmeta . '</div>';
			
		}
	
	} // entry_meta()
	
	
	/**
	 * Displays Widget Title
	 */
	function widget_title( $args, $settings ) {
		
		// Add Widget Title Filter
		$widget_title = apply_filters( 'widget_title', $settings['title'], $settings, $this->id_base );
		
		if( ! empty( $widget_title ) ) :

			// Link Category Title
			if( $settings['category'] > 0 ) : 
			
				// Set Link URL and Title for Category
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'zeedynamic-pro' ), get_cat_name( $settings['category'] ) );
				$link_url = esc_url( get_category_link( $settings['category'] ) );
				
				// Display Widget Title with link to category archive
				echo '<div class="widget-header">';
				echo '<h1 class="widget-title"><a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a></h1>';
				echo '</div>';
			
			else:
				
				// Display default Widget Title without link
				echo $args['before_title'] . $widget_title . $args['after_title']; 
			
			endif;
			
		endif;

	} // widget_title()
	
	
	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance / New Settings for this widget instance
	 * @param array $old_instance / Old Settings for this widget instance
	 * @return array $instance
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['category'] = (int)$new_instance['category'];
		$instance['meta_date'] = !empty($new_instance['meta_date']);
		$instance['meta_author'] = !empty($new_instance['meta_author']);
		$instance['meta_category'] = !empty($new_instance['meta_category']);
		
		$this->delete_widget_cache();
		
		return $instance;
	}
	
	
	/**
	 * Displays Widget Settings Form in the Backend
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function form( $instance ) {
	
		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() );
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'zeedynamic-pro' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $settings['title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'zeedynamic-pro' ); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'zeedynamic-pro' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category'],
					'name'               => $this->get_field_name('category'),
					'id'                 => $this->get_field_id('category')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'meta_date' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_date'] ) ; ?> id="<?php echo $this->get_field_id( 'meta_date' ); ?>" name="<?php echo $this->get_field_name( 'meta_date' ); ?>" />
				<?php esc_html_e( 'Display post date', 'zeedynamic-pro' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'meta_author' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_author'] ) ; ?> id="<?php echo $this->get_field_id( 'meta_author' ); ?>" name="<?php echo $this->get_field_name( 'meta_author' ); ?>" />
				<?php esc_html_e( 'Display post author', 'zeedynamic-pro' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'meta_category' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_category'] ) ; ?> id="<?php echo $this->get_field_id( 'meta_category' ); ?>" name="<?php echo $this->get_field_name( 'meta_category' ); ?>" />
				<?php esc_html_e( 'Display post category', 'zeedynamic-pro' ); ?>
			</label>
		</p>
		
<?php
	} // form()
	
	
	/**
	 * Delete Widget Cache
	 */
	public function delete_widget_cache() {
		
		wp_cache_delete( 'widget_zeedynamic_magazine_posts_single', 'widget' );
		
	}
	
}

// Register Widget
add_action( 'widgets_init', 'zeedynamic_pro_register_magazine_posts_single_widget' );

function zeedynamic_pro_register_magazine_posts_single_widget() {

	register_widget( 'zeeDynamic_Pro_Magazine_Posts_Single_Widget' );
	
}