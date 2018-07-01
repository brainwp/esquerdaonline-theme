jQuery(document).ready(function($) {
  if ( $( '#faixa-hidden-text').text().length > 0 ){
    console.log('teste');
    var text = $( '#faixa-hidden-text').text();
      $('#live-link').append(text);
      $('.faixa-topo').css('display','block');

  }
  $( '#fechar-topo' ).click(function(e) {
		e.preventDefault();
			$( '.faixa-topo' ).fadeOut();

	});
	$( ' .faixa-topo a ' ).click(function() {
			$( '.faixa-topo' ).fadeOut();
	});
});
