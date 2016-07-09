<?php
/**
 * zeeDynamic Pro Settings Class
 *
 * Registers all plugin settings with the WordPress Settings API.
 * Handles license key activation with the ThemeZee Store API.
 *
 * @link https://codex.wordpress.org/Settings_API
 * @package zeeDynamic Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Settings Class
 */
class zeeDynamic_Pro_Settings {
	/** Singleton *************************************************************/

	/**
	 * @var instance The one true zeeDynamic_Pro_Settings instance
	 */
	private static $instance;

	/**
	 * @var options Plugin options array
	 */
	private $options;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @return zeeDynamic_Pro_Settings A single instance of this class.
	 */
	public static function instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Plugin Setup
	 *
	 * @return void
	 */
	public function __construct() {

		// Register License Settings.
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// Add License API functions.
		add_action( 'admin_init', array( $this, 'activate_license' ) );
		add_action( 'admin_init', array( $this, 'deactivate_license' ) );
		add_action( 'admin_init', array( $this, 'check_license' ) );

		// Merge Plugin Options Array from Database with Default Settings array.
		$this->options = wp_parse_args( get_option( 'zeedynamic_pro_settings' , array() ), $this->default_settings() );
	}

	/**
	 * Get the value of a specific setting
	 *
	 * @param String $key     Settings key.
	 * @param String $default Default value.
	 * @return mixed
	 */
	public function get( $key, $default = false ) {
		$value = ! empty( $this->options[ $key ] ) ? $this->options[ $key ] : $default;
		return $value;
	}

	/**
	 * Get all settings
	 *
	 * @return array
	 */
	public function get_all() {
		return $this->options;
	}

	/**
	 * Retrieve default settings
	 *
	 * @return array
	 */
	public function default_settings() {

		$default_settings = array(
			'license_key' => '',
			'license_status' => 'inactive',
		);

		return $default_settings;
	}

	/**
	 * Register all settings sections and fields
	 *
	 * @return void
	 */
	function register_settings() {

		// Make sure that options exist in database.
		if ( false == get_option( 'zeedynamic_pro_settings' ) ) {
			add_option( 'zeedynamic_pro_settings' );
		}

		// Add License Section.
		add_settings_section( 'zeedynamic_pro_settings_license', esc_html__( 'Automatic Updates', 'zeedynamic-pro' ), array( $this, 'license_section_intro' ), 'zeedynamic_pro_settings' );

		// Add License Status Setting.
		add_settings_field(
			'zeedynamic_pro_settings[license_status]',
			esc_html__( 'License Status', 'zeedynamic-pro' ),
			array( $this, 'license_status' ),
			'zeedynamic_pro_settings',
			'zeedynamic_pro_settings_license'
		);

		// Add License Key Setting.
		add_settings_field(
			'zeedynamic_pro_settings[license_key]',
			esc_html__( 'License Key', 'zeedynamic-pro' ),
			array( $this, 'license_key' ),
			'zeedynamic_pro_settings',
			'zeedynamic_pro_settings_license'
		);

		// Creates our settings in the options table.
		register_setting( 'zeedynamic_pro_settings', 'zeedynamic_pro_settings', array( $this, 'sanitize_settings' ) );
	}

	/**
	 * License Section Intro
	 *
	 * @return void
	 */
	function license_section_intro() {
		printf( __( 'Please enter your license key. An active license key is needed for automatic plugin updates and <a href="%s" target="_blank">support</a>.', 'zeedynamic-pro' ), 'https://themezee.com/support/?utm_source=plugin-settings&utm_medium=textlink&utm_campaign=zeedynamic-pro&utm_content=support' );

	}

	/**
	 * Sanitize the Plugin Settings
	 *
	 * @param array $input User Input.
	 * @return array
	 */
	function sanitize_settings( $input = array() ) {

		if ( empty( $_POST['_wp_http_referer'] ) ) {
			return $input;
		}

		$saved    = get_option( 'zeedynamic_pro_settings', array() );
		if ( ! is_array( $saved ) ) {
			$saved = array();
		}

		$input = $input ? $input : array();

		// Loop through each setting being saved and pass it through a sanitization filter.
		foreach ( $input as $key => $value ) :

			$input[ $key ] = sanitize_text_field( $value );

		endforeach;

		return array_merge( $saved, $input );

	}

	/**
	 * License Status Callback
	 *
	 * Renders license status field.
	 *
	 * @global $this->options Array of all the zeeDynamic Pro Options
	 * @return void
	 */
	function license_status() {

		$license_status = $this->get( 'license_status' );
		$license_key = ! empty( $this->options['license_key'] ) ? $this->options['license_key'] : false;
		$html = '';

		if ( 'valid' === $license_status ) {

			$html .= '<span class="license-status license-active">' . esc_html__( 'Active', 'zeedynamic-pro' ) . '</span>';
			$html .= '<span class="license-description">' . esc_html__( 'You are receiving updates.', 'zeedynamic-pro' ) . '</span>';

		} elseif ( 'expired' === $license_status ) {

			$renewal_url = esc_url( add_query_arg( array( 'edd_license_key' => $license_key, 'download_id' => ZEEDYNAMIC_PRO_PRODUCT_ID ), 'https://themezee.com/checkout' ) );

			$html .= '<span class="license-status license-expired">' . esc_html__( 'Expired', 'zeedynamic-pro' ) . '</span>';
			$html .= '<p class="license-description">' . esc_html__( 'Your license has expired, renew today to continue getting updates and support!', 'zeedynamic-pro' ) . '</p>';
			$html .= '<a href="' . esc_url( $renewal_url ) . '" class="license-renewal button-primary">' . esc_html__( 'Renew Your License', 'zeedynamic-pro' ) . '</a>';

		} elseif ( 'invalid' === $license_status ) {

			$html .= '<span class="license-status license-invalid">' . esc_html__( 'Invalid', 'zeedynamic-pro' ) . '</span>';
			$html .= '<p class="license-description">' . esc_html__( 'Please make sure that you have not reached the site limit and expiration date.', 'zeedynamic-pro' ) . '</p>';

		} else {

			$html .= '<span class="license-status license-inactive">' . esc_html__( 'Inactive', 'zeedynamic-pro' ) . '</span>';

		}

		echo $html;
	}

	/**
	 * License Key Callback
	 *
	 * Renders license key field.
	 *
	 * @global $this->options Array of all the zeeDynamic Pro Options
	 * @return void
	 */
	function license_key() {

		$license_status = $this->get( 'license_status' );
		$license_key = ! empty( $this->options['license_key'] ) ? $this->options['license_key'] : false;
		$html = '';

		if ( 'valid' === $license_status && ! empty( $license_key ) ) {

			$html .= '<input type="text" class="regular-text" readonly="readonly" id="zeedynamic_pro_settings[license_key]" name="zeedynamic_pro_settings[license_key]" value="' . esc_attr( stripslashes( $license_key ) ) . '"/><br/><br/>';
			$html .= '<input type="submit" class="button" name="zeedynamic_pro_deactivate_license" value="' . esc_attr__( 'Deactivate License', 'zeedynamic-pro' ) . '"/>';

		} else {

			$html .= '<input type="text" class="regular-text" id="zeedynamic_pro_settings[license_key]" name="zeedynamic_pro_settings[license_key]" value="' . esc_attr( stripslashes( $license_key ) ) . '"/><br/><br/>';
			$html .= '<input type="submit" class="button" name="zeedynamic_pro_activate_license" value="' . esc_attr__( 'Activate License', 'zeedynamic-pro' ) . '"/>';

		}

		echo $html;
	}

	/**
	 * Activate license key
	 *
	 * @return void
	 */
	public function activate_license() {

		if ( ! isset( $_POST['zeedynamic_pro_settings'] ) ) {
			return;
		}

		if ( ! isset( $_POST['zeedynamic_pro_activate_license'] ) ) {
			return;
		}

		if ( ! isset( $_POST['zeedynamic_pro_settings']['license_key'] ) ) {
			return;
		}

		// Retrieve the license from the database.
		$status  = $this->get( 'license_status' );
		$license = trim( $_POST['zeedynamic_pro_settings']['license_key'] );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( ZEEDYNAMIC_PRO_NAME ),
			'item_id'   => ZEEDYNAMIC_PRO_PRODUCT_ID,
			'url'       => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post( ZEEDYNAMIC_PRO_STORE_API_URL, array( 'timeout' => 35, 'sslverify' => true, 'body' => $api_params ) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// Decode the license data.
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		$options = $this->get_all();

		$options['license_status'] = $license_data->license;

		update_option( 'zeedynamic_pro_settings', $options );

		delete_transient( 'zeedynamic_pro_license_check' );
	}

	/**
	 * Deactivate license key
	 *
	 * @return void
	 */
	public function deactivate_license() {

		if ( ! isset( $_POST['zeedynamic_pro_settings'] ) ) {
			return;
		}

		if ( ! isset( $_POST['zeedynamic_pro_deactivate_license'] ) ) {
			return;
		}

		if ( ! isset( $_POST['zeedynamic_pro_settings']['license_key'] ) ) {
			return;
		}

		// Retrieve the license from the database.
		$license = trim( $_POST['zeedynamic_pro_settings']['license_key'] );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( ZEEDYNAMIC_PRO_NAME ),
			'item_id'   => ZEEDYNAMIC_PRO_PRODUCT_ID,
			'url'       => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post( ZEEDYNAMIC_PRO_STORE_API_URL, array( 'timeout' => 35, 'sslverify' => true, 'body' => $api_params ) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$options = $this->get_all();

		$options['license_status'] = 'inactive';

		update_option( 'zeedynamic_pro_settings', $options );

		delete_transient( 'zeedynamic_pro_license_check' );
	}

	/**
	 * Check license key
	 *
	 * @return void
	 */
	public function check_license() {

		if ( ! empty( $_POST['zeedynamic_pro_settings'] ) ) {
			return; // Don't fire when saving settings.
		}

		$status = get_transient( 'zeedynamic_pro_license_check' );

		// Run the license check a maximum of once per day.
		if ( false === $status ) {

			$options = $this->get_all();
			$license_key = $options['license_key'];

			if ( '' !== $license_key and 'inactive' !== $options['license_status'] ) {

				// Data to send in our API request.
				$api_params = array(
					'edd_action' => 'check_license',
					'license' 	=> $license_key,
					'item_name' => urlencode( ZEEDYNAMIC_PRO_NAME ),
					'item_id'   => ZEEDYNAMIC_PRO_PRODUCT_ID,
					'url'       => home_url(),
				);

				// Call the custom API.
				$response = wp_remote_post( ZEEDYNAMIC_PRO_STORE_API_URL, array( 'timeout' => 25, 'sslverify' => true, 'body' => $api_params ) );

				// Make sure the response came back okay.
				if ( is_wp_error( $response ) ) {
					return false;
				}

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				$status = $license_data->license;

			} else {

				$status = 'inactive';

			}

			$options['license_status'] = $status;

			update_option( 'zeedynamic_pro_settings', $options );

			set_transient( 'zeedynamic_pro_license_check', $status, DAY_IN_SECONDS );

		}

		return $status;
	}

	/**
	 * Retrieve license status
	 *
	 * @return bool
	 */
	public function is_license_valid() {
		return $this->check_license() == 'valid';
	}
}

// Run Setting Class.
zeeDynamic_Pro_Settings::instance();
