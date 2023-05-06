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

	$("#addDeck").click(function () {
		$('#deck-form')[0].reset();
		$('#deck-modal').modal('show'); // Open model (popup) on the browser
		$('#action').val('addDeck');
		$('#save').val('Add');
	});



	$("#deck-modal").on('submit', '#deck-form', function (event) {
		event.preventDefault();
		$('#save').attr('disabled', 'disabled');
		$.ajax({
			url: "list-decks-action.php",
			method: "POST",
			data: {
				// Copy variables from the modal (popup) to send it to the POST
				ID: $('#ID').val(),
				Name: $('#Name').val(),
				action: $('#action').val(),
			},
			success: function () {
				$('#card-modal').modal('hide');
				$('#card-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});
});
