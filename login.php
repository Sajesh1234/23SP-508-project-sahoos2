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

Cr_acc{
position:absolute;
top:100px;
right:150px;
}

</style>

<body>

	<div class="container">
		<form method="post">
			<div class="row justify-content-center">
				<div class="col-4">
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
					&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
					
					<a href="signup.php" class="Cr_acc">Create an Account</a>
				</div>
			</div>
		</form>
	</div>

</body>
</html>