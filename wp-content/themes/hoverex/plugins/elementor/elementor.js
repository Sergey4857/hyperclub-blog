/* global jQuery:false */

jQuery(document).ready(function() {
	"use strict";

	var trx_addons_once_resize = false;
	
	if (typeof window.elementorFrontend != 'undefined') {

		// Init hooks after the 1ms, because elementorFrontend.hooks isn't available on 'ready' event
		setTimeout(function(){
			if (typeof elementorFrontend.hooks != 'undefined') {

				// If Elementor is in the Editor's Preview mode
				if (elementorFrontend.isEditMode()) {
					// Init elements after creation
					elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $cont ) {
						// Add TOC in the side menu
						hoverex_add_toc_to_sidemenu();
					} );
				}

			}
		}, typeof elementorFrontend.hooks == 'undefined' ? 1 : 0);
	}

});