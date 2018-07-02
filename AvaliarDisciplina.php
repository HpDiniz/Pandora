<?php

	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "pandora";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

?>

<DOCTYPE html>
<html>
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
	    align-content: center
	}

</style>

</head>

<body>



<div style="width:all;height:249px;border:1px solid #000; background-color:#651296;">
	<input type="checkbox" id="check">
	<label id="icone" for="check"><img src="imagemMenu.png"></label>

	<div class="barra">

		<nav>

			<a href="index.php"> <div class="link">Inicio </div> </a>
			<a href=""> <div class="link">Perfil </div> </a>
			<a href=""> <div class="link">Buscar Usuário </div> </a>
			<a href=""> <div class="link">Sugerir Disciplina </div> </a>
			<a href="logout.php"> <div class="link">Fazer Logout </div> </a>

		</nav>

	</div>


</div>


	<?php

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
					<input type="radio" name="facilidade" value="1"/> 1
					<input type="radio" name="facilidade" value="2"/> 2 
					<input type="radio" name="facilidade" value="3"/> 3 
					<input type="radio" name="facilidade" value="4"/> 4 
					<input type="radio" name="facilidade" value="5"/> 5 </p></center>
					<center><p> Classifique o nível de utilidade:
					<input type="radio" name="utilidade" value="1"/> 1 
					<input type="radio" name="utilidade" value="2"/> 2 
					<input type="radio" name="utilidade" value="3"/> 3 
					<input type="radio" name="utilidade" value="4"/> 4 
					<input type="radio" name="utilidade" value="5"/> 5 </p></center>
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
