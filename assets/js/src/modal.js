jQuery(document).ready(function($) {
	$( '.modal-item-open' ).click(function(e) {
    e.preventDefault();
    $( '#modal' ).fadeIn();
    var type = $(this).attr('data-type');
    // console.log(type);
    switch(type) {
        case 'video':
          var url = $(this).attr('data-src');
          var title = $(this).attr('data-title');
          var subtitle = $(this).attr('data-subtitle');
          var date = $(this).attr('data-date');
          var author = $(this).attr('data-author');
          var post_id = jQuery(this).data('id');
        	jQuery.ajax({
        		url : odinAjax.ajax_url,
        		type : 'post',
        		data : {
        			action : 'get_video',
        			url : url
        		},
        		success : function( response ) {
              $('#modal-content').html(response+'<div id="close-modal"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div>')
               $("#modal-content iframe")[0].src += "&autoplay=1";
        		}
        	});
          break;
    //
    //     case image:
    //         var data = ""
    //         break;
        default:
    }

  	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
    $("#modal").on("click", "#close-modal a", function(e) {
      e.preventDefault();
      $( '#modal' ).fadeOut('fast', function() {
        $('#modal-content').html(" ");
      });
    });
	});
});
