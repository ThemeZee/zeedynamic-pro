<?php
/**
 * Custom Fonts
 *
 * Adds custom font settings to Customizer and generates font CSS code
 *
 * @package zeeDynamic Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Fonts Class
 */
class zeeDynamic_Pro_Custom_Fonts {

	/**
	 * Custom Fonts Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if zeeDynamic Theme is not active.
		if ( ! current_theme_supports( 'zeedynamic-pro' ) ) {
			return;
		}

		// Include Font List Control Files.
		require_once ZEE_DYNAMIC_PRO_PLUGIN_DIR . '/includes/customizer/class-customize-font-control.php';

		// Add Custom Fonts CSS code to custom stylesheet output.
		add_filter( 'zeedynamic_pro_custom_css_stylesheet', array( __CLASS__, 'custom_fonts_css' ) );

		// Add Custom Fonts CSS code to the Gutenberg editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'custom_editor_fonts_css' ) );

		// Load custom fonts from Google web font API.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_google_fonts' ), 1 );
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'load_google_fonts' ), 1 );

		// Add Font Settings in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'font_settings' ) );
	}

	/**
	 * Get the font family string.
	 *
	 * @param String $font Name of selected font.
	 * @return string Fonts string.
	 */
	static function get_font_family( $font ) {

		// Set System Font Stack.
		$system_fonts = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';

		// Return Font Family string.
		return 'SystemFontStack' === $font ? $system_fonts : '"' . esc_attr( $font ) . '", Arial, Helvetica, sans-serif';
	}

	/**
	 * Adds Font Family CSS styles in the head area to override default typography
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_fonts_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Set Default Text Font.
		if ( $theme_options['text_font'] != $default_options['text_font'] ) {

			$custom_css .= '
				/* Base Font Setting */
				body,
				button,
				input,
				select,
				textarea {
					font-family: ' . self::get_font_family( $theme_options['text_font'] ) . ';
				}
			';
		}

		// Set Title Font.
		if ( $theme_options['title_font'] != $default_options['title_font'] ) {

			$custom_css .= '
				/* Headings Font Setting */
				.site-title,
				.page-title,
				.entry-title {
					font-family: ' . self::get_font_family( $theme_options['title_font'] ) . ';
				}
			';
		}

		// Set Navigation Font.
		if ( $theme_options['navi_font'] != $default_options['navi_font'] ) {

			$custom_css .= '
				/* Navigation Font Setting */
				.main-navigation-menu a {
					font-family: ' . self::get_font_family( $theme_options['navi_font'] ) . ';
				}
			';
		}

		// Set Widget Title Font.
		if ( $theme_options['widget_title_font'] != $default_options['widget_title_font'] ) {

			$custom_css .= '
				/* Widget Titles Font Setting */
				.page-header .archive-title,
				.comments-header .comments-title,
				.comment-reply-title span,
				.widget-title {
					font-family: ' . self::get_font_family( $theme_options['widget_title_font'] ) . ';
				}
			';
		}

		return $custom_css;
	}

	/**
	 * Adds Font Family CSS styles in the Gutenberg Editor to override default typography
	 *
	 * @return void
	 */
	static function custom_editor_fonts_css() {
		$custom_css = '';

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Set Default Text Font.
		if ( $theme_options['text_font'] !== $default_options['text_font'] ) {

			$custom_css .= '
				.edit-post-visual-editor .editor-block-list__block {
					font-family: ' . self::get_font_family( $theme_options['text_font'] ) . ';
				}
			';
		}

		// Set Title Font.
		if ( $theme_options['title_font'] !== $default_options['title_font'] ) {

			$custom_css .= '
				.edit-post-visual-editor .editor-post-title__block .editor-post-title__input {
					font-family: ' . self::get_font_family( $theme_options['title_font'] ) . ';
				}
			';
		}

		// Add Custom CSS.
		if ( '' !== $custom_css ) {
			wp_add_inline_style( 'zeedynamic-editor-styles', $custom_css );
		}
	}

	/**
	 * Enqueue Google Fonts if necessary.
	 *
	 * @return void
	 */
	static function load_google_fonts() {

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Local Fonts which haven't to be load from Google.
		$local_fonts = self::get_local_fonts();

		// Set Google Font Array.
		$google_font_families = array();

		// Set Font Styles.
		$font_styles = ':400,400italic,700,700italic';

		// Add Text Font.
		if ( isset( $theme_options['text_font'] ) and ! array_key_exists( $theme_options['text_font'], $local_fonts ) ) {

			$google_font_families[] = $theme_options['text_font'] . $font_styles;
			$local_fonts[]          = $theme_options['text_font']; // Make sure font is not loaded twice.

		}

		// Add Title Font.
		if ( isset( $theme_options['title_font'] ) and ! array_key_exists( $theme_options['title_font'], $local_fonts ) ) {

			$google_font_families[] = $theme_options['title_font'] . $font_styles;
			$local_fonts[]          = $theme_options['title_font']; // Make sure font is not loaded twice.

		}

		// Add Navigation Font.
		if ( isset( $theme_options['navi_font'] ) and ! array_key_exists( $theme_options['navi_font'], $local_fonts ) ) {

			$google_font_families[] = $theme_options['navi_font'] . $font_styles;
			$local_fonts[]          = $theme_options['navi_font']; // Make sure font is not loaded twice.

		}

		// Add Widget Title Font.
		if ( isset( $theme_options['widget_title_font'] ) and ! array_key_exists( $theme_options['widget_title_font'], $local_fonts ) ) {

			$google_font_families[] = $theme_options['widget_title_font'] . $font_styles;
			$local_fonts[]          = $theme_options['widget_title_font']; // Make sure font is not loaded twice.

		}

		// Return early if google font array is empty.
		if ( empty( $google_font_families ) ) {
			return;
		}

		// Setup Google Font URLs.
		$query_args = array(
			'family'  => urlencode( implode( '|', $google_font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'swap' ),
		);

		$google_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		// Register and Enqueue Google Fonts.
		wp_enqueue_style( 'zeedynamic-pro-custom-fonts', $google_fonts_url, array(), null );
	}

	/**
	 * Adds all font settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function font_settings( $wp_customize ) {

		// Add Section for Theme Fonts.
		$wp_customize->add_section( 'zeedynamic_pro_section_fonts', array(
			'title'    => __( 'Theme Fonts', 'zeedynamic-pro' ),
			'priority' => 70,
			'panel'    => 'zeedynamic_options_panel',
		) );

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Add settings and controls for theme fonts.
		$wp_customize->add_setting( 'zeedynamic_theme_options[text_font]', array(
			'default'           => $default_options['text_font'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		) );
		$wp_customize->add_control( new zeeDynamic_Pro_Customize_Font_Control(
			$wp_customize, 'text_font', array(
				'label'    => __( 'Base Font', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_fonts',
				'settings' => 'zeedynamic_theme_options[text_font]',
				'priority' => 1,
			)
		) );

		$wp_customize->add_setting( 'zeedynamic_theme_options[title_font]', array(
			'default'           => $default_options['title_font'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		) );
		$wp_customize->add_control( new zeeDynamic_Pro_Customize_Font_Control(
			$wp_customize, 'title_font', array(
				'label'    => _x( 'Headings', 'font setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_fonts',
				'settings' => 'zeedynamic_theme_options[title_font]',
				'priority' => 2,
			)
		) );

		$wp_customize->add_setting( 'zeedynamic_theme_options[navi_font]', array(
			'default'           => $default_options['navi_font'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		) );
		$wp_customize->add_control( new zeeDynamic_Pro_Customize_Font_Control(
			$wp_customize, 'navi_font', array(
				'label'    => _x( 'Navigation', 'font setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_fonts',
				'settings' => 'zeedynamic_theme_options[navi_font]',
				'priority' => 3,
			)
		) );

		$wp_customize->add_setting( 'zeedynamic_theme_options[widget_title_font]', array(
			'default'           => $default_options['widget_title_font'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr',
		) );
		$wp_customize->add_control( new zeeDynamic_Pro_Customize_Font_Control(
			$wp_customize, 'widget_title_font', array(
				'label'    => _x( 'Widget Titles', 'font setting', 'zeedynamic-pro' ),
				'section'  => 'zeedynamic_pro_section_fonts',
				'settings' => 'zeedynamic_theme_options[widget_title_font]',
				'priority' => 4,
			)
		) );
	}

	/**
	 * Get local fonts
	 *
	 * @return array List of local fonts.
	 */
	static function get_local_fonts() {

		$fonts = array(
			'Arial'                       => 'Arial',
			'Arial Black'                 => 'Arial Black',
			'Courier New'                 => 'Courier New',
			'Georgia'                     => 'Georgia',
			'Helvetica'                   => 'Helvetica',
			'Impact'                      => 'Impact',
			'Palatino, Palatino Linotype' => 'Palatino',
			'SystemFontStack'             => 'System Font Stack',
			'Tahoma'                      => 'Tahoma',
			'Trebuchet MS, Trebuchet'     => 'Trebuchet MS',
			'Times New Roman, Times'      => 'Times New Roman',
			'Verdana'                     => 'Verdana',
		);

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Add default fonts to local fonts.
		if ( isset( $default_options['text_font'] ) and ! array_key_exists( $default_options['text_font'], $fonts ) ) :
			$fonts[ trim( $default_options['text_font'] ) ] = esc_attr( trim( $default_options['text_font'] ) );
		endif;
		if ( isset( $default_options['title_font'] ) and ! array_key_exists( $default_options['title_font'], $fonts ) ) :
			$fonts[ trim( $default_options['title_font'] ) ] = esc_attr( trim( $default_options['title_font'] ) );
		endif;
		if ( isset( $default_options['navi_font'] ) and ! array_key_exists( $default_options['navi_font'], $fonts ) ) :
			$fonts[ trim( $default_options['navi_font'] ) ] = esc_attr( trim( $default_options['navi_font'] ) );
		endif;
		if ( isset( $default_options['widget_title_font'] ) and ! array_key_exists( $default_options['widget_title_font'], $fonts ) ) :
			$fonts[ trim( $default_options['widget_title_font'] ) ] = esc_attr( trim( $default_options['widget_title_font'] ) );
		endif;

		// Sort fonts alphabetically.
		asort( $fonts );

		return $fonts;
	}

	/**
	 * Get all google fonts
	 *
	 * @return array List of Google Fonts.
	 */
	static function get_google_fonts() {

		$fonts = array(
			'ABeeZee'                  => 'ABeeZee',
			'Abel'                     => 'Abel',
			'Abril'                    => 'Abril',
			'Abril Fatface'            => 'Abril Fatface',
			'Aclonica'                 => 'Aclonica',
			'Acme'                     => 'Acme',
			'Actor'                    => 'Actor',
			'Adamina'                  => 'Adamina',
			'Advent Pro'               => 'Advent Pro',
			'Aguafina Script'          => 'Aguafina Script',
			'Akronim'                  => 'Akronim',
			'Aladin'                   => 'Aladin',
			'Aldrich'                  => 'Aldrich',
			'Alef'                     => 'Alef',
			'Alegreya'                 => 'Alegreya',
			'Alegreya SC'              => 'Alegreya SC',
			'Alegreya Sans'            => 'Alegreya Sans',
			'Alegreya Sans SC'         => 'Alegreya Sans SC',
			'Alex Brush'               => 'Alex Brush',
			'Alfa Slab One'            => 'Alfa Slab One',
			'Alice'                    => 'Alice',
			'Alike'                    => 'Alike',
			'Alike Angular'            => 'Alike Angular',
			'Allan'                    => 'Allan',
			'Allerta'                  => 'Allerta',
			'Allerta Stencil'          => 'Allerta Stencil',
			'Allura'                   => 'Allura',
			'Almendra'                 => 'Almendra',
			'Almendra Display'         => 'Almendra Display',
			'Almendra SC'              => 'Almendra SC',
			'Amarante'                 => 'Amarante',
			'Amaranth'                 => 'Amaranth',
			'Amatic SC'                => 'Amatic SC',
			'Amethysta'                => 'Amethysta',
			'Anaheim'                  => 'Anaheim',
			'Andada'                   => 'Andada',
			'Andika'                   => 'Andika',
			'Angkor'                   => 'Angkor',
			'Annie Use Your Telescope' => 'Annie Use Your Telescope',
			'Anonymous Pro'            => 'Anonymous Pro',
			'Antic'                    => 'Antic',
			'Antic Didone'             => 'Antic Didone',
			'Antic Slab'               => 'Antic Slab',
			'Anton'                    => 'Anton',
			'Arapey'                   => 'Arapey',
			'Arbutus'                  => 'Arbutus',
			'Arbutus Slab'             => 'Arbutus Slab',
			'Architects Daughter'      => 'Architects Daughter',
			'Archivo Black'            => 'Archivo Black',
			'Archivo Narrow'           => 'Archivo Narrow',
			'Arimo'                    => 'Arimo',
			'Arizonia'                 => 'Arizonia',
			'Armata'                   => 'Armata',
			'Artifika'                 => 'Artifika',
			'Arvo'                     => 'Arvo',
			'Asap'                     => 'Asap',
			'Asset'                    => 'Asset',
			'Astloch'                  => 'Astloch',
			'Asul'                     => 'Asul',
			'Atomic Age'               => 'Atomic Age',
			'Aubrey'                   => 'Aubrey',
			'Audiowide'                => 'Audiowide',
			'Autour One'               => 'Autour One',
			'Average'                  => 'Average',
			'Average Sans'             => 'Average Sans',
			'Averia Gruesa Libre'      => 'Averia Gruesa Libre',
			'Averia Libre'             => 'Averia Libre',
			'Averia Sans Libre'        => 'Averia Sans Libre',
			'Averia Serif Libre'       => 'Averia Serif Libre',
			'Bad Script'               => 'Bad Script',
			'Balthazar'                => 'Balthazar',
			'Bangers'                  => 'Bangers',
			'Basic'                    => 'Basic',
			'Battambang'               => 'Battambang',
			'Baumans'                  => 'Baumans',
			'Bayon'                    => 'Bayon',
			'Belgrano'                 => 'Belgrano',
			'Belleza'                  => 'Belleza',
			'BenchNine'                => 'BenchNine',
			'Bentham'                  => 'Bentham',
			'Berkshire Swash'          => 'Berkshire Swash',
			'Bevan'                    => 'Bevan',
			'Bigelow Rules'            => 'Bigelow Rules',
			'Bigshot One'              => 'Bigshot One',
			'Bilbo'                    => 'Bilbo',
			'Bilbo Swash Caps'         => 'Bilbo Swash Caps',
			'Bitter'                   => 'Bitter',
			'Black Ops One'            => 'Black Ops One',
			'Bokor'                    => 'Bokor',
			'Bonbon'                   => 'Bonbon',
			'Boogaloo'                 => 'Boogaloo',
			'Bowlby One'               => 'Bowlby One',
			'Bowlby One SC'            => 'Bowlby One SC',
			'Brawler'                  => 'Brawler',
			'Bree Serif'               => 'Bree Serif',
			'Bubblegum Sans'           => 'Bubblegum Sans',
			'Bubbler One'              => 'Bubbler One',
			'Buda'                     => 'Buda',
			'Buenard'                  => 'Buenard',
			'Bungee Hairline'          => 'Bungee Hairline',
			'Butcherman'               => 'Butcherman',
			'Butterfly Kids'           => 'Butterfly Kids',
			'Cabin'                    => 'Cabin',
			'Cabin Condensed'          => 'Cabin Condensed',
			'Cabin Sketch'             => 'Cabin Sketch',
			'Caesar Dressing'          => 'Caesar Dressing',
			'Cagliostro'               => 'Cagliostro',
			'Calligraffitti'           => 'Calligraffitti',
			'Cambo'                    => 'Cambo',
			'Candal'                   => 'Candal',
			'Cantarell'                => 'Cantarell',
			'Cantata One'              => 'Cantata One',
			'Cantora One'              => 'Cantora One',
			'Capriola'                 => 'Capriola',
			'Cardo'                    => 'Cardo',
			'Carme'                    => 'Carme',
			'Carrois Gothic'           => 'Carrois Gothic',
			'Carrois Gothic SC'        => 'Carrois Gothic SC',
			'Carter One'               => 'Carter One',
			'Catamaran'                => 'Catamaran',
			'Caudex'                   => 'Caudex',
			'Cedarville Cursive'       => 'Cedarville Cursive',
			'Ceviche One'              => 'Ceviche One',
			'Changa One'               => 'Changa One',
			'Chango'                   => 'Chango',
			'Chau Philomene One'       => 'Chau Philomene One',
			'Chela One'                => 'Chela One',
			'Chelsea Market'           => 'Chelsea Market',
			'Chenla'                   => 'Chenla',
			'Cherry Cream Soda'        => 'Cherry Cream Soda',
			'Cherry Swash'             => 'Cherry Swash',
			'Chewy'                    => 'Chewy',
			'Chicle'                   => 'Chicle',
			'Chivo'                    => 'Chivo',
			'Cinzel'                   => 'Cinzel',
			'Cinzel Decorative'        => 'Cinzel Decorative',
			'Clicker Script'           => 'Clicker Script',
			'Coda'                     => 'Coda',
			'Coda Caption'             => 'Coda Caption',
			'Codystar'                 => 'Codystar',
			'Combo'                    => 'Combo',
			'Coiny'                    => 'Coiny',
			'Comfortaa'                => 'Comfortaa',
			'Coming Soon'              => 'Coming Soon',
			'Concert One'              => 'Concert One',
			'Condiment'                => 'Condiment',
			'Content'                  => 'Content',
			'Contrail One'             => 'Contrail One',
			'Convergence'              => 'Convergence',
			'Cookie'                   => 'Cookie',
			'Copse'                    => 'Copse',
			'Corben'                   => 'Corben',
			'Cormorant Garamond'       => 'Cormorant Garamond',
			'Courgette'                => 'Courgette',
			'Cousine'                  => 'Cousine',
			'Coustard'                 => 'Coustard',
			'Covered By Your Grace'    => 'Covered By Your Grace',
			'Crafty Girls'             => 'Crafty Girls',
			'Creepster'                => 'Creepster',
			'Crete Round'              => 'Crete Round',
			'Crimson Text'             => 'Crimson Text',
			'Croissant One'            => 'Croissant One',
			'Crushed'                  => 'Crushed',
			'Cuprum'                   => 'Cuprum',
			'Cutive'                   => 'Cutive',
			'Cutive Mono'              => 'Cutive Mono',
			'Damion'                   => 'Damion',
			'Dancing Script'           => 'Dancing Script',
			'Dangrek'                  => 'Dangrek',
			'David Libre'              => 'David Libre',
			'Dawning of a New Day'     => 'Dawning of a New Day',
			'Days One'                 => 'Days One',
			'Delius'                   => 'Delius',
			'Delius Swash Caps'        => 'Delius Swash Caps',
			'Delius Unicase'           => 'Delius Unicase',
			'Della Respira'            => 'Della Respira',
			'Denk One'                 => 'Denk One',
			'Devonshire'               => 'Devonshire',
			'Dhurjati'                 => 'Dhurjati',
			'Didact Gothic'            => 'Didact Gothic',
			'Diplomata'                => 'Diplomata',
			'Diplomata SC'             => 'Diplomata SC',
			'Domine'                   => 'Domine',
			'Donegal One'              => 'Donegal One',
			'Doppio One'               => 'Doppio One',
			'Dorsa'                    => 'Dorsa',
			'Dosis'                    => 'Dosis',
			'Dr Sugiyama'              => 'Dr Sugiyama',
			'Droid Sans'               => 'Droid Sans',
			'Droid Serif'              => 'Droid Serif',
			'Duru Sans'                => 'Duru Sans',
			'Dynalight'                => 'Dynalight',
			'EB Garamond'              => 'EB Garamond',
			'Eagle Lake'               => 'Eagle Lake',
			'Eater'                    => 'Eater',
			'Economica'                => 'Economica',
			'Eczar'                    => 'Eczar',
			'Ek Mukta'                 => 'Ek Mukta',
			'Electrolize'              => 'Electrolize',
			'Elsie'                    => 'Elsie',
			'Elsie Swash Caps'         => 'Elsie Swash Caps',
			'Emblema One'              => 'Emblema One',
			'Emilys Candy'             => 'Emilys Candy',
			'Engagement'               => 'Engagement',
			'Englebert'                => 'Englebert',
			'Enriqueta'                => 'Enriqueta',
			'Erica One'                => 'Erica One',
			'Esteban'                  => 'Esteban',
			'Euphoria Script'          => 'Euphoria Script',
			'Ewert'                    => 'Ewert',
			'Exo'                      => 'Exo',
			'Exo 2'                    => 'Exo 2',
			'Expletus Sans'            => 'Expletus Sans',
			'Fanwood Text'             => 'Fanwood Text',
			'Fascinate'                => 'Fascinate',
			'Fascinate Inline'         => 'Fascinate Inline',
			'Faster One'               => 'Faster One',
			'Fasthand'                 => 'Fasthand',
			'Fauna One'                => 'Fauna One',
			'Federant'                 => 'Federant',
			'Federo'                   => 'Federo',
			'Felipa'                   => 'Felipa',
			'Fenix'                    => 'Fenix',
			'Finger Paint'             => 'Finger Paint',
			'Fira Mono'                => 'Fira Mono',
			'Fira Sans'                => 'Fira Sans',
			'Fjalla One'               => 'Fjalla One',
			'Fjord One'                => 'Fjord One',
			'Flamenco'                 => 'Flamenco',
			'Flavors'                  => 'Flavors',
			'Fondamento'               => 'Fondamento',
			'Fontdiner Swanky'         => 'Fontdiner Swanky',
			'Forum'                    => 'Forum',
			'Francois One'             => 'Francois One',
			'Freckle Face'             => 'Freckle Face',
			'Fredericka the Great'     => 'Fredericka the Great',
			'Fredoka One'              => 'Fredoka One',
			'Freehand'                 => 'Freehand',
			'Fresca'                   => 'Fresca',
			'Frijole'                  => 'Frijole',
			'Fruktur'                  => 'Fruktur',
			'Fugaz One'                => 'Fugaz One',
			'GFS Didot'                => 'GFS Didot',
			'GFS Neohellenic'          => 'GFS Neohellenic',
			'Gabriela'                 => 'Gabriela',
			'Gafata'                   => 'Gafata',
			'Galdeano'                 => 'Galdeano',
			'Galindo'                  => 'Galindo',
			'Gentium Basic'            => 'Gentium Basic',
			'Gentium Book Basic'       => 'Gentium Book Basic',
			'Geo'                      => 'Geo',
			'Geostar'                  => 'Geostar',
			'Geostar Fill'             => 'Geostar Fill',
			'Germania One'             => 'Germania One',
			'Gidugu'                   => 'Gidugu',
			'Gilda Display'            => 'Gilda Display',
			'Give You Glory'           => 'Give You Glory',
			'Glass Antiqua'            => 'Glass Antiqua',
			'Glegoo'                   => 'Glegoo',
			'Gloria Hallelujah'        => 'Gloria Hallelujah',
			'Goblin One'               => 'Goblin One',
			'Gochi Hand'               => 'Gochi Hand',
			'Gorditas'                 => 'Gorditas',
			'Goudy Bookletter 1911'    => 'Goudy Bookletter 1911',
			'Graduate'                 => 'Graduate',
			'Grand Hotel'              => 'Grand Hotel',
			'Gravitas One'             => 'Gravitas One',
			'Great Vibes'              => 'Great Vibes',
			'Griffy'                   => 'Griffy',
			'Gruppo'                   => 'Gruppo',
			'Gudea'                    => 'Gudea',
			'Gurajada'                 => 'Gurajada',
			'Habibi'                   => 'Habibi',
			'Halant'                   => 'Halant',
			'Hammersmith One'          => 'Hammersmith One',
			'Hanalei'                  => 'Hanalei',
			'Hanalei Fill'             => 'Hanalei Fill',
			'Handlee'                  => 'Handlee',
			'Hanuman'                  => 'Hanuman',
			'Happy Monkey'             => 'Happy Monkey',
			'Headland One'             => 'Headland One',
			'Henny Penny'              => 'Henny Penny',
			'Herr Von Muellerhoff'     => 'Herr Von Muellerhoff',
			'Hind'                     => 'Hind',
			'Holtwood One SC'          => 'Holtwood One SC',
			'Homemade Apple'           => 'Homemade Apple',
			'Homenaje'                 => 'Homenaje',
			'IM Fell DW Pica'          => 'IM Fell DW Pica',
			'IM Fell DW Pica SC'       => 'IM Fell DW Pica SC',
			'IM Fell Double Pica'      => 'IM Fell Double Pica',
			'IM Fell Double Pica SC'   => 'IM Fell Double Pica SC',
			'IM Fell English'          => 'IM Fell English',
			'IM Fell English SC'       => 'IM Fell English SC',
			'IM Fell French Canon'     => 'IM Fell French Canon',
			'IM Fell French Canon SC'  => 'IM Fell French Canon SC',
			'IM Fell Great Primer'     => 'IM Fell Great Primer',
			'IM Fell Great Primer SC'  => 'IM Fell Great Primer SC',
			'Iceberg'                  => 'Iceberg',
			'Iceland'                  => 'Iceland',
			'Imprima'                  => 'Imprima',
			'Inconsolata'              => 'Inconsolata',
			'Inder'                    => 'Inder',
			'Indie Flower'             => 'Indie Flower',
			'Inika'                    => 'Inika',
			'Irish Grover'             => 'Irish Grover',
			'Istok Web'                => 'Istok Web',
			'Italiana'                 => 'Italiana',
			'Italianno'                => 'Italianno',
			'Itim'                     => 'Itim',
			'Jacques Francois'         => 'Jacques Francois',
			'Jacques Francois Shadow'  => 'Jacques Francois Shadow',
			'Jim Nightshade'           => 'Jim Nightshade',
			'Jockey One'               => 'Jockey One',
			'Jolly Lodger'             => 'Jolly Lodger',
			'Josefin Sans'             => 'Josefin Sans',
			'Josefin Slab'             => 'Josefin Slab',
			'Joti One'                 => 'Joti One',
			'Judson'                   => 'Judson',
			'Julee'                    => 'Julee',
			'Julius Sans One'          => 'Julius Sans One',
			'Junge'                    => 'Junge',
			'Jura'                     => 'Jura',
			'Just Another Hand'        => 'Just Another Hand',
			'Just Me Again Down Here'  => 'Just Me Again Down Here',
			'Kalam'                    => 'Kalam',
			'Kameron'                  => 'Kameron',
			'Kantumruy'                => 'Kantumruy',
			'Karla'                    => 'Karla',
			'Karma'                    => 'Karma',
			'Kaushan Script'           => 'Kaushan Script',
			'Kavoon'                   => 'Kavoon',
			'Kdam Thmor'               => 'Kdam Thmor',
			'Keania One'               => 'Keania One',
			'Kelly Slab'               => 'Kelly Slab',
			'Kenia'                    => 'Kenia',
			'Khand'                    => 'Khand',
			'Khmer'                    => 'Khmer',
			'Kite One'                 => 'Kite One',
			'Knewave'                  => 'Knewave',
			'Kotta One'                => 'Kotta One',
			'Koulen'                   => 'Koulen',
			'Kranky'                   => 'Kranky',
			'Kreon'                    => 'Kreon',
			'Kristi'                   => 'Kristi',
			'Krona One'                => 'Krona One',
			'La Belle Aurore'          => 'La Belle Aurore',
			'Laila'                    => 'Laila',
			'Lakki Reddy'              => 'Lakki Reddy',
			'Lancelot'                 => 'Lancelot',
			'Lato'                     => 'Lato',
			'League Script'            => 'League Script',
			'Leckerli One'             => 'Leckerli One',
			'Ledger'                   => 'Ledger',
			'Lekton'                   => 'Lekton',
			'Lemon'                    => 'Lemon',
			'Libre Franklin'           => 'Libre Franklin',
			'Libre Baskerville'        => 'Libre Baskerville',
			'Life Savers'              => 'Life Savers',
			'Lilita One'               => 'Lilita One',
			'Lily Script One'          => 'Lily Script One',
			'Limelight'                => 'Limelight',
			'Linden Hill'              => 'Linden Hill',
			'Lobster'                  => 'Lobster',
			'Lobster Two'              => 'Lobster Two',
			'Londrina Outline'         => 'Londrina Outline',
			'Londrina Shadow'          => 'Londrina Shadow',
			'Londrina Sketch'          => 'Londrina Sketch',
			'Londrina Solid'           => 'Londrina Solid',
			'Lora'                     => 'Lora',
			'Love Ya Like A Sister'    => 'Love Ya Like A Sister',
			'Loved by the King'        => 'Loved by the King',
			'Lovers Quarrel'           => 'Lovers Quarrel',
			'Luckiest Guy'             => 'Luckiest Guy',
			'Lusitana'                 => 'Lusitana',
			'Lustria'                  => 'Lustria',
			'Macondo'                  => 'Macondo',
			'Macondo Swash Caps'       => 'Macondo Swash Caps',
			'Magra'                    => 'Magra',
			'Maiden Orange'            => 'Maiden Orange',
			'Mako'                     => 'Mako',
			'Mallanna'                 => 'Mallanna',
			'Mandali'                  => 'Mandali',
			'Marcellus'                => 'Marcellus',
			'Marcellus SC'             => 'Marcellus SC',
			'Marck Script'             => 'Marck Script',
			'Margarine'                => 'Margarine',
			'Marko One'                => 'Marko One',
			'Marmelad'                 => 'Marmelad',
			'Marvel'                   => 'Marvel',
			'Mate'                     => 'Mate',
			'Mate SC'                  => 'Mate SC',
			'Maven Pro'                => 'Maven Pro',
			'McLaren'                  => 'McLaren',
			'Meddon'                   => 'Meddon',
			'MedievalSharp'            => 'MedievalSharp',
			'Medula One'               => 'Medula One',
			'Megrim'                   => 'Megrim',
			'Meie Script'              => 'Meie Script',
			'Merienda'                 => 'Merienda',
			'Merienda One'             => 'Merienda One',
			'Merriweather'             => 'Merriweather',
			'Merriweather Sans'        => 'Merriweather Sans',
			'Metal'                    => 'Metal',
			'Metal Mania'              => 'Metal Mania',
			'Metamorphous'             => 'Metamorphous',
			'Metrophobic'              => 'Metrophobic',
			'Michroma'                 => 'Michroma',
			'Milonga'                  => 'Milonga',
			'Miltonian'                => 'Miltonian',
			'Miltonian Tattoo'         => 'Miltonian Tattoo',
			'Miniver'                  => 'Miniver',
			'Miss Fajardose'           => 'Miss Fajardose',
			'Modern Antiqua'           => 'Modern Antiqua',
			'Molengo'                  => 'Molengo',
			'Molle'                    => 'Molle',
			'Monda'                    => 'Monda',
			'Monofett'                 => 'Monofett',
			'Monoton'                  => 'Monoton',
			'Monsieur La Doulaise'     => 'Monsieur La Doulaise',
			'Montaga'                  => 'Montaga',
			'Montez'                   => 'Montez',
			'Montserrat'               => 'Montserrat',
			'Montserrat Alternates'    => 'Montserrat Alternates',
			'Montserrat Subrayada'     => 'Montserrat Subrayada',
			'Moul'                     => 'Moul',
			'Moulpali'                 => 'Moulpali',
			'Mountains of Christmas'   => 'Mountains of Christmas',
			'Mouse Memoirs'            => 'Mouse Memoirs',
			'Mr Bedfort'               => 'Mr Bedfort',
			'Mr Dafoe'                 => 'Mr Dafoe',
			'Mr De Haviland'           => 'Mr De Haviland',
			'Mrs Saint Delafield'      => 'Mrs Saint Delafield',
			'Mrs Sheppards'            => 'Mrs Sheppards',
			'Muli'                     => 'Muli',
			'Mystery Quest'            => 'Mystery Quest',
			'NTR'                      => 'NTR',
			'Neucha'                   => 'Neucha',
			'Neuton'                   => 'Neuton',
			'New Rocker'               => 'New Rocker',
			'News Cycle'               => 'News Cycle',
			'Niconne'                  => 'Niconne',
			'Nixie One'                => 'Nixie One',
			'Nobile'                   => 'Nobile',
			'Nokora'                   => 'Nokora',
			'Norican'                  => 'Norican',
			'Nosifer'                  => 'Nosifer',
			'Nothing You Could Do'     => 'Nothing You Could Do',
			'Noticia Text'             => 'Noticia Text',
			'Noto Sans'                => 'Noto Sans',
			'Noto Serif'               => 'Noto Serif',
			'Nova Cut'                 => 'Nova Cut',
			'Nova Flat'                => 'Nova Flat',
			'Nova Mono'                => 'Nova Mono',
			'Nova Oval'                => 'Nova Oval',
			'Nova Round'               => 'Nova Round',
			'Nova Script'              => 'Nova Script',
			'Nova Slim'                => 'Nova Slim',
			'Nova Square'              => 'Nova Square',
			'Numans'                   => 'Numans',
			'Nunito'                   => 'Nunito',
			'Odor Mean Chey'           => 'Odor Mean Chey',
			'Offside'                  => 'Offside',
			'Old Standard TT'          => 'Old Standard TT',
			'Oldenburg'                => 'Oldenburg',
			'Oleo Script'              => 'Oleo Script',
			'Oleo Script Swash Caps'   => 'Oleo Script Swash Caps',
			'Open Sans'                => 'Open Sans',
			'Open Sans Condensed'      => 'Open Sans Condensed',
			'Oranienbaum'              => 'Oranienbaum',
			'Orbitron'                 => 'Orbitron',
			'Oregano'                  => 'Oregano',
			'Orienta'                  => 'Orienta',
			'Original Surfer'          => 'Original Surfer',
			'Oswald'                   => 'Oswald',
			'Over the Rainbow'         => 'Over the Rainbow',
			'Overlock'                 => 'Overlock',
			'Overlock SC'              => 'Overlock SC',
			'Ovo'                      => 'Ovo',
			'Oxygen'                   => 'Oxygen',
			'Oxygen Mono'              => 'Oxygen Mono',
			'PT Mono'                  => 'PT Mono',
			'PT Sans'                  => 'PT Sans',
			'PT Sans Caption'          => 'PT Sans Caption',
			'PT Sans Narrow'           => 'PT Sans Narrow',
			'PT Serif'                 => 'PT Serif',
			'PT Serif Caption'         => 'PT Serif Caption',
			'Pacifico'                 => 'Pacifico',
			'Paprika'                  => 'Paprika',
			'Parisienne'               => 'Parisienne',
			'Passero One'              => 'Passero One',
			'Passion One'              => 'Passion One',
			'Pathway Gothic One'       => 'Pathway Gothic One',
			'Patrick Hand'             => 'Patrick Hand',
			'Patrick Hand SC'          => 'Patrick Hand SC',
			'Patua One'                => 'Patua One',
			'Paytone One'              => 'Paytone One',
			'Peddana'                  => 'Peddana',
			'Peralta'                  => 'Peralta',
			'Permanent Marker'         => 'Permanent Marker',
			'Petit Formal Script'      => 'Petit Formal Script',
			'Petrona'                  => 'Petrona',
			'Philosopher'              => 'Philosopher',
			'Piedra'                   => 'Piedra',
			'Pinyon Script'            => 'Pinyon Script',
			'Pirata One'               => 'Pirata One',
			'Plaster'                  => 'Plaster',
			'Play'                     => 'Play',
			'Playball'                 => 'Playball',
			'Playfair Display'         => 'Playfair Display',
			'Playfair Display SC'      => 'Playfair Display SC',
			'Podkova'                  => 'Podkova',
			'Poiret One'               => 'Poiret One',
			'Poller One'               => 'Poller One',
			'Poly'                     => 'Poly',
			'Pompiere'                 => 'Pompiere',
			'Pontano Sans'             => 'Pontano Sans',
			'Poppins'                  => 'Poppins',
			'Port Lligat Sans'         => 'Port Lligat Sans',
			'Port Lligat Slab'         => 'Port Lligat Slab',
			'Prata'                    => 'Prata',
			'Preahvihear'              => 'Preahvihear',
			'Press Start 2P'           => 'Press Start 2P',
			'Princess Sofia'           => 'Princess Sofia',
			'Prociono'                 => 'Prociono',
			'Prosto One'               => 'Prosto One',
			'Proza Libre'              => 'Proza Libre',
			'Puritan'                  => 'Puritan',
			'Purple Purse'             => 'Purple Purse',
			'Quando'                   => 'Quando',
			'Quantico'                 => 'Quantico',
			'Quattrocento'             => 'Quattrocento',
			'Quattrocento Sans'        => 'Quattrocento Sans',
			'Questrial'                => 'Questrial',
			'Quicksand'                => 'Quicksand',
			'Quintessential'           => 'Quintessential',
			'Qwigley'                  => 'Qwigley',
			'Racing Sans One'          => 'Racing Sans One',
			'Radley'                   => 'Radley',
			'Rajdhani'                 => 'Rajdhani',
			'Raleway'                  => 'Raleway',
			'Raleway Dots'             => 'Raleway Dots',
			'Ramabhadra'               => 'Ramabhadra',
			'Ramaraja'                 => 'Ramaraja',
			'Rambla'                   => 'Rambla',
			'Rammetto One'             => 'Rammetto One',
			'Ranchers'                 => 'Ranchers',
			'Rancho'                   => 'Rancho',
			'Ranga'                    => 'Ranga',
			'Rationale'                => 'Rationale',
			'Ravi Prakash'             => 'Ravi Prakash',
			'Redressed'                => 'Redressed',
			'Reenie Beanie'            => 'Reenie Beanie',
			'Revalia'                  => 'Revalia',
			'Ribeye'                   => 'Ribeye',
			'Ribeye Marrow'            => 'Ribeye Marrow',
			'Righteous'                => 'Righteous',
			'Risque'                   => 'Risque',
			'Roboto'                   => 'Roboto',
			'Roboto Condensed'         => 'Roboto Condensed',
			'Roboto Mono'              => 'Roboto Mono',
			'Roboto Slab'              => 'Roboto Slab',
			'Rochester'                => 'Rochester',
			'Rock Salt'                => 'Rock Salt',
			'Rokkitt'                  => 'Rokkitt',
			'Romanesco'                => 'Romanesco',
			'Ropa Sans'                => 'Ropa Sans',
			'Rosario'                  => 'Rosario',
			'Rosarivo'                 => 'Rosarivo',
			'Rouge Script'             => 'Rouge Script',
			'Rozha One'                => 'Rozha One',
			'Rubik'                    => 'Rubik',
			'Rubik Mono One'           => 'Rubik Mono One',
			'Rubik One'                => 'Rubik One',
			'Ruda'                     => 'Ruda',
			'Rufina'                   => 'Rufina',
			'Ruge Boogie'              => 'Ruge Boogie',
			'Ruluko'                   => 'Ruluko',
			'Rum Raisin'               => 'Rum Raisin',
			'Ruslan Display'           => 'Ruslan Display',
			'Russo One'                => 'Russo One',
			'Ruthie'                   => 'Ruthie',
			'Rye'                      => 'Rye',
			'Sacramento'               => 'Sacramento',
			'Sail'                     => 'Sail',
			'Salsa'                    => 'Salsa',
			'Sanchez'                  => 'Sanchez',
			'Sancreek'                 => 'Sancreek',
			'Sansita One'              => 'Sansita One',
			'Sarina'                   => 'Sarina',
			'Sarpanch'                 => 'Sarpanch',
			'Satisfy'                  => 'Satisfy',
			'Scada'                    => 'Scada',
			'Schoolbell'               => 'Schoolbell',
			'Seaweed Script'           => 'Seaweed Script',
			'Sevillana'                => 'Sevillana',
			'Seymour One'              => 'Seymour One',
			'Shadows Into Light'       => 'Shadows Into Light',
			'Shadows Into Light Two'   => 'Shadows Into Light Two',
			'Shanti'                   => 'Shanti',
			'Share'                    => 'Share',
			'Share Tech'               => 'Share Tech',
			'Share Tech Mono'          => 'Share Tech Mono',
			'Shojumaru'                => 'Shojumaru',
			'Short Stack'              => 'Short Stack',
			'Shrikhand'                => 'Shrikhand',
			'Siemreap'                 => 'Siemreap',
			'Sigmar One'               => 'Sigmar One',
			'Signika'                  => 'Signika',
			'Signika Negative'         => 'Signika Negative',
			'Simonetta'                => 'Simonetta',
			'Sintony'                  => 'Sintony',
			'Sirin Stencil'            => 'Sirin Stencil',
			'Six Caps'                 => 'Six Caps',
			'Skranji'                  => 'Skranji',
			'Slabo 13px'               => 'Slabo 13px',
			'Slabo 27px'               => 'Slabo 27px',
			'Slackey'                  => 'Slackey',
			'Smokum'                   => 'Smokum',
			'Smythe'                   => 'Smythe',
			'Sniglet'                  => 'Sniglet',
			'Snippet'                  => 'Snippet',
			'Snowburst One'            => 'Snowburst One',
			'Sofadi One'               => 'Sofadi One',
			'Sofia'                    => 'Sofia',
			'Sonsie One'               => 'Sonsie One',
			'Sorts Mill Goudy'         => 'Sorts Mill Goudy',
			'Source Code Pro'          => 'Source Code Pro',
			'Source Sans Pro'          => 'Source Sans Pro',
			'Source Serif Pro'         => 'Source Serif Pro',
			'Special Elite'            => 'Special Elite',
			'Spicy Rice'               => 'Spicy Rice',
			'Spinnaker'                => 'Spinnaker',
			'Spirax'                   => 'Spirax',
			'Squada One'               => 'Squada One',
			'Sree Krushnadevaraya'     => 'Sree Krushnadevaraya',
			'Stalemate'                => 'Stalemate',
			'Stalinist One'            => 'Stalinist One',
			'Stardos Stencil'          => 'Stardos Stencil',
			'Stint Ultra Condensed'    => 'Stint Ultra Condensed',
			'Stint Ultra Expanded'     => 'Stint Ultra Expanded',
			'Stoke'                    => 'Stoke',
			'Strait'                   => 'Strait',
			'Sue Ellen Francisco'      => 'Sue Ellen Francisco',
			'Sunshiney'                => 'Sunshiney',
			'Supermercado One'         => 'Supermercado One',
			'Suranna'                  => 'Suranna',
			'Suravaram'                => 'Suravaram',
			'Suwannaphum'              => 'Suwannaphum',
			'Swanky and Moo Moo'       => 'Swanky and Moo Moo',
			'Syncopate'                => 'Syncopate',
			'Tangerine'                => 'Tangerine',
			'Taprom'                   => 'Taprom',
			'Tauri'                    => 'Tauri',
			'Taviraj'                  => 'Taviraj',
			'Teko'                     => 'Teko',
			'Telex'                    => 'Telex',
			'Tenali Ramakrishna'       => 'Tenali Ramakrishna',
			'Tenor Sans'               => 'Tenor Sans',
			'Text Me One'              => 'Text Me One',
			'The Girl Next Door'       => 'The Girl Next Door',
			'Tienne'                   => 'Tienne',
			'Timmana'                  => 'Timmana',
			'Tinos'                    => 'Tinos',
			'Titan One'                => 'Titan One',
			'Titillium Web'            => 'Titillium Web',
			'Trade Winds'              => 'Trade Winds',
			'Trirong'                  => 'Trirong',
			'Trocchi'                  => 'Trocchi',
			'Trochut'                  => 'Trochut',
			'Trykker'                  => 'Trykker',
			'Tulpen One'               => 'Tulpen One',
			'Ubuntu'                   => 'Ubuntu',
			'Ubuntu Condensed'         => 'Ubuntu Condensed',
			'Ubuntu Mono'              => 'Ubuntu Mono',
			'Ultra'                    => 'Ultra',
			'Uncial Antiqua'           => 'Uncial Antiqua',
			'Underdog'                 => 'Underdog',
			'Unica One'                => 'Unica One',
			'UnifrakturCook'           => 'UnifrakturCook',
			'UnifrakturMaguntia'       => 'UnifrakturMaguntia',
			'Unkempt'                  => 'Unkempt',
			'Unlock'                   => 'Unlock',
			'Unna'                     => 'Unna',
			'VT323'                    => 'VT323',
			'Vampiro One'              => 'Vampiro One',
			'Varela'                   => 'Varela',
			'Varela Round'             => 'Varela Round',
			'Vast Shadow'              => 'Vast Shadow',
			'Vesper Libre'             => 'Vesper Libre',
			'Vibur'                    => 'Vibur',
			'Vidaloka'                 => 'Vidaloka',
			'Viga'                     => 'Viga',
			'Voces'                    => 'Voces',
			'Volkhov'                  => 'Volkhov',
			'Vollkorn'                 => 'Vollkorn',
			'Voltaire'                 => 'Voltaire',
			'Waiting for the Sunrise'  => 'Waiting for the Sunrise',
			'Wallpoet'                 => 'Wallpoet',
			'Walter Turncoat'          => 'Walter Turncoat',
			'Warnes'                   => 'Warnes',
			'Wellfleet'                => 'Wellfleet',
			'Wendy One'                => 'Wendy One',
			'Wire One'                 => 'Wire One',
			'Work Sans'                => 'Work Sans',
			'Yanone Kaffeesatz'        => 'Yanone Kaffeesatz',
			'Yellowtail'               => 'Yellowtail',
			'Yeseva One'               => 'Yeseva One',
			'Yesteryear'               => 'Yesteryear',
			'Zeyada'                   => 'Zeyada',
		);

		// Get Theme Options from Database.
		$theme_options = zeeDynamic_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = zeeDynamic_Pro_Customizer::get_default_options();

		// Remove default theme fonts from Google fonts.
		if ( isset( $default_options['text_font'] ) and array_key_exists( $default_options['text_font'], $fonts ) ) :
			unset( $fonts[ trim( $default_options['text_font'] ) ] );
		endif;
		if ( isset( $default_options['title_font'] ) and array_key_exists( $default_options['title_font'], $fonts ) ) :
			unset( $fonts[ trim( $default_options['title_font'] ) ] );
		endif;
		if ( isset( $default_options['navi_font'] ) and array_key_exists( $default_options['navi_font'], $fonts ) ) :
			unset( $fonts[ trim( $default_options['navi_font'] ) ] );
		endif;
		if ( isset( $default_options['widget_title_font'] ) and array_key_exists( $default_options['widget_title_font'], $fonts ) ) :
			unset( $fonts[ trim( $default_options['widget_title_font'] ) ] );
		endif;

		// Sort fonts alphabetically.
		asort( $fonts );

		return $fonts;
	}
}

// Run Class.
add_action( 'init', array( 'zeeDynamic_Pro_Custom_Fonts', 'setup' ) );
