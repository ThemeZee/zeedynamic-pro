<?php
/**
 * Custom Font List Control for the Customizer
 *
 * @package zeeDynamic Pro
 */


/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the Font List Control. Allows user to select of how many fonts they want to choose from.
	 *
	 */
	class zeeDynamic_Pro_Customize_Font_List_Control extends WP_Customize_Control {
	
		// critical for JS constructor
		public $type = 'zeedynamic_pro_custom_font_list';
		
		public $l10n = array();
		
		public function __construct($manager, $id, $args = array(), $options = array()) {
		
			// Make Buttons translateable
			$this->l10n = array(
				'update' =>	__( 'Update Fonts', 'zeedynamic-pro' )
			);
			
			parent::__construct( $manager, $id, $args );
			
		}
		
		public function enqueue() {

			// Register and Enqueue Custom Font JS Constructor
			wp_enqueue_script( 'zeedynamic-pro-custom-font-control', ZEE_DYNAMIC_PRO_PLUGIN_URL . 'assets/js/custom-font-control.js', array( 'customize-controls' ), ZEE_DYNAMIC_PRO_VERSION, true );
		
		}
		
		public function render_content() {
		
			if ( empty( $this->choices ) )
				return;
				
			// Create Data Attributes with font lists
			$default = json_encode( zeeDynamic_Pro_Custom_Font_Lists::get_fonts( 'default' ) );
			$favorite = json_encode( zeeDynamic_Pro_Custom_Font_Lists::get_fonts( 'favorite' ) );
			$popular = json_encode( zeeDynamic_Pro_Custom_Font_Lists::get_fonts( 'popular' ) );
			$all = json_encode( zeeDynamic_Pro_Custom_Font_Lists::get_fonts( 'all' ) );
			
			$l10n = json_encode( $this->l10n );

			?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>

				<select <?php $this->link(); ?>>
					<?php
					foreach ( $this->choices as $value => $label )
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
					?>
				</select>
				<div class="actions"></div>
				<div class="custom-font-lists" data-l10n="<?php echo esc_attr( $l10n ); ?>" data-standard="<?php echo esc_attr( $default ); ?>" data-favorite="<?php echo esc_attr( $favorite ); ?>" data-popular="<?php echo esc_attr( $popular ); ?>" data-all="<?php echo esc_attr( $all ); ?>"></div>
				<div class="debugging"></div>
			</label>
			
			<?php
		}	
	}
	
endif;