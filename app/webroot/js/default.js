$(function() {
	$('#user-dropdown').on('change', function() {
		$('#CupcakeIndexForm').submit();
	})

	$('#user-dropdown-add').on('change', function() {
		$('#CupcakesAddForm').submit();
	})
	$('#user-dropdown-leave').on('change', function() {
		$('#LeaveIndexForm').submit();
		
	})
	$('#user-dropdown-leave').on('load', function() {
		$('#LeaveIndexForm').submit();
	})

	// $('#user-dropdown-country').on('load', function(){ // when dropdown value gets changed function executes
 	//         	var countryId = $("#user-dropdown-country option:selected").val();
	// 			$("#state").load("<?=Router::url(array('controller' => 'users', 'action' => 'loads'))?>/"+countryId );
	// 		});

	// $('#state').on('load', function(){ // when dropdown value gets changed function executes
 	//     		var stateId = $("#state option:selected").val();
	// 			$("#city").load("<?=Router::url(array('controller' => 'users', 'action' => 'loadc'))?>/"+stateId );
	// 		});
	
})