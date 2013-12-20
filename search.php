<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php if (have_posts()) : ?>
			<h2 id="search-title" class="archive-title">
				<?php printf( __( 'Search Results for: %s', 'zeeDynamicPro_language' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
		
		<?php while (have_posts()) : the_post();
		
				get_template_part( 'loop', 'index' );
		
			endwhile;
			
			themezee_display_pagination();

		else : ?>

			<h2 id="search-title" class="archive-title">
				<?php printf( __( 'Search Results for: %s', 'zeeDynamicPro_language' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
			
			<div class="post">
				
				<div class="entry">
					<p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'zeeDynamicPro_language'); ?></p>
				</div>
				
			</div>

			<?php endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	