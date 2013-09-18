		
		<?php get_sidebar('footer'); ?>
		
		<?php themezee_footer_before(); // hook before #footer ?>
		<div id="footer-wrap">
			
			<footer id="footer" class="container clearfix" role="contentinfo">
				<?php 
					$options = get_option('zeedynamic_options');
					if ( isset($options['themeZee_general_footer']) and $options['themeZee_general_footer'] <> "" ) :
						echo do_shortcode(wp_kses_post($options['themeZee_general_footer']));
					endif;
				?>
				<div id="credit-link"><?php themezee_credit_link(); ?></div>
			</footer>
			
		</div>
		<?php themezee_footer_after(); // hook after #footer ?>
	
</div><!-- end #wrapper -->
<?php themezee_wrapper_after(); // hook after #wrapper ?>

<?php wp_footer(); ?>
</body>
</html>