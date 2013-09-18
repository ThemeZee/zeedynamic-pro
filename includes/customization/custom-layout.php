<?php 
add_action('wp_head', 'themezee_css_layout');
function themezee_css_layout() {
	
	echo '<style type="text/css">';
	$options = get_option('zeedynamic_options');
	
	// Wide Layout?
	if ( isset($options['themeZee_general_theme_layout']) and $options['themeZee_general_theme_layout'] == 'wide' ) {
	
		echo '
			@media only screen and (min-width: 60em) {
				#wrapper {
					margin: 0;
					width: 100%;
					max-width: 100%;
					background: none;
				}
				.container {
					max-width: 1340px;
					width: 92%;
					margin: 0 auto;
					-webkit-box-sizing: border-box;
					-moz-box-sizing: border-box;
					box-sizing: border-box;
				}
				#wrap {
					padding: 1.5em 0;
				}
			}
			@media only screen and (max-width: 70em) {
				.container {
					width: 94%;
				}
			}
			@media only screen and (max-width: 65em) {
				.container {
					width: 96%;
				}
			}
			@media only screen and (max-width: 60em) {
				.container {
					width: 100%;
				}
				#wrap {
					padding: 1.5em 1.5em 0;
				}
			}
		';
	}
	
	// Switch Sidebar to left?
	if ( isset($options['themeZee_general_sidebars']) and $options['themeZee_general_sidebars'] == 'left' ) {
	
		echo '
			@media only screen and (min-width: 60em) {
				#content {
					float: right;
					padding-right: 0;
					padding-left: 1.5em;
				}
				#sidebar {
					margin-left: 0;
					margin-right: 72%;
				}
			}
		';
	}
	
	// Add Custom CSS
	if ( isset($options['themeZee_general_css']) and $options['themeZee_general_css'] <> '' ) {
		echo wp_kses_post($options['themeZee_general_css']);
	}
	
	echo '</style>';
}