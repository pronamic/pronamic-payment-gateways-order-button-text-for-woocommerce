<?php
/**
 * Pronamic Payment Gateways Order Button Text for WooCommerce Plugin
 *
 * @package   PronamicWooCommerceGatewayOrderButtonText
 * @author    Pronamic
 * @copyright 2023 Pronamic
 */

namespace Pronamic\WooCommerceGatewayOrderButtonText;

/**
 * Pronamic Payment Gateways Order Button Text for WooCommerce Plugin class
 */
class Plugin {
	/**
	 * Instance of this class.
	 *
	 * @var self
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @return self A single instance of this class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Setup.
	 * 
	 * @return void
	 */
	public function setup() {
		if ( \has_action( 'plugins_loaded', [ $this, 'plugins_loaded' ] ) ) {
			return;
		}

		\add_action( 'plugins_loaded', [ $this, 'plugins_loaded' ] );

		\add_action( 'init', [ $this, 'init' ], 1000 );
	}

	/**
	 * Plugins loaded.
	 * 
	 * @return void
	 */
	public function plugins_loaded() {
	}

	/**
	 * Init.
	 * 
	 * @return void
	 */
	public function init() {
		if ( ! \function_exists( '\WC' ) ) {
			return;
		}

		$payment_gateways = \WC()->payment_gateways()->payment_gateways();

		foreach ( $payment_gateways as $payment_gateway ) {
			\add_filter( 'woocommerce_settings_api_form_fields_' . $payment_gateway->id, [ $this, 'add_order_button_text_setting' ] );

			$order_button_text = (string) $payment_gateway->get_option( 'pronamic_order_button_text' );

			if ( '' !== $order_button_text ) {
				$payment_gateway->order_button_text = $order_button_text;
			}
		}
	}

	/**
	 * Add order button text setting field the specified fields.
	 * 
	 * @param array $fields Fields.
	 * @return array
	 */
	public function add_order_button_text_setting( $fields ) {
		$fields['pronamic_order_button_text'] = [
			'title'       => \__( 'Order Button Text', 'pronamic-payment-gateways-order-button-text-for-woocommerce' ),
			'type'        => 'text',
			'default'     => '',
			'description' => \__( 'This setting is added by the "Pronamic Payment Gateways Order Button Text for WooCommerce" plugin and affects what text visitors see on the WooCommerce order button, leave blank to use the default WooCommerce text.', 'pronamic-payment-gateways-order-button-text-for-woocommerce' ),
			'desc_tip'    => true,
			'placeholder' => \__( 'Pay for order', 'pronamic-payment-gateways-order-button-text-for-woocommerce' ),
		];

		return $fields;
	}
}
