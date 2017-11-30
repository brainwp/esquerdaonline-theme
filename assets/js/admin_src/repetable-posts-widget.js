jQuery(document).ready(function($) {
	/**
	 *
	 * Inicia o jquery.ui.sortable
	 *
	*/
	if ( $( 'body.wp-customizer' ).length > 0 || $( 'body.widgets-php' ).length > 0 ) {
		var init_sortable_each = function() {
			$( '.form-container .posts' ).each( function(){
				$( this ).sortable();
			});
		}
		$( document ).on( 'click', function(){
			init_sortable_each();
		});
	}
	/**
	 *
	 * Força um update num campo escondido quando uma re-ordenação é feita via jquery.ui
	 *
	*/
	$( document ).on( 'sortstop', '.form-container .posts', function( event, ui ) {
		$( this ).parent( '.form-container' ).find( '.force-change' ).val( Math.random() ).trigger( 'change' );
	});
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
	$( document ).on( 'keyup', '.widget-content .post-search', function( e ){
		var $elem = $( this );
		var $container = $elem.parent( 'p' ).children( '.posts-search-list' );
		var html = '';
		$container.html( 'Buscando posts...' );
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
		$elem.parent( 'span' ).html( '' );
	});
	/**
	 *
	 * Abre o box de post para edição dos campos
	 *
	*/
	$( document ).on( 'click', '.each-repeater', function( e ){
		if ( $( e.target ).is( 'a' ) ) {
			return;
		}
		if ( ! $( this ).hasClass( 'open' ) ) {
			$( this ).addClass( 'open' );
		}
	});
	$( document ).on( 'click', '.each-repeater .close-row', function( e ){
		e.preventDefault();
		$( this ).parent( 'p' ).parent( '.each-repeater' ).removeClass( 'open' );
	});
	/**
	 *
	 * Remove um determinado box de post conforme click no botão "Remover post"
	 *
	*/
	$( document ).on( 'click', '.each-repeater .remove-row', function( e ){
		e.preventDefault();
		$( this ).parent( 'p' ).parent( '.each-repeater' ).fadeOut( 2000 ).remove();
		$( '.widget.open .form-container .force-change' ).val( Math.random() ).trigger( 'change' );
	});

});
