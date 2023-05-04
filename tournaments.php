<html>
<head>
<title>TCG Tournaments</title>
<?php require_once('header.php'); ?>

<script src="js/tournaments.js"></script>
</head>

<?php require_once('connection.php'); ?>

<body>

<div class="container-fluid mt-3 mb-3">
	<h4>Search Tournaments</h4>
	<div>
		<table id="table-Tournament" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Year</th>
					<th>Prize Money</th>
					<th>Address</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

</body>
</html>