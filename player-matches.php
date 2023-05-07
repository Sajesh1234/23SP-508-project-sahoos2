<html>
<head>
<title>TCG Teams</title>
<?php require_once('header.php'); ?>

<script src="js/player-matches.js"></script>
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
.teams{
text-align: center;
color:white;
height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
}
.box{
     	padding: 10px;
        background:#AAA3B8;
     	
     	}
.table-Team {
width: 100%;
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
</style>

<body>

<div class="teams">
	<h4>Your Matches</h4>
	<div class = "box">
		<table id="table-match" class="table table-bordered table-striped" style = "width: 100%">
			<thead>
				<tr>
					<th>Players</th>
					<th>Winner</th>
					<th>Winner's Team</th>
					<th>Ref</th>
					<th>Ref Notes</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

</body>
</html>