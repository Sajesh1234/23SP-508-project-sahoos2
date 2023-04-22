$(document).ready(function(){
	
	$('#table-Team').DataTable({
		"dom": 'Blfrtip',
		"ordering": false,
		"searching": false,
		"paging": false,
		"responsive": true,
		"ajax":{
			url:"team-action.php",
			type:"POST",
			data:{
					action:'listTeams'
				 },
			dataType:"json"
		}
	});
	
});
