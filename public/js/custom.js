$( document ).ready(function() {

	$('.items').tooltip();
	$('.trophy').tooltip();
	$('.quest_avatar').tooltip();


	$(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
	
	
	$('#frm').bind('submit', function(e) {
	   $('#send').attr('disabled', 'disabled');
	});


});