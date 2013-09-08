		
	<article id="post-<?php the_ID(); ?>" <?php post_class('type-frontpage-post'); ?>>
		
		<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="postmeta"><?php themezee_display_postmeta(); ?></div>
		
		<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_post_thumbnail('featured_image'); ?></a>
		
		<div class="entry clearfix">
			<?php the_excerpt(); ?>
			<a href="<?php esc_url(the_permalink()) ?>" class="read-more"><?php _e('Read more', 'zeeDynamicPro_language'); ?></a>
		</div>
		
		<div class="postinfo clearfix"><?php themezee_display_postinfo_index(); ?></div>

	</article>