<html>
<head>
<title>TCG Admin - Matches</title>
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

<script src="js/modify-matches.js"></script>

<!-- CSS for datatables buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"/>
</head>

<?php require_once('connection.php'); global $conn; ?>

<body>

<div class="container-fluid mt-3 mb-3">
	<h4>Match Information</h4>
	
	<div class="pb-3">
		<button type="button" id="addMatch" class="btn btn-primary btn-sm">Add Match Info</button>
	</div> 
        	
	<div>
		<table id="table-match" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Winner</th>
					<th>TID</th>
					<th>Tournament</th>
					<th>Ref</th>
					<th>Ref Notes</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div id="match-modal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="match-form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Match</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">						            			
						<label>Winner</label>
						<select class="form-control" id="Winner">
            			    <?php
            			        $sqlQuery = 'SELECT Email_Address FROM Users WHERE type = "Player" ORDER BY Email_Address ASC';
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["Email_Address"] . "\">" . $row["Email_Address"] . "</option>";
            			        }
                            ?>
            			</select>
										            			
						<label>Tournament</label>
						<select class="form-control" id="Tournament">
            			    <?php
            			        $sqlQuery = 'SELECT ID, Name FROM Tournament ORDER BY Name ASC';
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["ID"] . "\">" . $row["Name"] . "</option>";
            			        }
                            ?>
            			</select>	
						
						<label>Referee</label>
						<select class="form-control" id="Ref">
            			    <?php
            			        $sqlQuery = 'SELECT Email_Address FROM Users WHERE type = "Ref" ORDER BY Email_Address ASC';
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["Email_Address"] . "\">" . $row["Email_Address"] . "</option>";
            			        }
                            ?>
            			</select>
						
						<label>Ref Notes</label> <input type="text" class="form-control" id="Ref_notes" required>
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