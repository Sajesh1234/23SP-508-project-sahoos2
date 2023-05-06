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
			url:"edit-deck-action.php",
			type:"POST",
			data: {
					action:'listCards'
				},
			dataType:"json"
		},
	});

	$("#table-card").on('click', '.delete', function () {
		var ID = $(this).attr("ID");
		var action = "deleteCard";
		$.ajax({
			url: 'edit-deck-action.php',
			method: "POST",
			data: { ID: ID, action: action },
			success: function () {
				table.ajax.reload();
			}
		})
	});

	$("#table-card").on('click', '.add', function () {
		var ID = $(this).attr("ID");
		var action = "addCard";
		$.ajax({
			url: 'edit-deck-action.php',
			method: "POST",
			data: { ID: ID, action: action },
			success: function () {
				table.ajax.reload();
			}
		})
	});
});