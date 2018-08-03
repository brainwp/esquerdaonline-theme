/**
 *
 * Display/hide header search form
 *
*/
jQuery(document).ready(function($) {
	$( document ).on( 'click', '.search-icon', function( e ){
		console.log( $( this ).attr( 'data-open' ) );
		if ( 'false' == $( this ).attr( 'data-open') ) {
			$( 'nav.menu-editorias > ul' ).fadeOut( 'slow', function(){
				$( '.search-container' ).fadeIn( 'slow' );
			});
			$( this ).attr( 'data-open', 'true' );
			$( '.close-search-icon' ).addClass( 'open' );
		} else {
			$( '#searchform' ).submit();
		}
	});
	$( document ).on( 'click', '.close-search-icon', function( e ) {
		$( '.search-container' ).fadeOut( 'slow', function(){
			$( '.close-search-icon' ).removeClass( 'open' );
			$( 'nav.menu-editorias > ul' ).fadeIn( 'slow' );
		});
		$( '.search-icon' ).attr( 'data-open', 'false' );
	});
});
