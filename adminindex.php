
<html>
<head>
<title>WELCOME</title>
<?php require_once('header.php'); ?>

<?php require_once ('login-locked.php');

    if (isset($_SESSION['user_ID']) && isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] != "Admin") {
            header ("Location: index");
        }
    }
?>
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
        
        width:50%;
     	  height: 450px;
     	  top: 100px;
     	  color:white;
     	  position: fixed;
     	
     	}
     	.box2{
     	padding: 10px;
        background:#AAA3B8;
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

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
  background:#C9C9C9;
  color: black;
}

th {
  background-color: #B0B0B0;
}
.link:link { 
          text-decoration: none; 
          color:white;}
        .link:hover {
           color: grey;
           background-color: grey;
           text-decoration: none;}
          .link:link { 
            text-decoration: none; 
            color:white;}
          .link:hover {
            color: grey;
            background-color: grey;
            text-decoration: none;}
</style>



<body>

<header>
	<div class ="logo">
	<a href ="" >TCG DataBase</a>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		<div class ="nav_bar">
			<ul>
				<li><a href = "logout">Logout</a></li>
				
			</ul>
		</div>
	</div>
</header>

<div class = "admin">
<div class = "box">
<div class = "box2">
    <h2 style="color: black;">Admin Tools</h2>    
    <table>
  <thead>
    <tr>
      <th>Action</th>
      <th>Link</th>
    </tr>
  </thead>
  <tbody>
      <td>Modify Users</td>
      <td><a class ="link" href="modify-users.php" style="padding-left:10px; color: black;">EDIT</a></td>
    </tr>
    <tr>
      <td>Modify Player W/L and Team Info</td>
      <td><a class ="link" href="modify-players.php" style="padding-left:10px; color: black;">EDIT</a></td>
    </tr>
    <tr>
      <td>Add and Edit Cards</td>
      <td><a class ="link" href="modify-cards.php" style="padding-left:10px; color: black;">EDIT</a></td>
    </tr>
    <tr>
      <td>Add and Edit Tournament locations</td>
      <td><a class ="link" href="modify-locations.php" style="padding-left:10px; color: black;">EDIT</a></td>
    </tr>
    <tr>
      <td>Add and Edit Tournaments</td>
      <td><a class ="link" href="modify-tournaments.php" style="padding-left:10px; color: black;">EDIT</a></td>
    </tr>
    <tr>
      <td>Add and Edit Matches</td>
      <td><a class ="link" href="modify-matches.php" style="padding-left:10px; color: black;">EDIT</a></td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>



</body>
</html>