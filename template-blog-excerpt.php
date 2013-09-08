<?php
/*
Template Name: Blog Excerpt (summary)
*/
?>
<?php get_header(); ?>
	
	<div id="wrap" class="container template-blog-excerpt">
	
		<section id="content" class="primary" role="main">
		
<?php 
	// Get Pagination query
    if ( get_query_var('paged') )
		$paged = (int)get_query_var('paged');
	elseif ( get_query_var('page') ) 
		$paged = (int)get_query_var('page');
	else 
		$paged = 1;
	
	// Get Blog Posts
	query_posts('post_type=post&paged='.$paged);
?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'excerpt' );
		
			endwhile;
			
		themezee_display_pagination();

		endif; ?>
			
		</section>
	
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	