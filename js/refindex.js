$(document).ready(function(){
	
	$("#save").click(function (event) {
		$.ajax({
			url:"refindex-action.php",
			method:"POST",
			data:{
				// Copy variables from the form to send it to the POST
				firstname: $('#firstname').val(),
				lastname: $('#lastname').val(),
				action: "update",
			}
		})
	});
});