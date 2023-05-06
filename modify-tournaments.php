<html>
<head>
<title>TCG Admin - Tournaments</title>
<?php require_once('header.php'); ?>

<!-- Font Awesome library -->
<script src="https://kit.fontawesome.com/aec5ef1467.js"></script>

<!-- JS libraries for datatables buttons-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script src="js/modify-tournaments.js"></script>

<!-- CSS for datatables buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"/>
</head>

<?php require_once('connection.php'); global $conn; ?>

<body>

<div class="container-fluid mt-3 mb-3">
	<h4>Tournaments</h4>
	
	<div class="pb-3">
		<button type="button" id="addTournament" class="btn btn-primary btn-sm">Add New Tournament</button>
	</div> 
        	
	<div>
		<table id="table-tournament" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Year</th>
					<th>Prize</th>
					<th>Location</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div id="tournament-modal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="tournament-form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Tournament</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">						            			
						<label>Name</label><input type="text" class="form-control" id="Name" required>

						<label>Year</label><input type="number" class="form-control" id="Year" required>
						
						<label>Prize</label> <input type="number" class="form-control" id="Prize" required>
						
            			<label>Location</label>
						<select class="form-control" id="Location">
            			    <?php
            			        $sqlQuery = "SELECT Name FROM Tournament_Location ORDER BY Name ASC";
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["Name"] . "\">" . $row["Name"] . "</option>";
            			        }
                            ?>
            			</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="ID" id="ID"/>
					<input type="hidden" name="action" id="action" value=""/>
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

</body>
</html>