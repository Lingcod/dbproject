$(document).ready(function(){
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
});
