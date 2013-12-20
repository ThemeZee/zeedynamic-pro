<?php
/*
Template Name: Sitemap Template
*/
?>
<?php get_header(); ?>

	<div id="wrap" class="container clearfix template-sitemap">
		
		<section id="content" class="primary" role="main">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<h2 class="page-title"><span><?php the_title(); ?></span></h2>

				<div class="entry clearfix">
					<?php the_content(); ?>	

		<?php endwhile; ?>

		<?php wp_reset_query(); ?> 
		
					<h2><?php _e('Latest Posts', 'zeeDynamicPro_language'); ?></h2><br/>
					<ul>
					
					<?php query_posts('post_type="post"&post_status="publish"&showposts=9'); ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
						<?php endif; ?>
						<?php wp_reset_query(); ?> 
					</ul>
					
					<h2><?php _e('Pages', 'zeeDynamicPro_language'); ?></h2><br/>
					<ul>
						<?php wp_list_pages('title_li='); ?>
					</ul>
					
					<h2><?php _e('Categories', 'zeeDynamicPro_language'); ?></h2><br/>
					<ul>
						<?php wp_list_categories('title_li=&show_count=1'); ?>
					</ul>
					
					<h2><?php _e('Archives', 'zeeDynamicPro_language'); ?></h2><br/>
					<ul>
						<?php wp_get_archives('show_post_count=true'); ?>
					</ul>
					
					<h2><?php _e('Posts by Category', 'zeeDynamicPro_language'); ?></h2><br/>
						<?php $categories = get_categories( $args ); ?>
						<?php foreach($categories as $cat) : ?>
							<strong><?php _e('Category', 'zeeDynamicPro_language'); ?>: <a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></strong>
								<ul>
								<?php query_posts('post_type="post"&post_status="publish"&cat='. $cat->term_id); ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
									<?php endwhile; ?>
									<?php endif; ?>
									<?php wp_reset_query(); ?> 
								</ul>
					
						<?php endforeach; ?>
				
				</div><!-- end .entry -->
				
			</div><!-- end .type-post -->
			
		<?php endif; ?>
		
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	