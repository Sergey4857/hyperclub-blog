<?php
/* Elementor Builder support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('hoverex_elm_theme_setup9')) {
	add_action( 'after_setup_theme', 'hoverex_elm_theme_setup9', 9 );
	function hoverex_elm_theme_setup9() {
		
		add_filter( 'hoverex_filter_merge_styles',					'hoverex_elm_merge_styles' );
		add_filter( 'hoverex_filter_merge_styles_responsive', 		'hoverex_elm_merge_styles_responsive');
		add_filter( 'hoverex_filter_merge_scripts',					'hoverex_elm_merge_scripts');

		if (hoverex_exists_elementor()) {
			add_action( 'wp_enqueue_scripts', 						'hoverex_elm_frontend_scripts', 1100 );
			add_action( 'elementor/element/before_section_end',		'hoverex_elm_add_color_scheme_control', 10, 3 );
			add_action( 'elementor/element/before_section_end', 'hoverex_elm_move_paddings_to_column_wrap', 10, 3 );
			add_action( 'elementor/element/after_section_end',		'hoverex_elm_add_page_options', 10, 3 );
			add_action( 'init',										'hoverex_elm_init_once', 3 );
		}
		if (is_admin()) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins',	'hoverex_elm_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'hoverex_elm_tgmpa_required_plugins' ) ) {
	
	function hoverex_elm_tgmpa_required_plugins($list=array()) {
		if (hoverex_storage_isset('required_plugins', 'elementor')) {
			$list[] = array(
				'name' 		=> hoverex_storage_get_array('required_plugins', 'elementor'),
				'slug' 		=> 'elementor',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if Elementor is installed and activated
if ( !function_exists( 'hoverex_exists_elementor' ) ) {
	function hoverex_exists_elementor() {
		return class_exists('Elementor\Plugin');
	}
}
	
// Merge custom styles
if ( !function_exists( 'hoverex_elm_merge_styles' ) ) {
	
	function hoverex_elm_merge_styles($list) {
		if (hoverex_exists_elementor()) {
			$list[] = 'plugins/elementor/_elementor.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( !function_exists( 'hoverex_elm_merge_styles_responsive' ) ) {
	
	function hoverex_elm_merge_styles_responsive($list) {
		if (hoverex_exists_elementor()) {
			$list[] = 'plugins/elementor/_elementor-responsive.scss';
		}
		return $list;
	}
}

// Merge custom scripts
if ( !function_exists( 'hoverex_elm_merge_scripts' ) ) {
	
	function hoverex_elm_merge_scripts($list) {
		
		
		return $list;
	}
}

// Enqueue Elementor's support script
if ( !function_exists( 'hoverex_elm_frontend_scripts' ) ) {
	
	function hoverex_elm_frontend_scripts() {
		
		
	}
}

// Load required styles and scripts for Elementor Editor mode
if ( !function_exists( 'hoverex_elm_editor_load_scripts' ) ) {
	add_action("elementor/editor/before_enqueue_scripts", 'hoverex_elm_editor_load_scripts');
	function hoverex_elm_editor_load_scripts() {
		// Load font icons
		wp_enqueue_style(  'hoverex-icons', hoverex_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
	}
}

// Add control to select color scheme in the sections and columns
if (!function_exists('hoverex_elm_add_color_scheme_control')) {
	
	function hoverex_elm_add_color_scheme_control($element, $section_id, $args) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			if (apply_filters('hoverex_filter_add_scheme_in_elements', 
							  (in_array($el_name, array('section', 'column')) && $section_id === 'section_advanced')
							  || ($el_name === 'common' && $section_id === '_section_style'),
							  $element, $section_id, $args)) {
				$element->add_control('scheme', array(
						'type' => \Elementor\Controls_Manager::SELECT,
						'label' => esc_html__("Color scheme", 'hoverex'),
						'label_block' => true,
						'options' => hoverex_array_merge(array('' => esc_html__('Inherit', 'hoverex')), hoverex_get_list_schemes()),
						'default' => '',
						'prefix_class' => 'scheme_'
						) );
			}
		}
	}
}

// Move paddings from the .elementor-element-wrap to the .elementor-column-wrap to compatibility with the theme
if ( ! function_exists( 'hoverex_elm_move_paddings_to_column_wrap' ) ) {
	function hoverex_elm_move_paddings_to_column_wrap( $element, $section_id, $args ) {
		if ( is_object( $element ) ) {
			$el_name = $element->get_name();
			if ( 'column' == $el_name && 'section_advanced' == $section_id ) {
				$element->update_responsive_control( 'padding', array(
											'selectors' => array(
												'{{WRAPPER}} > .elementor-element-populated.elementor-column-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',	// Elm 2.9- (or DOM Optimization == Inactive)
												'{{WRAPPER}} > .elementor-element-populated.elementor-widget-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',	// Elm 3.0+
											)
										) );
			}
		}
	}
}

// Add tab with Page Options
if (!function_exists('hoverex_elm_add_page_options')) {
	
	function hoverex_elm_add_page_options($element, $section_id, $args) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			if (false && $el_name == 'page-settings' && $section_id == 'section_page_style') {
				$post_id = get_the_ID();
				$post_type = get_post_type($post_id);
				if ($post_id > 0 && hoverex_allow_override($post_type)) {
					$element->start_controls_section(
						'section_theme_options',
						[
							'label' => esc_html__('Theme Options', 'hoverex'),
							'tab' => \Elementor\Controls_Manager::TAB_LAYOUT 
						]
					);

					// Roadmap: Add current page options to this section in the near future release

					$element->end_controls_section();
				}
			}
		}
	}
}

// Set Elementor's options at once
if (!function_exists('hoverex_elm_init_once')) {
	
	function hoverex_elm_init_once() {
		if (hoverex_exists_elementor() && !get_option('hoverex_setup_elementor_options', false)) {
			// Set theme-specific values to the Elementor's options
			update_option('elementor_disable_color_schemes', 'yes');
			update_option('elementor_disable_typography_schemes', 'yes');
			update_option('elementor_container_width', 1170);
			update_option('elementor_space_between_widgets', 0);
			update_option('elementor_stretched_section_container', '.body_wrap');
			update_option('elementor_page_title_selector', '.elementor-widget-trx_sc_layouts_title,.elementor-widget-trx_sc_layouts_featured');
			// Set flag to prevent change Elementor's options again
			update_option('hoverex_setup_elementor_options', 1);
		}
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (hoverex_exists_elementor()) { require_once HOVEREX_THEME_DIR . 'plugins/elementor/elementor-styles.php'; }
?>