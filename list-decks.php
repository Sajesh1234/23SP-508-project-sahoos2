<html>
<head>
<title>TCG Cards</title>
<?php require_once('header.php'); ?>

<script src="js/list-decks.js"></script>
</head>
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
.cards{
text-align: center;
color:white;
width: 100%;
display: flex;
flex-direction: column;
}

table { 
background-color: #ff0000; 
}
tr { 
text-align:center;
background-color: #a6a6a6; }

tbody td:nth-child(odd) {
    background-color: #CFBBF7;
}


tbody td:nth-child(even) {
  background-color: #C1A9F2;
}

tbody td {
   text-align: center;
 
}
.box{
     	padding: 10px;
        background:#AAA3B8;
     	
     	}
</style>

<?php require_once('connection.php');
	require_once('player-only.php');
?>

<body>

<div class = "cards">
	<h4>Your Decks</h4>
	<div class ="box">
	<div class="pb-3">
		<button type="button" id="addDeck" class="btn btn-primary btn-sm">Create New Deck</button>
	</div> 
	<div class ="box">
		<table id="table-deck" class="table table-bordered table-striped" style="width:100%">
			<thead>
				<tr>
					<th>Deck</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div id="deck-modal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="deck-form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style ="color:black">Create New Deck</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">						            			
						<label style ="color:black">Name</label><input type="text" class="form-control" id="Name" required>
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