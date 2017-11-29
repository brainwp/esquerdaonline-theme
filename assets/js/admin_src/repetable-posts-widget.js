jQuery(document).ready(function($) {
	$( document ).on( 'click', '.widget-content .add-new-row', function( e ){
		e.preventDefault();
		var html = $( $( this ).attr( 'href' ) ).html();
		$( this ).parent( '.form-container' ).children( '.posts' ).append( html );
		console.log( wpApiSettings );
	});
	$( document ).on( 'change', '.widget-content .post-search', function( e ){
		console.log( 'ahoy' );
		var $elem = $( this );
		var $container = $elem.parent( 'p' ).children( '.posts-search-list' );
		var html = '';
		$.ajax( {
			url: wpApiSettings.root + 'wp/v2/posts',
			method: 'GET',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
			},
			data:{
				'search' : $elem.val()
			}
		} ).done( function ( response ) {
			console.log( response );
			response.forEach( function( $item ) {
				console.log( 'arroz!');
				html = html + '<a class="select-post" href="#'+$item.id+'">' + $item.title.rendered + '</a><br>';
			});
			$container.html( html );
		});
	});
	$( document ).on( 'click', '.widget-content .select-post', function( e ) {
		e.preventDefault();
		console.log( 'qqqqee2' );
		var $elem = $( this );
		var $input = $elem.parent( 'span' ).parent( 'p' ).find( '.post-search' );
		var $input_title = $elem.parent( 'span' ).parent( 'p' ).parent( '.each-repeater' ).find( '.post-title' );
		$input.val( $( this ).attr( 'href' ).replace( '#', '' ) );
		if ( '' == $input_title.val() ) {
			$input_title.val( $elem.html() );
		}
	});
});
