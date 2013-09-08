<?php
/***
 * Theme Options Framework
 *
 * Creates the whole Theme Options page using the WordPress Settings API.
 * Contains functions to display options page as well as register and validates settings functions.
 * Theme Options come from $theme_options array created in options-setup.php
 * 
 * Theme Options are separated between tabs, which contain sections, which contain settings.   
 *
 */


// Add Theme Options menu link on Appearance section
add_action('admin_menu', 'themezee_options_add_theme_page');
function themezee_options_add_theme_page() {
	add_theme_page(__('Theme Options', 'zeeDynamicPro_language'), __('Theme Options', 'zeeDynamicPro_language'), 'edit_theme_options', 'themezee', 'themezee_options_page');
}


// Add Scripts and CSS for ThemeZee Options Panel	
add_action('admin_enqueue_scripts', 'themezee_options_scripts');
function themezee_options_scripts() { 
	
	// Load styles and scripts only on themezee page
	if ( isset($_GET['page']) and $_GET['page'] == 'themezee' ) :
		
		// Embed admin css style
		wp_register_style('zee_admin_css', get_template_directory_uri() .'/includes/options/css/theme-options.css');
		wp_enqueue_style( 'zee_admin_css');
		
		// Add Colorpicker and Thickbox style
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style('thickbox');
		
		// Add Image Uploader javascripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		// Add Theme Options javascript
		wp_register_script('themezee_options_js', get_template_directory_uri() .'/includes/options/js/theme-options.js', array('wp-color-picker'), false, true);
		wp_localize_script('themezee_options_js', 'zee_localizing_upload_js', array(
			'use_this_image' => __('Use this Image', 'zeeDynamicPro_language')
		));
		
		wp_enqueue_script('themezee_options_js');
		
	endif;
}


// Display theme options page
function themezee_options_page() { 
	$options = get_option('themezee_options');
	$theme_data = wp_get_theme();
?>
			
	<div class="wrap zee_admin_wrap">  			

		<div id="zee_admin_head">
			<div id="zee_options_logo">
				<a href="http://themezee.com/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/themezee_logo.png" alt="Logo" />
				</a>
			</div>
		</div>
		<div class="clear"></div>
		
		<div id="zee_admin_heading">
			<div class="icon32" id="icon-themes"></div>
			<h2><?php echo $theme_data->Name; ?> <?php _e('Theme Options', 'zeeDynamicPro_language'); ?></h2>
		</div>
		<div class="clear"></div>
		<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
			<div class="updated"><p><?php _e('Theme Options successfully updated.', 'zeeDynamicPro_language'); ?></p></div>
		<?php endif; ?>
		<div class="clear"></div>
			
		<?php // call function to display tab navigation
		themezee_options_tabs_menu(); ?>
			
		<?php 
		if ( isset ( $_GET['tab'] ) ) : $tab = esc_attr($_GET['tab']); else: $tab = 'welcome'; endif; ?>
		
		<?php // Check which tab on theme options is selected
		if( isset ( $_GET['tab'] ) and $_GET['tab'] <> 'welcome') :
			
			// Get Tab
			$tab = esc_attr($_GET['tab']);
		?>
		
			<form class="zee_form" action="options.php" method="post">
				
					<div class="zee_settings">
						<?php settings_fields('themezee_options'); ?>
						<?php do_settings_sections('themezee'); ?>
					</div>

				<input name="themezee_options[validation-submit]" type="hidden" value="<?php echo $tab ?>" />

				<p><input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes', 'zeeDynamicPro_language'); ?>" /></p>
			</form>
			
	<?php else: // Display Welcome Page
			themezee_options_welcome_page(); 
		endif;
		
		// call function to display sidebar content
		themezee_options_sidebar(); 
	?>	
	</div>

<?php
}


// Display Tab Navigation | get tabs from theme options array
function themezee_options_tabs_menu() {
	
	// Get the current tab
	if ( isset( $_GET['tab'] ) ) :
		$current = esc_attr($_GET['tab']);
	else:
		$current = 'welcome';
	endif;
	
	// Fetch all Tabs from options-setup.php
	$tabs = themezee_options_array();
	
	// Add welcome tab manually
	$links = array();
	if ( $current == 'welcome' ) :
		$links[] = '<a class="nav-tab nav-tab-active" href="?page=themezee&tab=welcome">'. __('Welcome', 'zeeDynamicPro_language') .'</a>';
	else :
		$links[] = '<a class="nav-tab" href="?page=themezee&tab=welcome">'. __('Welcome', 'zeeDynamicPro_language') .'</a>';
	endif;

	// Loop to create rest of Tabs Navigation
	foreach( $tabs as $tab => $tabcontent ) :
		if ( $tab == $current ) :
			$links[] = '<a class="nav-tab nav-tab-active" href="?page=themezee&tab='.$tab.'">'.$tabcontent['name'].'</a>';
		else :
			$links[] = '<a class="nav-tab" href="?page=themezee&tab='.$tab.'">'.$tabcontent['name'].'</a>';
		endif;
	endforeach;
	
	// Display Tab Navigaiton
	echo '<h2 id="zee_tabs_navi" class="nav-tab-wrapper">';
	foreach ( $links as $link ) : echo $link; endforeach;
	echo '</h2>';
}


// Register Settings
add_action('admin_init', 'themezee_options_register_settings');
function themezee_options_register_settings() {

	// Register Theme Options
	register_setting( 'themezee_options', 'themezee_options', 'themezee_options_validate' );
	
	// Check if active page is Theme Options panel
	if ( isset($_GET['page']) and $_GET['page'] == 'themezee' ) :
	
		// Check which tab on theme options is selected
		if( isset ( $_GET['tab'] ) and $_GET['tab'] <> 'welcome') :
			
			// Get Tab
			$tab = esc_attr($_GET['tab']);
	
			// Get Theme Options array
			$theme_options = themezee_options_array();
			
			// Get Sections and Settings of selected Tab
			$themezee_sections = $theme_options[$tab]['sections'];	
			$themezee_settings = $theme_options[$tab]['settings'];	
			
			// Add Setting Sections
			foreach ($themezee_sections as $section) {
				add_settings_section($section['id'], $section['name'], 'themezee_options_section_text', 'themezee');
			}
			
			// Add Setting Fields
			foreach ($themezee_settings as $setting) {
				add_settings_field($setting['id'], $setting['name'], 'themezee_options_display_setting', 'themezee', $setting['section'], $setting);
			}
			
		endif;
		
	endif;
}


// Display Setting Fields
function themezee_options_display_setting( $setting = array() ) {
	$options = get_option('themezee_options');
	
	if ( ! isset( $options[$setting['id']] ) )
		$options[$setting['id']] = $setting['std']; 

	switch ( $setting['type'] ) {
	
		case 'text':
			echo "<input id='".$setting['id']."' class='zee-text-field' name='themezee_options[".$setting['id']."]' type='text' value='". esc_attr($options[$setting['id']]) ."' />";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		case 'url':
			echo "<input id='".$setting['id']."' class='zee-url-field' name='themezee_options[".$setting['id']."]' type='text' value='". esc_url($options[$setting['id']]) ."' />";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		case 'textarea':
			echo "<textarea id='".$setting['id']."' name='themezee_options[".$setting['id']."]' rows='5'>" . esc_attr($options[$setting['id']]) . "</textarea>";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		case 'html':
			echo "<textarea id='".$setting['id']."' name='themezee_options[".$setting['id']."]' rows='5'>" . wp_kses_post($options[$setting['id']]) . "</textarea>";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		case 'editor':
			$editor_settings = array(
				'media_buttons' => false,
				'teeny' => true,
				'textarea_name' => 'themezee_options['.$setting['id'].']',
				'textarea_rows' => 10,
				'quicktags' => true
			);
			wp_editor( wp_kses_post($options[$setting['id']]), $setting['id'], $editor_settings); 	
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		case 'info':
			echo '<div id="'.$setting['id'].'" class="zee-info-field">'.$setting['desc'].'</div>';
		break;
			
		case 'checkbox':
			echo "<input id='".$setting['id']."' name='themezee_options[".$setting['id']."]' type='checkbox' value='true'";
			checked( $options[$setting['id']], 'true' );
			echo ' /><label> '.$setting['desc'].'</label>';
		break;
		
		case 'multicheckbox':
			echo "<input id='".$setting['id']."' name='themezee_options[".$setting['id']."]' type='hidden' value='true' />";
			foreach ( $setting['choices'] as $value => $label ) {
				$checkbox = $setting['id'] . '_' . $value;	
				if ( ! isset( $options[$checkbox] ) )
					$options[$checkbox] = $setting['std']; 
		
				echo "<input id='".$checkbox."'";
				checked( $options[$checkbox], 'true' );
				echo " type='checkbox' name='themezee_options[".$checkbox."]' value='true'/> " . $label . "<br/>";
			}
			echo '<label>'.$setting['desc'].'</label>';
		break;
	
		case 'select':
			echo "<select id='".$setting['id']."' name='themezee_options[".$setting['id']."]'>";
		 
			foreach ( $setting['choices'] as $value => $label ) {
				echo '<option ';
				selected( $options[$setting['id']], $value );
				echo ' value="' . $value . '" >' . $label . '</option>';
			}
		 
			echo "</select>";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		case 'radio':
			foreach ( $setting['choices'] as $value => $label ) {
				echo "<input id='".$setting['id']."'";
				checked( $options[$setting['id']], $value );
				echo " type='radio' name='themezee_options[".$setting['id']."]' value='" . $value . "'/> " . $label . "<br/>";
			}
			echo '<label>'.$setting['desc'].'</label>';
		break;

		case 'image':
			echo "<p class='zee-image-bg'><img id='".$setting['id']."img' src='" . esc_attr($options[$setting['id']]) . "' /></p>";
			echo '<input class="zee-upload-image-field" id="'.$setting['id'].'" name="themezee_options['.$setting['id'].']" type="text" value="'. esc_attr($options[$setting['id']]) .'" />';
			echo '<input class="zee-upload-image-button button-secondary" type="button" value="'. __('Upload Image', 'zeeDynamicPro_language') .'" />';
			echo '	<label>'.$setting['desc'].'</label>';
		break;

		case 'fontpicker':
			echo "<select id='".$setting['id']."' class='zee-fontpicker' name='themezee_options[".$setting['id']."]'>";
				foreach ( $setting['choices'] as $value => $label ) {
					echo '<option style="font-size: 1.3em; font-family: '.$value.'" ';
					selected( $options[$setting['id']], $value );
					echo ' value="' . $value . '" >' . $label . '</option>';
				}
			echo "</select>";
			echo '<br/><label>'.$setting['desc'].'</label>';
			echo "<div id='".$setting['id']."_preview' class='zee-font-bg' style='font-family: " . esc_attr($options[$setting['id']]) . ";'>Grumpy wizards make toxic brew for the evil Queen and Jack.</div>";

		break;
		
		case 'colorpicker':
			echo "<input id='".$setting['id']."' name='themezee_options[".$setting['id']."]' class='zee-colorpicker-field' type='text' value='". esc_attr($options[$setting['id']]) ."' data-default-color='".$setting['std']."' />";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
		
		default:
			echo "<input id='".$setting['id']."' class='zee-text-field' name='themezee_options[".$setting['id']."]' size='40' type='text' value='". esc_attr($options[$setting['id']]) ."' />";
			echo '<br/><label>'.$setting['desc'].'</label>';
		break;
	}
}


// Validate Settings
function themezee_options_validate($input) {
	$options = get_option('themezee_options');

	if ( isset ( $input['validation-submit'] ) ) :
		$tab = $input['validation-submit'];
	else:
		$tab = 'general';
	endif;
	
	// Get theme options array
	$theme_options = themezee_options_array();
	
	// Get Settings
	$validate_settings = $theme_options[$tab]['settings'];	

	foreach ($validate_settings as $setting) {
		
		if ($setting['type'] == 'checkbox' and !isset($input[$setting['id']]) ) 
		{
			$options[$setting['id']] = 'false'; 
		}	
		elseif ($setting['type'] == 'multicheckbox')
		{
			foreach ( $setting['choices'] as $value => $label ) {
				$checkbox = $setting['id'] . '_' . $value;
				if ( !isset($input[$checkbox] ) ) :
					$options[$checkbox] = 'false'; 
				else :
					$options[$checkbox] = 'true'; 
				endif;
			}
		}
		elseif ($setting['type'] == 'radio' and !isset($input[$setting['id']]) ) 
		{
			$options[$setting['id']] = 1; 
		}
		elseif ($setting['type'] == 'textarea')
		{
			$options[$setting['id']] = esc_textarea(trim($input[$setting['id']]));
		}
		elseif ($setting['type'] == 'html' or $setting['type'] == 'editor')
		{
			$options[$setting['id']] = wp_kses_post(trim($input[$setting['id']]));
		}
		elseif ($setting['type'] == 'url')
		{
			$options[$setting['id']] = esc_url(trim($input[$setting['id']]));
		}
		else 
		{
			$options[$setting['id']] = esc_attr(trim($input[$setting['id']]));
		}
	}
	return $options;
}


// Empty Dummy function for section text
function themezee_options_section_text() {}


// Change capability to edit_theme_options
function themezee_options_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_themezee_options', 'themezee_options_capability' );


// Set Default Options
function themezee_options_set_default_options() {
     $theme_options = get_option( 'themezee_options' );
     if ( false === $theme_options ) {
          $theme_options = themezee_options_get_default_options();
     }
     update_option( 'themezee_options', $theme_options );
}
// Initialize Theme options
add_action('after_setup_theme','themezee_options_set_default_options', 9 );


// Get Default Options
function themezee_options_get_default_options() {
	$options = array();
	
	// Get Theme Options array
	$theme_options = themezee_options_array();
	
	foreach( $theme_options as $tab => $tabcontent ) :
		
		// Get Settings of tab
		$themezee_settings = $theme_options[$tab]['settings'];	
		
		foreach ($themezee_settings as $setting) :
			
			if ( $setting['type'] != 'multicheckbox' ) :
				$options[$setting['id']] = $setting['std'];
			else :
				foreach ( $setting['choices'] as $value => $label ) {
					$checkbox = $setting['id'] . '_' . $value;	
					$options[$checkbox] = $setting['std']; 
				}
			endif;
		endforeach;
		
	endforeach;
	
	return $options;
}

?>