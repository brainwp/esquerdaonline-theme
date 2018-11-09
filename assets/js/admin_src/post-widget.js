jQuery(document).ready(function($) {
	if ( ! ( $( 'body.wp-customizer' ).length > 0 ) ) {
		return;
	}
	/**
	 *
	 * Ajax load terms
	 *
	*/
	$( document ).on( 'keyup keydown', '.eol-widget-search-link', function( e ){
		var $el = $( this );
		var value = $el.val();
		var data = {
			'action': 'widget_eol_posts_terms_search',
			'key': value,
			'nonce': $el.attr( 'data-nonce' )
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			$el_term_list = $el.parent( 'p' ).find( 'span.term-list' );
			$el_term_list.html( response );
		});
	});

	/**
	 *
	 * Save selected link in the text field
	 *
	*/
	$( document ).on( 'click', 'span.term-list a', function( e ){
		e.preventDefault();
		$el_text_field = $( this ).parent( 'span.term-list').parent( 'p' ).find( '.eol-widget-search-link' );
		$el_text_field.val( $( this ).attr( 'href') );
		$( this ).parent( 'span.term-list' ).html( '' );
	});

});
