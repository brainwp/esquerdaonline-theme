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
		} else {
			$( '.search-container' ).fadeOut( 'slow', function(){
				$( 'nav.menu-editorias > ul' ).fadeIn( 'slow' );
			});
			$( this ).attr( 'data-open', 'false' );
		}
	})
});
