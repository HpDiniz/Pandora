<?php

	session_start();
	if(isset($_SESSION["usuario"]) && isset($_POST['codigo']))
		$_SESSION["codigoAtual"] = $_POST['codigo'];

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

		if(!isset($_POST['codigo']))
			$code = $_SESSION['codigoAtual'];
		else
			$code = $_POST['codigo'];


		$query = sprintf("SELECT * FROM disciplina WHERE Codigo = '$code'");

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);

		$total = mysqli_num_rows($dados);


		if($total < 1){
			echo "Erro fatal, disciplina não se encontra no banco de dados";
			header("index.php");
		}

		?> <center><h2> <?php
			echo "INFORMACOES DE {$code}:";?><br></h2><h4><br><?php 

			if($linha['RecomendacaoP'] >= $linha['RecomendacaoN'])
				echo "A maioria dos usuarios recomendaram essa disciplina";
			else
				echo "A maioria dos usuarios não recomendaram essa disciplina";?><br><?php 

			if($linha['TotalDeAvaliacoes'] != 0){
				$mediaU = ($linha['SomaNotaUtilidade']/$linha['TotalDeAvaliacoes']);
				$mediaF = ($linha['SomaNotaFacilidade']/$linha['TotalDeAvaliacoes']);
			} else{
				$mediaU = 0;
				$mediaF = 0;
			} 
			
			echo "Nivel de Utilidade: {$mediaU}"; ?><br><?php 
			echo "Nivel de Facilidade: {$mediaF}"; ?><br><?php 
			echo "Foi avaliada: {$linha['TotalDeAvaliacoes']} vezes"; ?><br></h4></center><?php 

	?>

					<form method="post" action="AvaliarDisciplina.php">
					<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" style="width:200px;" type="submit" value="Avalie esta disciplina!">
					<input type="hidden" name="codigo" value="<?php echo $linha['Codigo']?>">
					</form>

					<center><br><br><h3>AVALIAÇÕES PASSADAS</h3><br></center>

<?php 

		$query2 = sprintf("SELECT * FROM pessoaavaliadisciplina WHERE CodigoDisc = '$code'");

		$dados2 = mysqli_query($conexao, $query2) or die(mysql_error());

		$linha2 = mysqli_fetch_assoc($dados2);

		$total2 = mysqli_num_rows($dados2);

		if($total2 > 0){

			?> <center> <?php
			do {

				//if($linha2['IdPessoa'] != '1'){
				$query3 = sprintf("SELECT * FROM pessoa WHERE idpessoa = '{$linha2['IdPessoa']}'");
				$dados3 = mysqli_query($conexao, $query3) or die(mysql_error());
				$linha3 = mysqli_fetch_assoc($dados3);  
				//	 Avaliacao de: <?php echo $linha3['Nome'];
				//} else if($linha2['IdPessoa'] == '1'){
				//	Avaliacao de: <?php echo "Anonimo";
				//} 

				?> Avaliacao de: <?php echo $linha3['Nome'];?> <br>
				Nivel de utilidade: <?php echo $linha2['Utilidade'] ?><br>
				Nivel de dificuldade: <?php echo $linha2['Facilidade'] ?><br>
				Disciplina Recomendada? <?php if($linha2['Recomenda'] == 1){ echo "SIM";} else { echo "NAO"; }?> <br> 
				Disciplina feita com professor: <?php echo "{$linha2['Professor']}";?> <br> 
				Comentario do aluno: <?php if($linha2['Comentario'] == NULL){ echo "Esse avaliador nao deixou comentarios";} else { echo "{$linha2['Comentario']}"; }?>
				<button type="button">Dislike</button><br><br> <?php


			}while($linha2 = mysqli_fetch_assoc($dados2));

						?> <center> <?php
		}
		

?>

</body>

</html>
