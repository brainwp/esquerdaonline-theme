/**
 *
 * Share posts in social networks
 *
*/
jQuery(document).ready(function($) {
	console.log( 'qqq1' );
	// checa se existe elemento com a classe .carrossel
	if ( 0 === $( '.widget-colunistas.carrossel' ).length ) {
		console.log( 'qqq' );
		return;
	}
	var eol_colunistas_slider = function(){
		if ( $( window ).width() >= 900 ) {
			console.log( 'qqq3' );
			$( '.widget-colunistas.carrossel' ).each( function(){
				$( this ).find( '.widget-colunistas' ).slick({
					infinite: true,
					slidesToShow: 5,
					slidesToScroll: 1
				});
			});
		} else {
			$( '.widget-colunistas.carrossel' ).each( function(){
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
