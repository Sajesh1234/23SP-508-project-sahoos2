<html>
<head>
<title>TCG database SignUp</title>
<?php require_once('header.php'); ?>
</head>

<?php require_once('connection.php'); 

// Create new account and redirect to login
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Check that passwords match
	// TODO other checks (email formatting)
	if($_POST['p'] == $_POST['pr']) {
	    
	    if ($_POST['acc']== '') {
	        $error_msg = "Error: Please select a valid user type";
	    }else{
		// Construct INSERT
        $stmt = $conn->prepare("INSERT INTO Users (Email_Address, first_name, last_name, date_of_birth, type, password_hash) VALUES (:email, :first, :last, :dob, :type, :hash)");
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':first', $_POST['firstname']);
        $stmt->bindValue(':last', $_POST['lastname']);
        $stmt->bindValue(':dob', $_POST['dob']);
        $stmt->bindValue(':type', $_POST['acc']);
		// Hash pw
		$hash = password_hash($_POST['p'], PASSWORD_DEFAULT);
        $stmt->bindValue(':hash', $hash);
        $stmt->execute();
	    }
		// Insert into player or ref tables as appropriate
		if ($_POST['acc'] == "Player") {
			$stmt = $conn->prepare("INSERT INTO Player (Person_ID, Wins, Draws, Losses, Play_count, Team) VALUES (:email, 1, 1, 1, 3, NULL)");
			$stmt->bindValue(':email', $_POST['email']);
			$stmt->execute();
		} elseif ($_POST['acc'] == "Ref") {
			$stmt = $conn->prepare("INSERT INTO Ref (Person_ID) VALUES (:email)");
			$stmt->bindValue(':email', $_POST['email']);
			$stmt->execute();

		}
		
		// Start or resume session variables
		session_start();

		// Sign the new acc in 
		$_SESSION['user_ID'] = $_POST['email'];
        $_SESSION['user_type'] = $_POST['acc'];

        // Redirect to appropriate main page 
		if(isset($_SESSION['user_type'])) {
			if($_SESSION['user_type'] == "Admin") {
				header("Location: adminindex");
			}
			elseif($_SESSION['user_type'] == "Ref") {
				header("Location: refindex");
			}
			elseif($_SESSION['user_type'] == "Player") {
				header("Location: playerindex");
			}
			else {
			    $error_msg = "Pick a Player or a Ref";
			}
		}
	}
	else {
		// TODO prettify this lol
	    $error_msg = "Passwords Do Not Match!!!";;
	}
}


?>
<style>

.btn { 
 display: inline-block;
 *display: inline; *zoom: 1;
 padding: 4px 10px 4px; 
 margin-bottom: 10; 
 font-size: 13px; 
 line-height: 18px; 
 color: #333333; 
 text-align: center;
 text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); 
 vertical-align: middle; 
 background-color: #f5f5f5; 
 background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); 
 background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); 
 background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); 
 background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); 
 background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); 
 background-image: linear-gradient(top, #ffffff, #e6e6e6); 
 background-repeat: repeat-x; 
 filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); 
 border-color: #e6e6e6 #e6e6e6 #e6e6e6; 
 border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); 
 border: 1px solid #e6e6e6; 
 -webkit-border-radius: 4px; 
 -moz-border-radius: 4px; 
 border-radius: 4px; 
 -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); 
 -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); 
 box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); 
 cursor: pointer; 
 *margin-left: .3em; 
 }
 
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
.btn-block { width: 100%; display:block; }
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
.Signup { 
  position: center;
  margin: auto;
  width:300px;
  height:300px;
  color: white;
}
.Signup h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

input { 
  width: 100%; 
  margin-bottom: 10px; 
  background: rgba(0,0,0,0.3);
  border: none;
  outline: none;
  padding: 10px;
  font-size: 13px;
  color: #fff;
  text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
  -webkit-transition: box-shadow .5s ease;
  -moz-transition: box-shadow .5s ease;
  -o-transition: box-shadow .5s ease;
  -ms-transition: box-shadow .5s ease;
  transition: box-shadow .5s ease;
}
.error{
    position:center;
    margin:auto;
    width: 100%;
    text-align: center;
}
.box{
     	background:rgba(255, 0, 0, 0.6);
     	width:100%;
     	padding: 25px;
     	color:white;
     	
     	}

input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
 
</style>

<body>

	<div class="Signup">
	<h1>SIGN UP</h1>
		<form method="post">
			<label for="email">Email:</label>
			<input type="text" name="email" placeholder="Email Address" required="required" />
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" placeholder="First Name" required="required" />
			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" placeholder="Last Name" required="required" />
			<label for="DateofBirth">Date of Birth:</label>
			<input type="date" id = "DateofBirth" name="dob" required="required" />
			<label for="p">Password:</label>
			<input type="password" name="p" placeholder="Password" required="required" />
			<label for="pr">Re-enter Password:</label>
			<input type="password" name="pr" placeholder ="Re-enter Password" required = "required" />
			<label for="acc">Account Type:</label>
			<select id="acc" name = "acc">
				<option value = "">Choose a Type</option>
				<option value = "Player">Player</option>
				<option value = "Ref">Referee</option>
			</select>
			 <?php if (isset($error_msg)) { ?>
    			<p class="error box"><?php echo $error_msg; ?></p>
  				<?php } ?>
			<button type="submit" class="btn btn-primary btn-block btn-large">Create Account</button>
		</form>
	</div>

</body>
</html>