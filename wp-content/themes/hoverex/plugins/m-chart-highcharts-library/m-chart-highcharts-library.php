<?php
/* M Chart Highcharts Library support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hoverex_m_chart_highcharts_library_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'hoverex_m_chart_highcharts_library_theme_setup9', 9 );
	function hoverex_m_chart_highcharts_library_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins', 'hoverex_m_chart_highcharts_library_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'hoverex_m_chart_highcharts_library_tgmpa_required_plugins' ) ) {
	
	function hoverex_m_chart_highcharts_library_tgmpa_required_plugins( $list = array() ) {
		if ( hoverex_storage_isset( 'required_plugins', 'm-chart-highcharts-library' ) ) {
			$path = hoverex_get_file_dir( 'plugins/m-chart-highcharts-library/m-chart-highcharts-library.zip' );
			
			$list[] = array(
				'name'     => hoverex_storage_get_array( 'required_plugins', 'm-chart-highcharts-library' ),
				'slug'     => 'm-chart-highcharts-library',
				'version'  => '1.2.3',
				'source'   => ! empty( $path ) ? $path : 'upload://m-chart-highcharts-library.zip',
				'required' => false
			);
		}
		
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'hoverex_exists_m_chart_highcharts_library' ) ) {
	function hoverex_exists_m_chart_highcharts_library() {
		return class_exists( 'M_Chart' );
	}
}
