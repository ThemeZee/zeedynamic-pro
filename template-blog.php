<?php
/*
Template Name: Blog (full posts)
*/
?>
<?php get_header(); ?>
	
	<div id="wrap" class="container template-blog">
	
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
	global $more;
	$more = 0; 
?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'index' );
		
			endwhile;
			
		themezee_display_pagination();

		endif; ?>
			
		</section>
	
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	