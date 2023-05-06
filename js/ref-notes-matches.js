$(document).ready(function(){
	
	var table = $('#table-match').DataTable({
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
			url:"ref-notes-matches-action.php",
			type:"POST",
			data:{
					action:'listMatches'
				},
			dataType:"json"
		},
	});
	$('#table-match tr > *:nth-child(2)').hide();
	
	$("#addMatch").click(function(){
		$('#match-form')[0].reset();
		$('#match-modal').modal('show'); // Open model (popup) on the browser
		$('.modal-title').html("Add Match");
		$('#action').val('addMatch');
		$('#save').val('Add');
	});
	
	$("#match-modal").on('submit','#match-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled', 'disabled');
		// Reenable selects so they get POSTed
		$('#Winner').prop('disabled', false);
		$('#Tournament').prop('disabled', false);
		$('#Ref').prop('disabled', false);
		$.ajax({
			url:"ref-notes-matches-action.php",
			method:"POST",
			data:{
				// Copy variables from the modal (popup) to send it to the POST
				ID: $('#ID').val(),
				Winner: $('#Winner').val(),
				TID: $('#Tournament').val(),
				Ref: $('#Ref').val(),
				Ref_notes: $('#Ref_notes').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#match-modal').modal('hide');
				$('#match-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});		
	
	$("#table-match").on('click', '.update', function(){
		var ID = $(this).attr("ID");
		var action = 'getMatch';
		// Disable the selects so the ref can only modify their notes
		$('#Winner').prop('disabled', true);
		$('#Tournament').prop('disabled', true);
		$('#Ref').prop('disabled', true);
		$.ajax({
			url:'ref-notes-matches-action.php',
			method:"POST",
			data:{ID:ID, action:action},
			dataType:"json",
			success:function(data){
				// Copy variables from the returned JSON from the SQL query in getUser into the modal (popup)
				$('#match-modal').modal('show');
				$('#ID').val(ID);
				$('#Winner').val(data.Winner);
				$('#Tournament').val(data.TID);
				$('#Ref').val(data.Ref);
				$('#Ref_notes').val(data.Ref_notes);
				$('.modal-title').html("Edit Match");
				$('#action').val('updateMatch');
				$('#save').val('Save');
			}
		})
	});
});