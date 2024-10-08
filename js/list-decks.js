$(document).ready(function(){

	var table = $('#table-deck').DataTable({
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
		$('.modal-title').html("Create New Deck");
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
				Name: $('#Name').val(),
				action: $('#action').val(),
			},
			success: function () {
				$('#deck-modal').modal('hide');
				$('#deck-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});

	$("#table-deck").on('click', '.delete', function () {
		var Name = $(this).attr("Deck");
		var action = "deleteDeck";
		if (confirm("Are you sure you want to delete this deck?")) {
			$.ajax({
				url: 'list-decks-action.php',
				method: "POST",
				data: { Name: Name, action: action },
				success: function () {
					table.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});
