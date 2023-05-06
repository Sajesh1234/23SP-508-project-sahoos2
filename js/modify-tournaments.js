$(document).ready(function(){
	
	var table = $('#table-tournament').DataTable({
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
			url:"modify-tournaments-action.php",
			type:"POST",
			data:{
					action:'listTournaments'
				},
			dataType:"json"
		},
	});	
	
	$("#addTournament").click(function(){
		$('#tournament-form')[0].reset();
		$('#tournament-modal').modal('show'); // Open model (popup) on the browser
		$('.modal-title').html("Add Tournament");
		$('#action').val('addTournament');
		$('#save').val('Add');
	});
	
	$("#tournament-modal").on('submit','#tournament-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		$.ajax({
			url:"modify-tournaments-action.php",
			method:"POST",
			data:{
				// Copy variables from the modal (popup) to send it to the POST
				ID: $('#ID').val(),
				Name: $('#Name').val(),
				Year_of_Tournament: $('#Year').val(),
				Prize: $('#Prize').val(),
				Location: $('#Location').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#tournament-modal').modal('hide');
				$('#tournament-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});		
	
	$("#table-tournament").on('click', '.update', function(){
		var ID = $(this).attr("ID");
		var action = 'getTournament';
		$.ajax({
			url:'modify-tournaments-action.php',
			method:"POST",
			data:{ID:ID, action:action},
			dataType:"json",
			success:function(data){
				// Copy variables from the returned JSON from the SQL query in getUser into the modal (popup)
				$('#tournament-modal').modal('show');
				$('#ID').val(ID);
				$('#Name').val(data.Name);
				$('#Year').val(data.Year_of_Tournament);
				$('#Prize').val(data.Prize);
				$('#Location').val(data.Location);
				$('.modal-title').html("Edit Tournament");
				$('#action').val('updateTournament');
				$('#save').val('Save');
			}
		})
	});
	
	$("#table-tournament").on('click', '.delete', function(){
		var ID = $(this).attr("ID");
		var action = "deleteTournament";
		if (confirm("Are you sure you want to delete this tournament?")) {
			$.ajax({
				url:'modify-tournaments-action.php',
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