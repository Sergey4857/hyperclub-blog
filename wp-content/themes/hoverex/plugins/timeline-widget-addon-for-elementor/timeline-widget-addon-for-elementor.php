<?php
/* Timeline Widget Addon For Elementor support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hoverex_timeline_widget_addon_for_elementor_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'hoverex_timeline_widget_addon_for_elementor_theme_setup9', 9 );
	function hoverex_timeline_widget_addon_for_elementor_theme_setup9() {
		if ( hoverex_exists_timeline_widget_addon_for_elementor() ) {
			add_action( 'wp_enqueue_scripts', 'hoverex_timeline_widget_addon_for_elementor_frontend_scripts', 1100 );
			add_filter( 'hoverex_filter_merge_styles', 'hoverex_timeline_widget_addon_for_elementor_merge_styles' );
			add_filter( 'hoverex_filter_merge_styles_responsive', 'hoverex_timeline_widget_addon_for_elementor_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins', 'hoverex_timeline_widget_addon_for_elementor_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'hoverex_timeline_widget_addon_for_elementor_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('hoverex_filter_tgmpa_required_plugins',	'hoverex_timeline_widget_addon_for_elementor_tgmpa_required_plugins');
	function hoverex_timeline_widget_addon_for_elementor_tgmpa_required_plugins( $list = array() ) {
		if ( hoverex_storage_isset( 'required_plugins', 'timeline-widget-addon-for-elementor' ) && hoverex_storage_get_array( 'required_plugins', 'timeline-widget-addon-for-elementor', 'install' ) !== false ) {
			$list[] = array(
				'name'     => hoverex_storage_get_array( 'required_plugins', 'timeline-widget-addon-for-elementor'),
				'slug'     => 'timeline-widget-addon-for-elementor',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'hoverex_exists_timeline_widget_addon_for_elementor' ) ) {
	function hoverex_exists_timeline_widget_addon_for_elementor() {
		return class_exists( 'Timeline_Widget_Addon' );
	}
}

// Merge custom styles
if ( ! function_exists( 'hoverex_timeline_widget_addon_for_elementor_merge_styles' ) ) {
	//Handler of the add_filter('hoverex_filter_merge_styles', 'hoverex_timeline_widget_addon_for_elementor_merge_styles');
	function hoverex_timeline_widget_addon_for_elementor_merge_styles( $list ) {
		$list[] = 'plugins/timeline-widget-addon-for-elementor/_timeline-widget-addon-for-elementor-style.scss';
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'hoverex_timeline_widget_addon_for_elementor_merge_styles_responsive' ) ) {
	//Handler of the add_filter('hoverex_filter_merge_styles_responsive', 'hoverex_timeline_widget_addon_for_elementor_merge_styles_responsive');
	function hoverex_timeline_widget_addon_for_elementor_merge_styles_responsive( $list ) {
		$list[] = 'plugins/timeline-widget-addon-for-elementor/_timeline-widget-addon-for-elementor-style-responsive.scss';
		return $list;
	}
}

/* Import Options */
// Set plugin's specific importer options
if ( !function_exists( 'hoverex_timeline_widget_addon_for_elementor_importer_set_options' ) ) {
    add_filter( 'trx_addons_filter_importer_options',	'hoverex_timeline_widget_addon_for_elementor_importer_set_options' );
    function hoverex_timeline_widget_addon_for_elementor_importer_set_options($options=array()) {
        if ( hoverex_exists_timeline_widget_addon_for_elementor() && hoverex_storage_isset( 'required_plugins', 'timeline-widget-addon-for-elementor' ) ) {
            $options['additional_options'][]	= 'wp_options';
        }
        return $options;
    }
}

// Add plugin-specific colors and fonts to the custom CSS
if ( hoverex_exists_timeline_widget_addon_for_elementor() ) {
	require_once HOVEREX_THEME_DIR . 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor-style.php';
}

// Binds JS listener to Customizer controls.
if ( ! function_exists( 'hoverex_timeline_widget_addon_for_elementor_frontend_scripts' ) && hoverex_exists_timeline_widget_addon_for_elementor() ) {
	add_action( 'wp_enqueue_scripts', 'hoverex_timeline_widget_addon_for_elementor_frontend_scripts' );
	function hoverex_timeline_widget_addon_for_elementor_frontend_scripts() {
		wp_enqueue_script(
			'hoverex-timeline-widget-addon-for-elementor',
			hoverex_get_file_url( 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor.js' ),
			array( 'jquery' ), null, true
		);
	}
}