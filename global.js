$(function(){
    $('.btn-like').click(function(e) {
	$.post('/like.php', {
	    userid:$(this).attr('data-userid'),
	    type: $(this).attr('data-type'),
	    objid: $(this).attr('data-id')
	}, function(data) {
	    var btn = $('.btn-like[data-type="' + data.type + '"][data-id="' + data.id + '"]');
	    if (data.result == true) {
		btn.addClass('liked');
		btn.text('liked');
	    } else {
		btn.removeClass('liked');
		btn.text('like');
	    }
	});
    });

    $('.editprofile').on('submit',function(event) {
	event.preventDefault(); // Prevent the form from submitting via the browser.
	var form = $(this);
	$.ajax({
	  type: form.attr('method'),
	  url: form.attr('action'),
	  data: form.serialize()
	}).success(function() {
	    alert('saved');
	  // Optionally alert the user of success here...
	});
      });
});


