jQuery(document).ready(function($) {
	if ( $( 'body.wp-customizer' ).length > 0 || $( 'body.widgets-php' ).length > 0 ) {
		var init_sortable_each = function() {
			if ( $( '.form-container .posts' ).length > 0 ) {
				$( '.form-container .posts' ).each( function(){
					$( this ).sortable();
				});
			}
		}
		setTimeout(function(){ init_sortable_each(); }, 2000);
	}
	/**
	 *
	 * Botão para adicionar um novo (grupo) de campos
	 *
	*/
	$( document ).on( 'click', '.widget-content .add-new-row', function( e ){
		e.preventDefault();
		var html = $( $( this ).attr( 'href' ) ).html();
		$( this ).parent( '.form-container' ).children( '.posts' ).append( html );
		$( '.form-container .posts' ).each( function(){
			$( this ).sortable();
		});
	});
	/**
	 *
	 * Campo de busca de posts utilizando a REST API
	 *
	*/
	$( document ).on( 'change', '.widget-content .post-search', function( e ){
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
			response.forEach( function( $item ) {
				html = html + '<a class="select-post" href="#'+$item.id+'">' + $item.title.rendered + '</a><br>';
			});
			$container.html( html );
		});
	});
	/**
	 *
	 * Adiciona funcionalidade de seleção de posts abaixo do campo de busca de posts
	 *
	*/
	$( document ).on( 'click', '.widget-content .select-post', function( e ) {
		e.preventDefault();
		var $elem = $( this );
		var $input = $elem.parent( 'span' ).parent( 'p' ).find( '.post-search' );
		var $input_title = $elem.parent( 'span' ).parent( 'p' ).parent( '.each-repeater' ).find( '.post-title' );
		$input.val( $( this ).attr( 'href' ).replace( '#', '' ) );
		$input_title.val( $elem.html() );
	});
});
