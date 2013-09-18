<?php
/*
Template Name: Frontpage Template
*/
?>
<?php get_header(); ?>

<?php $options = get_option('zeedynamic_options'); // Get Theme Options from Database ?>
	
	<div id="wrap" class="container template-frontpage">
	
		<section id="content" class="primary" role="main">
		
		<?php // Show Image Slider as frontpage image if option is checked
		if(isset($options['themeZee_frontpage_slider_active']) and $options['themeZee_frontpage_slider_active'] == 'true' ) :

			themezee_display_frontpage_slideshow();
			
		endif; ?>
		
		
		<?php // Display Category Area One (horizontal)
		if(isset($options['themeZee_frontpage_category_one']) and $options['themeZee_frontpage_category_one'] != '0') : 
		
			themezee_display_category_posts_horizontal();
			
		endif; ?>
		
		<?php // Display Category Area Two (boxed)
		if(isset($options['themeZee_frontpage_category_two']) and $options['themeZee_frontpage_category_two'] != '0') : 
		
			themezee_display_category_posts_boxed($options['themeZee_frontpage_category_two']);
			
		endif; ?>
		
		<?php // Display Category Area Three (2 columns)
		if(isset($options['themeZee_frontpage_category_three']) and $options['themeZee_frontpage_category_three'] != '0') : 
		
			themezee_display_category_posts_columns();
			
		endif; ?>
		
		<?php // Display Category Area Four (boxed)
		if(isset($options['themeZee_frontpage_category_five']) and $options['themeZee_frontpage_category_five'] != '0') : 
		
			themezee_display_category_posts_boxed($options['themeZee_frontpage_category_five']);
			
		endif; ?>
		
		<?php // Display latest blog posts on frontpage template
		if(isset($options['themeZee_frontpage_posts_active']) and $options['themeZee_frontpage_posts_active'] == 'true') :
			 
			themezee_display_frontpage_posts();
			 
		endif; ?>

		</section>
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>	