/**
 *
 * Share posts in social networks
 *
*/
jQuery(document).ready(function($) {
	if ( 0 === $( '.each-post-widget.sem-foto' ).length ) {
		return;
	}
	$( '.each-post-widget.sem-foto' ).each( function(){
		$( this ).parent().parent().find( 'h3.widget-title').css( 'position', 'relative' );
	});
	$( '.each-post-widget.foto-meio' ).each( function(){
		$( this ).parent().parent().find( 'h3.widget-title').css( 'position', 'relative' );
	});
	$( '.each-post-widget.foto-cima' ).each( function(){
		$( this ).parent().parent().addClass( 'foto-cima' );
	});
	$( '.each-post-widget.foto-esquerda' ).each( function(){
		$( this ).parent().parent().addClass( 'foto-cima' );
	});
	$( '.each-post-widget.foto-fundo' ).each( function(){
		$( this ).parent().parent().addClass( 'foto-cima' );
	});

});
