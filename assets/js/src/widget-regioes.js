/**
 *
 * Widget de regiões
 *
*/
jQuery(document).ready(function($) {
	$('div.widget-estados select.regioes').change(function(e){
		value = $("select.regioes option:selected" ).attr('value');
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
});
