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

<?php
	$DisciplinaBuscada = $_POST['discipl'];
?>

</head>

<body>

<div style="width:all;height:249px;border:1px solid #000; background-color:#946b4a;">
	<input type="checkbox" id="check">
	<label id="icone" for="check"><img src="imagemMenu.png"></label>

	<div class="barra">

		<nav>

			<a href="index.php"> <div class="link">Inicio </div> </a>
			<a href=""> <div class="link">Perfil </div> </a>
			<a href=""> <div class="link">Buscar Usu�rio </div> </a>
			<a href=""> <div class="link">Sugerir Disciplina </div> </a>
			<a href="logout.php"> <div class="link">Fazer Logout </div> </a>

		</nav>

	</div>


</div>



	<?php

		$query = sprintf("SELECT * FROM disciplina order by Codigo asc"); 

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);

		$total = mysqli_num_rows($dados);

			do {
				if(strtolower($linha['Nome']) == strtolower($DisciplinaBuscada)|| strtolower($linha['Codigo']) == strtolower($DisciplinaBuscada)){?>

				<center><form method="post" action="InfoDisciplina.php">
					<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" style="width:1000px;" type="submit" name="geral" value="<?php echo $linha['Codigo']?> - <?php echo $linha['Nome']?>">
					<input type="hidden" name="codigo" value="<?php echo $linha['Codigo']?>">
				</form></center>
				<br>

					<?php
				} ?>
<?php
		}while($linha = mysqli_fetch_assoc($dados));


		$query = sprintf("SELECT * FROM disciplina order by Codigo asc"); 

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);

		$total = mysqli_num_rows($dados);


		do {
			if(strtolower($linha['Nome']) != strtolower($DisciplinaBuscada) && strtolower($linha['Codigo']) != strtolower($DisciplinaBuscada)){?>

				<center><form method="post" action="InfoDisciplina.php">
					<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" style="width:1000px;" type="submit" name="geral" value="<?php echo $linha['Codigo']?> - <?php echo $linha['Nome']?>">
					<input type="hidden" name="codigo" value="<?php echo $linha['Codigo']?>">
				</form></center>
				<br>


					<?php
				} ?>
<?php
		}while($linha = mysqli_fetch_assoc($dados));
		?>





</body>

</html>
