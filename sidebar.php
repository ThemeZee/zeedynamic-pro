
<section id="sidebar" class="secondary clearfix" role="complementary">
	<?php themezee_widgets_before(); // hook before sidebar widgets ?>

	<?php
		// Check if page and active Sidebar Pages area
		if(is_page() && is_active_sidebar('sidebar-pages')) : 
		
			dynamic_sidebar('sidebar-pages');
			
		// Check if Main Sidebar has widgets
		elseif(is_active_sidebar('sidebar-main')) : 
		
			dynamic_sidebar('sidebar-main');
		
		// Show hint where to add widgets
		else : ?>

		<aside class="widget">
			<h3 class="widgettitle"><?php _e('Widget Area', 'zeeDynamicPro_language'); ?></h3>
			<p></p>
		</aside>
	
		<?php endif; ?>

	<?php themezee_widgets_after(); // hook after sidebar widgets ?>
</section>
