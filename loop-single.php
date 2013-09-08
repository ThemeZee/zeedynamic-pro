
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
		<div class="postmeta"><?php themezee_display_postmeta(); ?></div>
		
		<?php the_post_thumbnail('featured_image'); ?>
			
		<div class="entry clearfix">
			<?php the_content(); ?>
			<!-- <?php trackback_rdf(); ?> -->
			<div class="page-links"><?php wp_link_pages(); ?></div>			
		</div>
		
		<div class="postinfo clearfix"><?php themezee_display_postinfo_single(); ?></div>

	</article>