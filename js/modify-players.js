$(document).ready(function(){
	
	var table = $('#table-player').DataTable({
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
			url:"modify-players-action.php",
			type:"POST",
			data:{
					action:'listPlayers'
				},
			dataType:"json"
		},
	});	
	
	$("#addPlayer").click(function(){
		$('#player-form')[0].reset();
		$('#player-modal').modal('show'); // Open model (popup) on the browser
		$('.modal-title').html("Add Player");
		$('#action').val('addPlayer');
		$('#save').val('Add');
	});
	
	$("#player-modal").on('submit','#player-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		$.ajax({
			url:"modify-players-action.php",
			method:"POST",
			data:{
				// Copy variables from the modal (popup) to send it to the POST
				email: $('#email').val(),
				Wins: $('#Wins').val(),
				Draws: $('#Draws').val(),
				Losses: $('#Losses').val(),
				Team: $('#Team').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#player-modal').modal('hide');
				$('#player-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});		
	
	$("#table-player").on('click', '.update', function(){
		var email = $(this).attr("Email_Address");
		var action = 'getPlayer';
		$.ajax({
			url:'modify-players-action.php',
			method:"POST",
			data:{email:email, action:action},
			dataType:"json",
			success:function(data){
				// Copy variables from the returned JSON from the SQL query in getUser into the modal (popup)
				$('#player-modal').modal('show');
				$('#email').val(email);
				$('#Wins').val(data.Wins);
				$('#Draws').val(data.Draws);
				$('#Losses').val(data.Losses);
				$('#Team').val(data.Team);
				$('.modal-title').html("Edit Player");
				$('#action').val('updatePlayer');
				$('#save').val('Save');
			}
		})
	});
	
	$("#table-player").on('click', '.delete', function(){
		var email = $(this).attr("Email_Address");
		var action = "deletePlayer";
		if(confirm("Are you sure you want to delete this player's information?")) {
			$.ajax({
				url:'modify-player-action.php',
				method:"POST",
				data:{email:email, action:action},
				success:function() {					
					table.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});