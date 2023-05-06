$(document).ready(function(){
	
	var table = $('#table-loc').DataTable({
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
			url:"modify-locations-action.php",
			type:"POST",
			data:{
					action:'listLocations'
				},
			dataType:"json"
		},
	});	
	
	$("#addLocation").click(function(){
		$('#loc-form')[0].reset();
		$('#loc-modal').modal('show'); // Open model (popup) on the browser
		$('.modal-title').html("Add Location");
		$('#action').val('addLocation');
		$('#save').val('Add');
	});
	
	$("#loc-modal").on('submit','#loc-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		$.ajax({
			url:"modify-locations-action.php",
			method:"POST",
			data:{
				// Copy variables from the modal (popup) to send it to the POST
				Address: $('#Address').val(),
				Name: $('#Name').val(),
				Max_Capacity: $('#Max_Capacity').val(),
				Number_of_Tables: $('#Tables').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#loc-modal').modal('hide');
				$('#loc-form')[0].reset();
				$('#save').attr('disabled', false);
				table.ajax.reload();
			}
		})
	});		
	
	$("#table-loc").on('click', '.update', function(){
		var Address = $(this).attr("Address");
		var action = 'getLocation';
		$.ajax({
			url:'modify-locations-action.php',
			method:"POST",
			data: {Address:Address, action:action},
			dataType:"json",
			success:function(data){
				// Copy variables from the returned JSON from the SQL query in getUser into the modal (popup)
				$('#loc-modal').modal('show');
				$('#Address').val(Address);
				$('#Name').val(data.Name);
				$('#Max_Capacity').val(data.Max_Capacity);
				$('#Tables').val(data.Number_of_Tables);
				$('.modal-title').html("Edit Location");
				$('#action').val('updateLocation');
				$('#save').val('Save');
			}
		})
	});
	
	$("#table-loc").on('click', '.delete', function(){
		var Address = $(this).attr("Address");
		var action = "deleteLocation";
		if(confirm("Are you sure you want to delete this location?")) {
			$.ajax({
				url:'modify-locations-action.php',
				method:"POST",
				data: {Address:Address, action:action},
				success:function() {					
					table.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});