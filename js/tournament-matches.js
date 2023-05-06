$(document).ready(function(){
	
	$('#table-match').DataTable({
		"dom": 'Blfrtip',
		"ordering": false,
		"searching": false,
		"paging": false,
		"responsive": true,
		"ajax":{
			url:"tournament-matches-action.php",
			type:"POST",
			data: {
					ID: $('#tourneyid').attr('tid'),
					action:'listMatches'
				 },
			dataType:"json"
		}
	});
	
});
