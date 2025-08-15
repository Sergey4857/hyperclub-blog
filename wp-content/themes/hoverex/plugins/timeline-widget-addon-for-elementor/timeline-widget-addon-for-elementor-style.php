<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'hoverex_timeline_widget_addon_for_elementor_get_css' ) ) {
	add_filter( 'hoverex_filter_get_css', 'hoverex_timeline_widget_addon_for_elementor_get_css', 10, 4 );
	function hoverex_timeline_widget_addon_for_elementor_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

.twae-horizontal .twae-label-extra-label .twae-label,
.twae-vertical .twae-label-extra-label .twae-label,
.twae-wrapper .twae-year,
.twae-wrapper span.twae-title {
	{$fonts['h6_font-family']}
}

.twae-horizontal .twae-label-extra-label .twae-extra-label,
.twae-wrapper .twae-description {
	{$fonts['p_font-family']}
}

CSS;
}

if (isset($css['colors']) && $colors) {
	$css['colors'] .= <<<CSS


/* Timeline */

.twae-vertical .twae-label-extra-label:before {
	background: {$colors['input_bg_color']}!important;
}

.twae-wrapper .twae-label-extra-label span.twae-label,
.twae-wrapper.twae-horizontal span.twae-title,
.twae-wrapper .twae-one-sided-timeline .twae-timeline-entry-inner .twae-title,
.twae-wrapper.twae-centered .twae-timeline-entry-inner .twae-title {
	color: {$colors['text_light']};
}
.twae-wrapper .twae-label-extra-label span.twae-extra-label,
.twae-wrapper.twae-horizontal .twae-description,
.twae-wrapper.twae-vertical .twae-description {
	color: {$colors['text_dark']};
}
.twae-wrapper.twae-horizontal .twae-year,
.twae-wrapper .twae-one-sided-timeline .twae-year-label,
.twae-wrapper .twae-timeline-centered .twae-year-label,
.twae-wrapper.twae-vertical.twae-one-sided-wrapper:before,
.twae-wrapper.twae-vertical:before,
.twae-wrapper .twae-line::before {
	background-color: {$colors['text_link3']};
}
.twae-wrapper.twae-horizontal .twae-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill,
.twae-wrapper.twae-vertical .twae-line::before {
	background: -moz-linear-gradient(0deg, {$colors['text_link3']} 0%, {$colors['text_link2']} 100%); 
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%, rgba(1,123,253,1)), color-stop(100%, {$colors['text_link2']})); 
	background: -webkit-linear-gradient(0deg, {$colors['text_link3']} 0%, {$colors['text_link2']} 100%); 
	background: -o-linear-gradient(0deg, {$colors['text_link3']} 0%, {$colors['text_link2']} 100%); 
	background: -ms-linear-gradient(0deg, {$colors['text_link3']} 0%, {$colors['text_link2']} 100%);
	background: linear-gradient(0deg, {$colors['text_link3']} 0%, {$colors['text_link2']} 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr={$colors['text_link3']}, endColorstr={$colors['text_link2']},GradientType=1 ); 
}
.twae-wrapper.twae-horizontal .twae-pagination.swiper-pagination-progressbar {
	background-color: #143652;
}
.twae-wrapper.twae-horizontal .twae-icon,
.twae-wrapper .twae-one-sided-timeline.twae-one-sided-timeline .twae-timeline-entry .twae-timeline-entry-inner .twae-icon,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner .twae-icon {
	background-color: {$colors['bg_color']};
}
.twae-wrapper.twae-horizontal .twae-icon,
.twae-wrapper .twae-one-sided-timeline.twae-one-sided-timeline .twae-timeline-entry .twae-timeline-entry-inner .twae-icon,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner .twae-icon {
	color: {$colors['text_dark']};
	border-color: {$colors['text_hover']};
}
.twae-wrapper.twae-horizontal .twae-button-prev,
.twae-wrapper.twae-horizontal .twae-button-next {
	color: {$colors['text_dark']};
}
.twae-wrapper .swiper-slide:hover .twae-label-extra-label span.twae-label {
	color: {$colors['text_link']};
}
.twae-wrapper .swiper-slide:hover .twae-icon {
	border-color: {$colors['text_link']};
}
.twae-wrapper.twae-vertical .twae-data-container,
.twae-horizontal .twae-story-info {
	background-color: {$colors['alter_bd_color']};
}
.twae-wrapper .twae-one-sided-timeline.twae-timeline-sm .twae-timeline-entry .twae-timeline-entry-inner .twae-data-container::before,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner .twae-data-container::before,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner .twae-label-extra-label::before {
	background-color: {$colors['alter_bd_hover']};
}
.twae-wrapper .twae-one-sided-timeline.twae-one-sided-timeline .twae-label-extra-label::after,
.twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner .twae-label-extra-label::after,
.twae-wrapper.twae-vertical .twae-data-container.twae-no-border:after {
	border-color: {$colors['extra_bd_hover']};
}
.twae-horizontal .twae-story-info:before {
	border-bottom-color: {$colors['text_dark']};
}
.twae-wrapper .twae-one-sided-timeline.twae-timeline-sm .twae-timeline-entry .twae-timeline-entry-inner:hover .twae-data-container::before,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner:hover .twae-data-container::before,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner:hover .twae-label-extra-label::before {
	background-color: {$colors['text_dark']};
}
.twae-wrapper .twae-one-sided-timeline.twae-timeline-sm .twae-timeline-entry-inner .twae-data-container,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry-inner .twae-data-container,
.twae-horizontal .twae-story-info {
	border-color: {$colors['text_dark']};
}
.twae-wrapper .twae-one-sided-timeline.twae-timeline-sm .twae-timeline-entry-inner .twae-data-container:after,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry-inner .twae-data-container:after {
	border-color: transparent {$colors['text_dark']};
}
.twae-wrapper.twae-one-sided-wrapper .twae-timeline-entry-inner:hover .twae-label-extra-label span.twae-label,
.twae-wrapper.twae-one-sided-wrapper .twae-timeline-entry-inner:hover .twae-label-extra-label span.twae-extra-label,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry-inner:hover .twae-label-extra-label span.twae-extra-label,
.twae-wrapper .twae-one-sided-timeline.twae-timeline-sm .twae-timeline-entry-inner:hover .twae-data-container .twae-title,
.twae-wrapper .twae-one-sided-timeline.twae-timeline-sm .twae-timeline-entry-inner:hover .twae-data-container .twae-description,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry-inner:hover .twae-data-container .twae-description {
	color: {$colors['inverse_link']};
}
.twae-wrapper .twae-one-sided-timeline.twae-one-sided-timeline .twae-timeline-entry .twae-timeline-entry-inner:hover .twae-icon,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry .twae-timeline-entry-inner:hover .twae-icon {
	border-color: {$colors['text_link3']};
}

.twae-wrapper .twae-one-sided-timeline.twae-one-sided-timeline .twae-timeline-entry-inner:hover .twae-label-extra-label::after,
.twae-wrapper .twae-timeline-centered .twae-timeline-entry-inner:hover .twae-label-extra-label::after {
	border-color: transparent {$colors['text_dark']};
}
/* Version 1.4 */
.twae-wrapper{
	--tw-line-bg: {$colors['text_link2']};
	--tw-lbl-big-color: {$colors['text']};
	--tw-lbl-small-color: {$colors['text_dark']};
	--tw-cbx-des-color: {$colors['text_dark']};
}
.twae-vertical.twae-wrapper .twae-labels:before{
	background-color: {$colors['input_bg_color']};
}


CSS;
		}

		return $css;
	}
}
