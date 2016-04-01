<?php
/**
 * Custom Font Control for the Customizer
 *
 * @package zeeDynamic Pro
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */

if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays a custom Font control. Allows to switch fonts for particular elements on the theme.
	 *
	 */
	class zeeDynamic_Pro_Customize_Font_Control extends WP_Customize_Control {
	
		private $fonts = false;
		public $l10n = array();
		
		// critical for JS constructor
		public $type = 'zeedynamic_pro_custom_font';
		
		public function __construct($manager, $id, $args = array(), $options = array()) {
		
			// Make Buttons translateable
			$this->l10n = array(
				'previous' =>	__( 'Previous Font', 'zeedynamic-pro' ),
				'next' =>		__( 'Next Font', 'zeedynamic-pro' ),
				'standard' =>	_x( 'Default', 'default font button', 'zeedynamic-pro' )
			);
					
			// Get Theme Options
			$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();
			
			// Set Fonts
			$this->fonts = zeeDynamic_Pro_Custom_Font_Lists::get_fonts($theme_options['available_fonts']);
	
			parent::__construct( $manager, $id, $args );
			
		}
		
		public function enqueue() {

			// Register and Enqueue Custom Font JS Constructor
			wp_enqueue_script( 'zeedynamic-pro-custom-font-control', ZEE_DYNAMIC_PRO_PLUGIN_URL . 'assets/js/custom-font-control.js', array( 'customize-controls' ), ZEE_DYNAMIC_PRO_VERSION, true );
		
		}
		
		public function render_content() {
		
			$l10n = json_encode( $this->l10n );
			
			if( !empty($this->fonts) ) :
			
            ?>
                <label>
                    <span class="customize-control-title" data-l10n="<?php echo esc_attr( $l10n ); ?>" data-font="<?php echo esc_attr( $this->setting->default ); ?>">
						<?php echo esc_html( $this->label ); ?>
					</span>
					<div class="customize-font-select-control">
						<select <?php $this->link(); ?>>
							<?php
								foreach ( $this->fonts as $k => $v )
								{
									printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v);
								}
							?>
						</select>
					</div>
					<div class="actions"></div>
				</label>
                
            <?php
			endif;
		}
		
	}
	
endif;