<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'hoverex_elm_get_css' ) ) {
	add_filter( 'hoverex_filter_get_css', 'hoverex_elm_get_css', 10, 4 );
	function hoverex_elm_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Shape above and below rows */
.elementor-shape .elementor-shape-fill {
	fill: {$colors['bg_color']};
}

/* Divider */
.elementor-divider-separator {
	border-color: {$colors['bd_color']};
}

CSS;
		}
		
		return $css;
	}
}
?>