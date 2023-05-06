$(document).ready(function(){
	
	var table = $('#table-card').DataTable({
		"dom": 'Blfrtip',
		"autoWidth": false,
		"processing":true,
		"serverSide":true,
		"pageLength":-1,
		"lengthMenu": [[-1, 15, 25, 50, 100], ["All", 15, 25, 50, 100]], // Number of rows to show on the table
		"responsive": true,
		"language": {processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>'}, // Loading icon while data is read from the database
		"order":[],
		"ajax":{
			url:"modify-cards-action.php",
			type:"POST",
			data:{
					action:'listCards'
				},
			dataType:"json"
		},
	});	
	
	$("#addCard").click(function(){
		$('#card-form')[0].reset();
		$('#card-modal').modal('show'); // Open model (popup) on the browser
		$('.modal-title').html("Add Card");
		$('#action').val('addCard');
		$('#save').val('Add');
	});
	
	$("#card-modal").on('submit','#card-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		$.ajax({
			url:"modify-cards-action.php",
			method:"POST",
			data:{
				// Copy variables from the modal (popup) to send it to the POST
				ID: $('#ID').val(),
				Name: $('#Name').val(),
				Rarity: $('#Rarity').val(),
				Card_Text: $('#Card_Text').val(),
				Expansion: $('#Expansion').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#card-modal').modal('hide');
				$('#card-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});		
	
	$("#table-card").on('click', '.update', function(){
		var ID = $(this).attr("ID");
		var action = 'getCard';
		$.ajax({
			url:'modify-cards-action.php',
			method:"POST",
			data:{ID:ID, action:action},
			dataType:"json",
			success:function(data){
				// Copy variables from the returned JSON from the SQL query in getUser into the modal (popup)
				$('#card-modal').modal('show');
				$('#ID').val(ID);
				$('#Name').val(data.Name);
				$('#Rarity').val(data.Rarity);
				$('#Card_Text').val(data.Card_Text);
				$('#Expansion').val(data.Expansion);
				$('.modal-title').html("Edit Card");
				$('#action').val('updateCard');
				$('#save').val('Save');
			}
		})
	});
	
	$("#table-card").on('click', '.delete', function(){
		var ID = $(this).attr("ID");
		var action = "deleteCard";
		if(confirm("Are you sure you want to delete this card?")) {
			$.ajax({
				url:'modify-cards-action.php',
				method:"POST",
				data:{ID:ID, action:action},
				success:function() {					
					table.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});