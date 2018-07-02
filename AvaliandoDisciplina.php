<?php

	session_start();
	if(!isset($_SESSION["usuario"]))
		header("index.php"); 

	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "pandora";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

	$code = $_POST['codigo'];

	?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
		<script type="text/javascript">
		function successfully(){
			setTimeout("window.location='infoDisciplina.php'", 20);
		}
	</script>




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

			<?php

		$query = sprintf("SELECT * FROM disciplina WHERE Codigo = '$code'"); // TODAS AS SOLICITAÇÕES QUE JÁ FORAM CONCLUIDAS (Logado como cliente)

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);


		if(isset($_POST['anonimo'])){
		 	if($_POST['anonimo']== '1')
				$idUser = '1';
		} else
			$idUser = $_SESSION["id"];

		$facil = ($linha['SomaNotaFacilidade'] + $_POST['facilidade']);


		$sql = mysqli_query($conexao, "UPDATE disciplina SET SomaNotaFacilidade='$facil'WHERE Codigo = '$code'");


		$util = ($linha['SomaNotaUtilidade'] + $_POST['facilidade']);


		$sql = mysqli_query($conexao, "UPDATE disciplina SET SomaNotaUtilidade='$util'WHERE Codigo = '$code'");

		if($_POST['recomendacao'] = '1'){
			$recomend = $linha['RecomendacaoP'] + 1;
			$sql = mysqli_query($conexao, "UPDATE disciplina SET RecomendacaoP='$recomend'WHERE Codigo = '$code'");
		}
		if($_POST['recomendacao'] == '0'){
			$recomend = $linha['RecomendacaoN'] + 1;
			$sql = mysqli_query($conexao, "UPDATE disciplina SET RecomendacaoP='$recomend'WHERE Codigo = '$code'");
		}

		$sql = mysqli_query($conexao, "INSERT INTO pessoaavaliadisciplina (Utilidade, Facilidade, Recomenda, Professor, Comentario, ReacoesNegativas, CodigoDisc, IdPessoa) VALUES ('{$_POST['utilidade']}', '{$_POST['facilidade']}', '{$_POST['recomendacao']}', '{$_POST['professor']}', '{$_POST['comentario']}', 0 , '{$code}', '{$idUser}')" ); 

		$total = $linha['TotalDeAvaliacoes'] + 1;
		$sql = mysqli_query($conexao, "UPDATE disciplina SET TotalDeAvaliacoes='$total'WHERE Codigo = '$code'");

		echo "<script>successfully()</script>";

	?>

</body>
</html>