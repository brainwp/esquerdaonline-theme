jQuery(document).ready(function($) {
	$( window ).load( function() {
		$( '.each-post-widget img' ).each(function() {
			var $el = $( this );
			//console.log( $( this ).attr( 'src' ) + ' : ' + $( this ).width() );
			if ( ! ( parseInt( $el.width() ) > 200 ) ) {
				$el.parent().parent().parent().parent().parent().addClass( 'foto-pequena' );
			}
		});
	});
});
