/**
 *
 * Display/hide header search form
 *
*/
jQuery(document).ready(function($) {
	// setting the tabs in the sidebar hide and show, setting the current tab
	$('div.tabbed div').hide();
	$('div.t1').show();
	$('div.tabbed ul.tabs li.t1 a').addClass('tab-current');

// SIDEBAR TABS
$('div.tabbed ul li a').click(function(e){
	e.preventDefault();
	var thisClass = this.className.split(" ");
	console.log(thisClass[0]);
	$('div.tabbed div').hide();
	$('div.' + thisClass).show();
	$('div.tabbed ul.tabs li a').removeClass('tab-current');
	$(this).addClass('tab-current');
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
