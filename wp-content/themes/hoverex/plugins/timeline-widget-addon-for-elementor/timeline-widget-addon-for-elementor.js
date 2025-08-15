/*
 * Custom js
 */

/* global jQuery:false */

jQuery( document ).ready(
	function() {
		"use strict";
		if (jQuery('.twae-vertical').length) {
		jQuery('.twae-vertical .twae-data-container').each(function(){
			if( (jQuery(this).find('.twae-title').html() == '') && (jQuery(this).find('.twae-description').html() == '') ) {
			jQuery(this).css("opacity", "0");
			}
		});
		jQuery('.twae-vertical .twae-icon').each(function(){
			if( (jQuery(this).html() == '') ) {
			jQuery(this).css("opacity", "0");
			}
		});
		}
		if (jQuery('.twae-horizontal').length) {
			jQuery('.twae-horizontal .twae-story-info').each(function(){
			if( (jQuery(this).find('.twae-title').html() == '') && (jQuery(this).find('.twae-description').html() == '') ) {
			jQuery(this).css("opacity", "0");
			}
			});
		jQuery('.twae-horizontal .twae-icon').each(function(){
			if( (jQuery(this).html() == '') ) {
			jQuery(this).css("opacity", "0");
			}
			});
		}
	}
);
