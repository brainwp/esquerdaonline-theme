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
		if ( ! $( '#header' ).hasClass( 'open' ) ) {
			$( '#header .container .menu-line-1 nav' ).css( 'display', 'block' );
			$( '#header .container .menu-line-1 .social-icons' ).css( 'display', 'block' );
			$( '#header .container .menu-line-3 nav' ).css( 'display', 'block' );
			
			$( '#header .container' ).addClass( 'open' );
			$( '#header' ).addClass( 'open' );
		} else {
			$( '#header .container' ).removeClass( 'open' );
			$( '#header' ).removeClass( 'open' );
			setTimeout( function(){
				$( '#header .container .menu-line-1 nav' ).css( 'display', 'none');
				$( '#header .container .menu-line-1 .social-icons' ).css( 'display', 'none');
				$( '#header .container .menu-line-3 nav' ).css( 'display', 'none' );
			}, 1000 );
		}
	});


});
