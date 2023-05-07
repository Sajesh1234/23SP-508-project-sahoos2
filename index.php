<?php require_once('header.php'); ?>

<html>
<head>
	<title>TCG DATABASE</title>
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
     	.imagesfit{
     	height:100%;
     	width:100%; 
     	object-fit: fill;
     	filter:brightness(80%);
     	}
     	.box{
     	background:rgba(0, 0, 0, 0.5);
     	width:100%;
     	padding: 25px;
     	color:white;
     	
     	}
     	
	</style>
	
</head>
<body>
<header>
	<div class ="logo">
	<a href ="index.php" >TCG DataBase</a>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
		<div class ="nav_bar">
			<ul>
				<li><a href = "tournaments"> Tournaments</a>
				<li><a href = "teams">Teams</a></li>
				<li><a href = "cards"> Cards </a></li>
				<li><a href = "login" >Login | Sign Up</a></li>
				
			</ul>
		</div>
	</div>
</header>

<div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="5" aria-label="Slide 6"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="6" aria-label="Slide 7"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img class = "imagesfit" src="images/dragon.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <div class ="box">
        <h1>Blue Eyes White Dragon</h1>
        <p>Deep in the snowy mountains, there lived a mystical dragon. Its scales were white as snow. It has never been caught because this mystical dragon posses the power to bend reality it self.</p>
        </div>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img class = "imagesfit" src="images/armor.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <div class ="box">
        <h1>Enchanted Armor</h1>
        <p>An armor that has been enchanted with Protection, Fire Resistance, Depth Strider, Frost Walker, Soul Speed enchantments, and is a living weapon that will destory anything that gets in its way. </p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img class = "imagesfit" src="images/ghast.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <div class ="box">
        <h1>Ghast</h1>
        <p>A ghastly creature, that roams the underworld, and attacks anything that does not belong in the underwolrd.</p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img class = "imagesfit" src="images/blademaster.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <div class ="box">
        <h1>Blademaster</h1>
        <p>A skilled swordsman and a warrior that has no equal. He has spent years honing his skills, mastering his techniques that has been passed down to him. With his blade he has set out to protect his homeland from destruction.</p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img class = "imagesfit" src="images/giant.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <div class ="box">
        <h1>Giant</h1>
        <p>A colossal figure, who is as tall as a mountain. The giant shakes the earth with every step he takes. It is a force to be reckoned with, feared by even the bravest of warriors.</p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img class = "imagesfit" src="images/witchC.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <div class ="box"> 
        <h1>Mage Doctorate</h1>
        <p>A mage that is considered cray by some because of her smile. She spends her days making strange potions and casting spells that heal people. She also uses her magic to protect people close to her.</p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img class = "imagesfit" src="images/Wyrmling2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      	<div class ="box">
        <h1>Wyrmling</h1>
        <p>A young draon, small and vulnerable in apperance. But dont let the appearance fool you, it posses the same powers as an adult.</p>
        </div>
      </div>
    </div>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</body>
</html>