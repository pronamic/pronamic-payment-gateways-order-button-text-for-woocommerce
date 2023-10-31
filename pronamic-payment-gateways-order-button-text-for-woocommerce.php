<?php
/**
 * Pronamic Payment Gateways Order Button Text for WooCommerce
 *
 * @package   PronamicWooCommerceGatewayOrderButtonText
 * @author    Pronamic
 * @copyright 2023 Pronamic
 * 
 * @wordpress-plugin
 * Plugin Name: Pronamic Payment Gateways Order Button Text for WooCommerce
 * Plugin URI: https://www.pronamic.shop/product/pronamic-payment-gateways-order-button-text-for-woocommerce/
 * Description: This WordPress plugin adds a setting to all WooCommerce gateways for customizing the order button text.
 * Version: 1.0.1
 * Requires at least: 6.1
 * Requires PHP: 8.0
 * Author: Pronamic
 * Author URI: https://www.pronamic.eu/
 * License: Proprietary
 * License URI: https://www.pronamic.shop/product/pronamic-payment-gateways-order-button-text-for-woocommerce/
 * Text Domain: pronamic-payment-gateways-order-button-text-for-woocommerce
 * Domain Path: /languages/
 * Update URI: https://wp.pronamic.directory/plugins/pronamic-payment-gateways-order-button-text-for-woocommerce/
 * WC requires at least: 8.0
 * WC tested up to: 8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload.
 */
require_once __DIR__ . '/vendor/autoload_packages.php';

/**
 * Bootstrap.
 */
add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain(
			'pronamic-payment-gateways-order-button-text-for-woocommerce',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}
);

\Pronamic\WooCommerceGatewayOrderButtonText\Plugin::instance()->setup();

\Pronamic\WordPress\Updater\Plugin::instance()->setup();
