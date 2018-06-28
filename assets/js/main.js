jQuery(document).ready(function($) {
	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();
	$( '#menu-open, .fechar-menu' ).click(function(e) {
		e.preventDefault();
		  $( '#header .container' ).toggleClass( 'open' );

	});
	$( '#fechar-topo' ).click(function(e) {
		e.preventDefault();
			$( '.faixa-topo' ).fadeOut();

	});
	$( ' .faixa-topo a ' ).click(function() {
			$( '.faixa-topo' ).fadeOut();
	});

});
