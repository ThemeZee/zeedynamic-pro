<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">

		<h2 id="category-title" class="archive-title">
			<?php printf(__('Category Archives: %s', 'zeeDynamicPro_language'), '<span>' . single_cat_title( '', false ) . '</span>'); ?>
		</h2>

		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'index' );
		
			endwhile;
			
		themezee_display_pagination();

		endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	