
<?php // Check if there are footer widgets
	if(is_active_sidebar('footer-widgets-left') 
		or is_active_sidebar('footer-widgets-center-left')
		or is_active_sidebar('footer-widgets-center-right')
		or is_active_sidebar('footer-widgets-right')) : 
?>
		
	<div id="footer-widgets-bg">
	
		<div id="footer-widgets-wrap" class="container">
		
			<div id="footer-widgets" class="clearfix">
			
				<div class="footer-widget-column">
					<?php dynamic_sidebar('footer-widgets-left'); ?>
				</div>
				<div class="footer-widget-column">
					<?php dynamic_sidebar('footer-widgets-center-left'); ?>
				</div>
				<div class="footer-widget-column">
					<?php dynamic_sidebar('footer-widgets-center-right'); ?>
				</div>
				<div class="footer-widget-column">
					<?php dynamic_sidebar('footer-widgets-right'); ?>
				</div>
				
			</div>
			
		</div>
	
	</div>
	
<?php endif; ?>
