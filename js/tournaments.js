$(document).ready(function(){

	$('#table-Tournament').DataTable({
		"dom": 'Blfrtip',
		"ordering": false,
		"searching": false,
		"paging": false,
		"responsive": true,
		"ajax":{
			url:"tournament-action.php",
			type:"POST",
			data:{
					action:'listTournaments'
				 },
			dataType:"json"
		}
	});
	
});
