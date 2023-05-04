$(document).ready(function(){
	
	var userTable = $('#table-user').DataTable({
		"dom": 'Blfrtip',
		"autoWidth": false,
		"processing":true,
		"serverSide":true,
		"pageLength":15,
		"lengthMenu":[[15, 25, 50, 100, -1], [15, 25, 50, 100, "All"]], // Number of rows to show on the table
		"responsive": true,
		"language": {processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>'}, // Loading icon while data is read from the database
		"order":[],
		"ajax":{
			url:"modify-users-action.php",
			type:"POST",
			data:{
					action:'listUsers'
				},
			dataType:"json"
		},
		"buttons": [
				{
					extend: 'excelHtml5',
					title: 'TCG Users',
					filename: 'TCG Users',
					exportOptions: {columns: [1,2,3,4,5,6]}
				},
				{
					extend: 'pdfHtml5',
					title: 'TCG Users',
					filename: 'TCG Users',
					exportOptions: {columns: [1,2,3,4,5,6]}
				},
				{
					extend: 'print',
					title: 'Employees',
					filename: 'Employees',
					exportOptions: {columns: [1,2,3,4,5,6]}
				}]
	});	
	
	$("#addUser").click(function(){
		$('#user-form')[0].reset();
		$('#user-modal').modal('show'); // Open model (popup) on the browser
		$('.modal-title').html("Add User");
		$('#action').val('addUser');
		$('#save').val('Add');
	});
	
	$("#user-modal").on('submit','#user-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		$.ajax({
			url:"modify-users-action.php",
			method:"POST",
			data:{
				// Copy variables from the modal (popup) to send it to the POST
				Email_Address: $('#email').val(),
				firstname: $('#firstname').val(),
				lastname: $('#lastname').val(),
				date_of_birth: $('#dob').val(),
				type: $('#acc').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#user-modal').modal('hide');
				$('#user-form')[0].reset();
				$('#save').attr('disabled', false);
				userTable.ajax.reload();
			}
		})
	});		
	
	$("#table-user").on('click', '.update', function(){
		var ID = $(this).attr("Email_Address");
		var action = 'getUser';
		$.ajax({
			url:'modify-users-action.php',
			method:"POST",
			data:{ID:ID, action:action},
			dataType:"json",
			success:function(data){
				// Copy variables from the returned JSON from the SQL query in getUser into the modal (popup)
				$('#user-modal').modal('show');
				$('#Email_Address').val(Email_Address);
				$('#firstname').val(data.first_name);
				$('#lastname').val(data.last_name);
				$('#dob').val(data.dob);
				$('#type').val(data.acc);
				$('.modal-title').html("Edit User");
				$('#action').val('updateUser');
				$('#save').val('Save');
			}
		})
	});
	
	$("#table-user").on('click', '.delete', function(){
		var ID = $(this).attr("Email_Address");
		var action = "deleteUser";
		if(confirm("Are you sure you want to delete this user?")) {
			$.ajax({
				url:'modify-user-action.php',
				method:"POST",
				data:{ID:ID, action:action},
				success:function() {					
					userTable.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});