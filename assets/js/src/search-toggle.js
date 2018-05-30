/**
 *
 * Display/hide header search form
 *
*/
jQuery(document).ready(function($) {
// Widget de regiões
	$('div.widget-estados select.regioes').change(function(e){
		value = $("select.regioes option:selected" ).attr('value');
		console.log(value)
		if (value != 0) {
			$('div.widget-estados select.estados option').addClass('hide');
			$('div.widget-estados select.estados option.estado.' + value+ '').removeClass('hide');
		}
		else{
			$('div.widget-estados select.estados option').removeClass('hide');

		}
		$('div.tabbed ul.tabs li a').removeClass('tab-current');
		$(this).addClass('tab-current');
	});
	$('div.widget-estados select.estados').change(function(e){
		value = $("select.estados option:selected" ).attr('value');
		window.location.href = value;
	});

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
