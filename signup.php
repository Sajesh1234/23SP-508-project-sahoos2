<html>
<head>
<title>TCG database Login</title>
<?php require_once('header.php'); ?>
</head>

<?php require_once('connection.php'); ?>
<style>
body{
background-color: black;
color: white;
padding-top: 200px;
}
</style>

<body>

	<div class="container-fluid">
		<form method="post">
			<div class="row justify-content-center">
				<div class="col-4">
					<div class="form-group">
					<label for="fname">First Name:</label>
						<input type="text" id="fname" name="fname" class ="form-control" id="name" placeholder = "First Name" name="fname" required>
					</div>
					<div class="form-group">
					<label for="lname">Last name:</label><br>
						<input type="text" id="lname" name="lname" class ="form-control" id="name" placeholder = "First Name" name="lname" required>
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
					</div>
					<br/>
					<button type="submit" class="btn btn-primary">Log in</button>
					<br/>
				</div>
			</div>
		</form>
	</div>

</body>
</html>