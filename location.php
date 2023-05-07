<html>
<head>
<title>TCG Tournaments</title>
<?php require_once('header.php'); ?>

</head>

<?php require_once('connection.php'); ?>

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
.tourna{
  	width: 100%;
    display: flex;
    flex-direction: column;
     	}
</style>
<body>

<div class="tourna">
	<h4 style = "text-align:center; color: white;"><?php 
	    $sqlQuery = "SELECT NAME
                 FROM Tournament_Location
                 WHERE Address = :Address";
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindvalue(':Address', $_GET['loc']);
        $stmt->execute();
	    echo $stmt->fetch()[0] ?> </h4>
	<div class ="box">
		<table id="table-loc" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Year</th>
					<th>Prize Money</th>
					<th>Address</th>
					<th>View Teams</th>
					<th>View Matches</th>
				</tr>

			</thead>
		</table>
	</div>
</div>

</body>
</html>