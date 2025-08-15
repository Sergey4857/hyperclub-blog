<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hoverex_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'hoverex_elegro_payment_theme_setup9', 9 );
	function hoverex_elegro_payment_theme_setup9() {
		if ( hoverex_exists_elegro_payment() ) {
			add_filter( 'hoverex_filter_merge_styles', 'hoverex_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins', 'hoverex_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'hoverex_elegro_payment_tgmpa_required_plugins' ) ) {
	function hoverex_elegro_payment_tgmpa_required_plugins( $list = array() ) {
		if ( false && hoverex_storage_isset( 'required_plugins', 'woocommerce' ) && hoverex_storage_isset( 'required_plugins', 'elegro-payment' ) && hoverex_storage_get_array( 'required_plugins', 'elegro-payment', 'install' ) !== false ) {
			$list[] = array(
				'name'     => hoverex_storage_get_array( 'required_plugins', 'elegro-payment' ),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'hoverex_exists_elegro_payment' ) ) {
	function hoverex_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}

// Merge custom styles
if ( ! function_exists( 'hoverex_elegro_payment_merge_styles' ) ) {
	function hoverex_elegro_payment_merge_styles( $list ) {
		$list[] = 'plugins/elegro-payment/_elegro-payment.scss';
		return $list;
	}
}