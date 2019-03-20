/**
 *
 * Share posts in social networks
 *
*/
jQuery(document).ready(function($) {
	console.log( 'qqq1' );
	// checa se existe elemento com a classe .carrossel
	if ( ! $( 'body' ).hasClass( 'home' ) && ! $( 'body ').hasClass( 'page-template-page-sidebar-home' ) ) {
		console.log( 'errr' );
		return;
	}
	var eol_colunistas_slider = function(){
		if ( $( window ).width() >= 900 ) {
			console.log( 'qqq3' );
			$( '.widget-colunistas' ).each( function(){
				$( this ).find( '.widget-colunistas' ).slick({
					infinite: true,
					slidesToShow: 5,
					slidesToScroll: 1
				});
			});
		} else {
			$( '.widget-colunistas' ).each( function(){
				console.log( 'qq44' );
				$( this ).find( '.widget-colunistas' ).slick({
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 1
				});
			});
		}
	}
	eol_colunistas_slider();
	$( window ).resize( function(){
		eol_colunistas_slider();
	});
});
