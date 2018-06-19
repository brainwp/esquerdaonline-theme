/**
 *
 * Share posts in social networks
 *
*/
jQuery(document).ready(function($) {
	/**
	 *
	 * Share on fb
	 *
	*/
	var eol_fb_share = function( url ) {
		window.open( 'https://www.facebook.com/sharer/sharer.php?u=' + url );
	}
	/**
	 *
	 * Share on google plus
	 *
	*/
	var eol_gplus_share = function( url ) {
		window.open( 'https://plus.google.com/share?url=' + url );
	}

	/**
	 *
	 * Share on twitter
	 *
	*/
	var eol_twitter_share = function( url ) {
		window.open( 'https://twitter.com/intent/tweet?text=' + url );
	}

	/**
	 *
	 * Print page
	 *
	*/
	var eol_print_share = function() {
		window.print();
	}


	/**
	 *
	 * Single
	 *
	*/
	$( 'body.single' ).on( 'click', 'i', function( e ){
		e.preventDefault();
		var url = window.location.href;
		if ( $( this ).hasClass( 'fa-facebook-f' ) ) {
			eol_fb_share( url );
			return;
		}
		if ( $( this ).hasClass( 'fa-twitter' ) ) {
			eol_twitter_share( url );
			return;
		}
		if ( $( this ).hasClass( 'fa-google-plus' ) ) {
			eol_gplus_share( url );
			return;
		}
		if ( $( this ).hasClass( 'fa-print' ) ) {
			eol_print_share();
			return;
		}
	});
});
