<?php

	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "pandora";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title> </title>
		<script type="text/javascript">
		function loginfail(){
			setTimeout("window.location='login.php'", 1);
		}
	</script>

	<?php 	
	session_start();
	if(!isset($_SESSION["usuario"])){
		echo "<script>alert('E necessario estar logado para avaliar disciplina')</script>";
		echo "<script>loginfail()</script>";
		exit;		
	}?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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

.estrelas input[type=radio]{

	display: none;
	cursor: pointer;

}

.estrelas label i.fa:before{

	content: '\f005';
	color: #f5e72c;

	cursor: pointer;

}

.estrelas  input[type=radio]:checked  ~ label i.fa:before{

	color: #999999;

	cursor: pointer;

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
	    align-content: center
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


	<?php


		if(!isset($_POST['codigo']))
			$code = $_SESSION['codigoAtual'];
		else
			$code = $_POST['codigo'];


		$query = sprintf("SELECT * FROM disciplina WHERE Codigo = '$code'"); 

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);

		$total = mysqli_num_rows($dados);

?>

				<form method="post" action="AvaliandoDisciplina.php">
					<center><p> Avaliar anônimamente
					<input type="checkbox" name="anonimo" value="1">
					<center><p> Classifique o nível de dificuldade: 
					<div class = "estrelas" style="font-size: 1.8em;">

						<input type="radio" id="vazio" name="facilidade" value="" checked>
						
						<label for="estrela_um"><i class="fa" ></i></label>
						<input type="radio" id="estrela_um" name="facilidade" value="1" checked>
						
						<label for="estrela_dois"><i class="fa"></i></label>
						<input type="radio" id="estrela_dois" name="facilidade" value="2">
						
						<label for="estrela_tres"><i class="fa"></i></label>
						<input type="radio" id="estrela_tres" name="facilidade" value="3">
						
						<label for="estrela_quatro"><i class="fa"></i></label>
						<input type="radio" id="estrela_quatro" name="facilidade" value="4">
						
						<label for="estrela_cinco"><i class="fa"></i></label>
						<input type="radio" id="estrela_cinco" name="facilidade" value="5"><br>

					</div></center>
					<center><p> Classifique o nível de utilidade:
					<div class = "estrelas" style="font-size: 1.8em;">

						<input type="radio" id="vazio" name="utilidade" value="" checked>
						
						<label for="estrela_sum"><i class="fa" ></i></label>
						<input type="radio" id="estrela_sum" name="utilidade" value="1" checked>
						
						<label for="estrela_sdois"><i class="fa"></i></label>
						<input type="radio" id="estrela_sdois" name="utilidade" value="2">
						
						<label for="estrela_stres"><i class="fa"></i></label>
						<input type="radio" id="estrela_stres" name="utilidade" value="3">
						
						<label for="estrela_squatro"><i class="fa"></i></label>
						<input type="radio" id="estrela_squatro" name="utilidade" value="4">
						
						<label for="estrela_scinco"><i class="fa"></i></label>
						<input type="radio" id="estrela_scinco" name="utilidade" value="5"><br>

					</div></center>

					<center><p> Voce recomenda essa disciplina? 
					<input type="radio" name="recomendacao" value="1"/> Sim
					<input type="radio" name="recomendacao" value="0"/> Nao </p></center>

					<center><p> Fez a disciplina com qual professor?
					<input type="text" name="professor">

					<center><p> Deixe um comentário! (Opicional)
					<input type="text" name="comentario" size="100" /> 
					<input type="hidden" name="codigo" value="<?php echo $code?>">
					<br>
					<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" style="width:200px;" type="submit" value="Enviar">
				</p></center></form>

</body>

</html>
