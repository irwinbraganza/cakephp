$(function(){
	$('#notify-step-one').click(function() {
		$('#notify-step-one').hide();
		$('#notify-step-two') .fadeIn(300);
		$('#close-notify').show();
	});

	$('#notify-step-one').hover(
		function() {
			$(this).addClass('abc'); 
		},
		function() {
			$(this).removeClass('abc');
		}
	);

	$('#close-notify').click(function() {
		$('#notify-step-two').fadeOut(350);
		setTimeout(function(){
			$('#notify-step-one').show();
			$('#close-notify').hide();
		}, 300)
	});


	$('#UsersAdminForm').on('submit', function(e) {
		e.preventDefault();
		var postData = $(this).serialize();
		var postUrl = $(this).attr('action');
		$.post(postUrl, postData, function(data){
			if (data.s) {
				$('#notify').html(data.html);
				// $('#notify').fadeOut(5000, function(){
				// 	  $('#cupcake').text('Waiting for approval on cupcakes bought today!');
				// });
				}

				else {
					$('#chb').html(data.html);
				}

		}, 'json');
	});

	$('#UserCount').on('input', function(e) {
		this.value = this.value.replace(/[^0-9]/g, '');
	});


	// $("#CupcakeCount").keydown(function(event) {
 //    	if ( event.keyCode == 46 || event.keyCode == 8 ) {
 //    	}
 //    	else {
 //    		if (event.keyCode < 48 || event.keyCode > 57) {
 //    			event.preventDefault();	
 //    		}	
 //    	}
 //    });
})
