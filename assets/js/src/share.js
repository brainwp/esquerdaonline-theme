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
	 * Share on whatsapp
	 *
	*/
	var eol_whatsapp_share = function( url ) {
		window.open( 'whatsapp://send?text=' + url );
	}

	/**
	 *
	 * Share on telegram
	 *
	*/
	var eol_telegram_share = function( url ) {
		window.open( 'https://telegram.me/share/url?url=' + url );
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
	$( 'body.single article .entry-header' ).on( 'click', 'i', function( e ){
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
		if ( $( this ).hasClass( 'fa-whatsapp' ) ) {
			eol_whatsapp_share( url );
			return;
		}
		if ( $( this ).hasClass( 'fa-telegram' ) ) {
			eol_telegram_share( url );
			return;
		}

		if ( $( this ).hasClass( 'fa-print' ) ) {
			eol_print_share();
			return;
		}
	});
	/**
	 *
	 * Share posts on hover
	 *
	*/
	$( document ).on( 'click', 'figure i', function( e ){
		e.preventDefault();
		var url = $( this ).parent().parent().parent().parent().find( '.show-social-icons' ).attr( 'href' );
		if ( ! url ) {
			var url = $( this ).parent().parent().parent().parent().find( '.post-thumbnail-link' ).attr( 'href' );
		}
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
		if ( $( this ).hasClass( 'fa-whatsapp' ) ) {
			eol_whatsapp_share( url );
			return;
		}
		if ( $( this ).hasClass( 'fa-telegram' ) ) {
			eol_telegram_share( url );
			return;
		}

		if ( $( this ).hasClass( 'fa-print' ) ) {
			eol_print_share();
			return;
		}

	});
});
