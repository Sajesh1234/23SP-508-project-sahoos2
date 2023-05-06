$(document).ready(function(){

	$('#table-deck').DataTable({
		"dom": 'Blfrtip',
		"ordering": false,
		"searching": false,
		"paging": false,
		"responsive": true,
		"ajax":{
			url:"list-decks-action.php",
			type:"POST",
			data:{
					action:'listDecks'
				 },
			dataType:"json"
		}
	});
	
});
