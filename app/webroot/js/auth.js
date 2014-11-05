$(function(){
	$('#UserCheckForm').on('submit', function(e) {
		e.preventDefault();
		var postData = $(this).serialize();
		var postUrl = $(this).attr('action');
		$.post(postUrl, postData, function(data){
			if (data.s) {
				$('#chb').html(data.html);
// $('#chb').fadeOut(7000, function() {
// 	location.reload();
// });
		$('#UserCheckForm').find('#UserPin').val('');
	}
}, 'json');
	});


	$('.admin-link').hover(function() {
		$('.admin-link').css("color", "white");
	});
	$('#UserPin').on('input', function(e) {
		this.value = this.value.replace(/[^0-9]/g, '');
	});


	$('#UserChangePinForm').on('submit', function(e) {
		e.preventDefault();
		var postData = $(this).serialize();
		var postUrl = $(this).attr('action');
		$.post(postUrl, postData, function(data){
			if (data.s) {
				$('#chb').html(data.html);
				$('#UserChangePinForm').find('#UserEmail').val('');
			}
		}, 'json');
	});

	$('#UserResetPinForm').on('submit', function(e) {
		e.preventDefault();
		var postData = $(this).serialize();
		var postUrl = $(this).attr('action');
		$.post(postUrl, postData, function(data){
			if (data.s) {
				$('#chb').html(data.html);
			}
		}, 'json');
	});

	// window.onbeforeunload = function() {
	// 	return 'Are you sure you want to exit?';
	// }

	$('.logout-btn').confirmOn('click', function(e, confirmed){
		if(confirmed) {
			window.location.assign("users/logout/");
		}
		else {
		}
	})
})