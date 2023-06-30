<?php
/*
 * Plugin Name: Pronamic WooCommerce Gateway Order Button Text Setting
 */

add_action(
	'init',
	function() {
		$payment_gateways = wc()->payment_gateways()->payment_gateways();

		foreach( $payment_gateways as $payment_gateway ) {
			add_filter( 'woocommerce_settings_api_form_fields_' . $payment_gateway->id, 'pronamic_add_order_button_text_setting' );

			$order_button_text = (string) $payment_gateway->get_option( 'pronamic_order_button_text' );

			if ( '' !== $order_button_text ) {
				$payment_gateway->order_button_text = $order_button_text;
			}
		}
	},
	1000
);

function pronamic_add_order_button_text_setting( $fields ) {
	$fields['pronamic_order_button_text'] = [
		'title'    => __( 'Order Button Text', 'pronamic-woocommerce-gateway-order-button-text-setting'),
		'type'     => 'text',
		'default'  => '',
    ];

	return $fields;
}
