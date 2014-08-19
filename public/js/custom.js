$( document ).ready(function() {

	$('.items').tooltip();
	$('.trophy').tooltip();
	$('.quest_avatar').tooltip();
	$('.timeline_info').tooltip();
	
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

	$('form').submit(function(){
		// On submit disable its submit button
		$('input[type=submit]', this).attr('disabled', 'disabled');
	});
	
	$('#frm').bind('submit', function(e) {
	   $('#send').attr('disabled', 'disabled');
	});
	
	$('#frm').bind('submit', function(e) {
	   $('.inactive_at_click').attr('disabled', 'disabled');
	});
	
	
	$('#myTab a[href="#profile"]').tab('show')
	$('#myTab a').click(function (e) {
	  //e.preventDefault();
	  $(this).tab('show');
	  return false;
	})
	
	$(function () {
		$('#myTab a:first').tab('show');
	})
	
	$(".toggle_game_details").click(function() {
		//event.preventDefault();
		$(this).closest(".game_detail_toggle").toggle("fast");
		return false;
	});

	$('.toggle_game_details').click( function() {
        $('.game_details-' + $(this).attr('id')).toggle();
		return false;
    });
	
	$('.delete_all_notes a').click(function(){
		return confirm("Delete all Notifications?");
	})
	
	$('.cancel_challenge a').click(function(){
		return confirm("Cancel this Challenge? You will loose 20 QP and your progress for this challenge!");
	})	
	
	$('.create_team').click(function(){
		return confirm("Creating a team will cost 500 QP. Are you sure?");
	})
	
	$('.delete_team').click(function(){
		return confirm("Are you sure you want to delete this Team?");
	})
	

});