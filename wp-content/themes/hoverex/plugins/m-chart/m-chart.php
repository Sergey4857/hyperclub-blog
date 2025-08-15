<?php
/* M Chart support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('hoverex_chart_theme_setup9')) {
	add_action( 'after_setup_theme', 'hoverex_chart_theme_setup9', 9 );
	function hoverex_chart_theme_setup9() {
		if (is_admin()) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins',		'hoverex_chart_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'hoverex_chart_tgmpa_required_plugins' ) ) {
	function hoverex_chart_tgmpa_required_plugins($list=array()) {
		if (hoverex_storage_isset('required_plugins', 'm-chart')) {
			$list[] = array(
				'name' 		=> hoverex_storage_get_array('required_plugins', 'm-chart'),
				'slug' 		=> 'm-chart',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'hoverex_exists_m_chart' ) ) {
	function hoverex_exists_m_chart() {
		return class_exists('M_Chart');
	}
}
?>