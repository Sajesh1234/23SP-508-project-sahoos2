$(document).ready(function(){
	
	$('#table-Team').DataTable({
		"dom": 'Blfrtip',
		"ordering": false,
		"searching": false,
		"paging": false,
		"responsive": true,
		"ajax":{
			url:"tournament-teams-action.php",
			type:"POST",
			data: {
					ID: #('tourneyid').attr('tid'),
					action:'listTeams'
				 },
			dataType:"json"
		}
	});
	
});
