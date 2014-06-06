$( document ).ready(function() {

	$('.items').tooltip();
	$('.trophy').tooltip();
	$('.quest_avatar').tooltip();
	$('.timeline_info').tooltip();
	
	
	$('#wysiwyg').summernote({
	  height: 200,                 // set editor height

	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor

	  focus: true,                 // set focus to editable area after initializing summernote
		  toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
	  ]
	});

	
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
	
	$('#myTab a[href="#profile"]').tab('show')
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	
	$(function () {
    $('#myTab a:first').tab('show')
  })
	

});