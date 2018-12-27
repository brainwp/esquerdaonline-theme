jQuery(document).ready(function($) {
	$( window ).load( function() {
		$( '.each-post-widget img' ).each(function() {
			var $el = $( this );
			//console.log( $( this ).attr( 'src' ) + ' : ' + $( this ).width() );
			if ( ! ( parseInt( $el.width() ) > 150 ) ) {
				$el.parent().parent().parent().parent().parent().addClass( 'foto-pequena' );
				console.log( parseInt( $el.width() ) );
				console.log( 'qqw22ww');
			}
		});
	});
});
