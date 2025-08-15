<?php
/* Cool Timeline support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hoverex_cool_timeline_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'hoverex_cool_timeline_theme_setup9', 9 );
	function hoverex_cool_timeline_theme_setup9() {
		if ( hoverex_exists_cool_timeline() ) {
			add_filter( 'hoverex_filter_merge_styles', 'hoverex_cool_timeline_merge_styles' );
			add_filter( 'hoverex_filter_merge_styles_responsive', 'hoverex_cool_timeline_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins', 'hoverex_cool_timeline_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'hoverex_cool_timeline_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('hoverex_filter_tgmpa_required_plugins',	'hoverex_cool_timeline_tgmpa_required_plugins');
	function hoverex_cool_timeline_tgmpa_required_plugins( $list = array() ) {
		if ( hoverex_storage_isset( 'required_plugins', 'cool-timeline' ) && hoverex_storage_isset( 'required_plugins', 'cool-timeline' ) && hoverex_storage_get_array( 'required_plugins', 'cool-timeline', 'install' ) !== false ) {
			$list[] = array(
				'name'     => hoverex_storage_get_array( 'required_plugins', 'cool-timeline'),
				'slug'     => 'cool-timeline',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'hoverex_exists_cool_timeline' ) ) {
	function hoverex_exists_cool_timeline() {
		return class_exists( 'CoolTimeline' );
	}
}

// Merge custom styles
if ( ! function_exists( 'hoverex_cool_timeline_merge_styles' ) ) {
	//Handler of the add_filter('hoverex_filter_merge_styles', 'hoverex_cool_timeline_merge_styles');
	function hoverex_cool_timeline_merge_styles( $list ) {
		$list[] = 'plugins/cool-timeline/_cool-timeline.scss';
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'hoverex_cool_timeline_merge_styles_responsive' ) ) {
	//Handler of the add_filter('hoverex_filter_merge_styles_responsive', 'hoverex_cool_timeline_merge_styles_responsive');
	function hoverex_cool_timeline_merge_styles_responsive( $list ) {
		$list[] = 'plugins/cool-timeline/_cool-timeline-responsive.scss';
		return $list;
	}
}

/* Import Options */
// Set plugin's specific importer options
if ( !function_exists( 'hoverex_cool_timeline_importer_set_options' ) ) {
    add_filter( 'trx_addons_filter_importer_options',	'hoverex_cool_timeline_importer_set_options' );
    function hoverex_cool_timeline_importer_set_options($options=array()) {
        if ( hoverex_exists_cool_timeline() && hoverex_storage_isset( 'required_plugins', 'cool-timeline' ) ) {
            $options['additional_options'][]	= 'wp_options';
        }
        return $options;
    }
}

// Add plugin-specific colors and fonts to the custom CSS
if ( hoverex_exists_cool_timeline() ) {
	require_once HOVEREX_THEME_DIR . 'plugins/cool-timeline/cool-timeline-style.php';
}
?>