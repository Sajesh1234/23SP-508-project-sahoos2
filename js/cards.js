$(document).ready(function(){

	$('#table-Card').DataTable({
		"dom": 'Blfrtip',
		"ordering": false,
		"searching": false,
		"paging": false,
		"responsive": true,
		"ajax":{
			url:"card-action.php",
			type:"POST",
			data:{
					action:'listCards'
				 },
			dataType:"json"
		}
	});
	
});
