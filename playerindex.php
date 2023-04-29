
<html>
<head>
<title>WELCOME</title>
<?php require_once('header.php'); ?>

<?php require_once ('player-only.php');?>
</head>

<style>
        *{
	   margin: 0;
	   padding: 0;
     	}
     	header{
     	  height: 100px;
     	  background: rgba(0,0,0,0.7);
     	  width: 100%;
     	  position:fixed;
     	  z-index:12;
     	}
	   .logo{
     	  font-family: 'Castoro Titling';
     	  font-size: 25px;
     	  padding: 35px;
     	  margin-left:50px;
     	}
     	.logo a{
     	  color: #fff;
     	  text-decoration: none;
     	}
     	.nav_bar{
     	  font-family: 'Castoro Titling';
     	  font-size: 20px;
     	  float:right;
     	  list-style: none;
     	}
     	.nav_bar li{
     	  display: inline-block;
     	}
	    .nav_bar li a{
     	  padding: 15px;
     	}
	    .nav_bar li a:hover{
     	  bacjground: #B4AFAF;
     	  color:#fff;
     	  border: 1px solid #000;
     	  border-radius: 5px;
     	  border-width: auto;
     	}
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

.box{
     	background:rgba(0, 0, 0, 0.5);
     	width:100%;
     	height: 450px;
     	padding: 100px;
     	color:white;
     	
     	}
     	.login { 
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -150px 0 0 -150px;
  width:300px;
  height:300px;
}

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
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

</style>



<body>

<header>
	<div class ="logo">
	<a href ="" >TCG DataBase</a>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		<div class ="nav_bar">
			<ul>
				<li><a href = "teams">Teams</a></li>
				<li><a href = "cards"> Cards </a></li>
				<li><a href = "logout" >Logout</a></li>
				
			</ul>
		</div>
	</div>
</header>

<div class = "editinfo">
	<div class ="box ">
		<div class="edit">
			<h1>EDIT INFO</h1>
				<form method="post">
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" placeholder="Change First Name"/>
				<label for="lastname">Last Name:</label>
				<input type="text" name="lastname" placeholder="Change Last Name"/>
				<label for="DateofBirth">Date of Birth:</label>
				<input type="date" id = "DateofBirth" name="dob" required="required" />	
				</form>
				<br>
				<a href="/~23SP_sahoos2/playerindex.php" class="btn btn-primary btn-block btn-large">Save</a>
		</div>
        
	</div>

</div>



</body>
</html>