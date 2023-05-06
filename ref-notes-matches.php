<html>
<head>
<title>Add Ref Notes to Matches</title>
<?php require_once('header.php'); 
	require('ref-only.php');
?>

<!-- Font Awesome library -->
<script src="https://kit.fontawesome.com/aec5ef1467.js"></script>

<!-- JS libraries for datatables buttons-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script src="js/ref-notes-matches.js"></script>

<!-- CSS for datatables buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"/>
</head>

<?php require_once('connection.php'); global $conn; ?>
<style>
body { 
  width: 100%;
  height:100%;
  font-family: 'Open Sans', sans-serif;
  background: #092756;
  background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
  background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
  background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
  background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
  background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
tr { 
background-color: #a6a6a6; }

.box{
     	padding: 10px;
        background:#AAA3B8;
     	
     	}
 tbody td:nth-child(odd) {
    background-color: #CFBBF7;
}


tbody td:nth-child(even) {
  background-color: #CFBBF7;
}
.matches{
  	width: 100%;
    display: flex;
    flex-direction: column;
     	}
</style>

<body>

<div class="matches">
	<h4 style = "text-align:center; color: white;">Match Information</h4>
        	
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
            			        $sqlQuery = 'SELECT Person_ID FROM Ref ORDER BY Person_ID ASC';
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["Person_ID"] . "\">" . $row["Person_ID"] . "</option>";
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