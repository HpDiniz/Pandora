<DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title> </title>




<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style tyle="text/css">

"{

	margin:0;
	padding:0;

}

body{

	background-color:#000000;

}

#check{

	display: none;

}

#icone{

	transition:all .2s linear;
	cursor:pointer;
	padding :15px;
	position:absolute;
	z-index:1;

}

.barra{

	background-color: #333;
	height:100%;
	width:300px;
	position: absolute;
	transition:all .2s linear;
	left:-300px;
}

nav{
	width:100%;
	position:absolute;
	top:60px;

}

nav .a{

	text-decoration: none;

}

.link{

	background-color:494950;
	padding: 20px;
	font-family:'arial';
	font-size: 12pt;
	transition: all .2s linear;
	color: #f4f4f9;
	border-bottom: 2px solid #222;
	opacity:0;
	margin-top:200px;
}

.link:hover{
	background-color: #050542;

}


#check:checked ~ .barra {

	transform: translateX(300px);	
	
}

#check:checked ~ #icone{

	transform:translateX(300px);
	transition: all .2s linear;

}

#check:checked ~ .barra nav a .link{

	opacity:1;	
	margin-top:0;
	
}

.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif; color: black;}
	body {
		
	    background-color: #cccccc;
	}

</style>

</head>

<body>

	<img src="logo.png"  style=" width:600px; height:300px; position:absolute; left:30%;"> </img>

<div style="width:all;height:270px;border:1px solid #000; background-color:#946b4a;z-index:150;">
	<input type="checkbox" id="check">
	<label id="icone" for="check"><img src="imagemMenu.png"></label>

	<div class="barra">

		<nav>

			<?php	
			if(isset($_SESSION["usuario"]) ){	
				echo "Boas Vindas {$_SESSION["usuario"]}";
			}
			if(!isset($_SESSION["usuario"])){ ?>
			<a href="login.php"> <div class="link">Fazer Login </div> </a><?php
			} ?>
			<a href="index.php"> <div class="link">Inicio </div> </a>
			<a href=""> <div class="link">Perfil </div> </a>
			<a href=""> <div class="link">Buscar Usuário </div> </a>
			<a href=""> <div class="link">Sugerir Disciplina </div> </a>
			<?php 
			if(isset($_SESSION["usuario"]) ){ ?>
			<a href="logout.php"> <div class="link">Fazer Logout </div> </a><?php
			} ?>

		</nav>

	</div>
	<a href="index.php"> <img src="logo.png"  style=" width:600px; height:300px; position:absolute; left:30%;"> </img> </a>

</div>



	<center>
		<br>
		<form method="post" action="autentica.php">
			<br>
			<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" type="submit" value="Fazer Login com Facebook""/>
			<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" type="submit" value="Fazer Login com Google""/>
	</center>


</body>

</html>
