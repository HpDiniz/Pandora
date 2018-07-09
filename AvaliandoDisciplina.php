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
<link href="css/style.css" rel="stylesheet">

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


		$util = ($linha['SomaNotaUtilidade'] + $_POST['utilidade']);


		$sql = mysqli_query($conexao, "UPDATE disciplina SET SomaNotaUtilidade='$util'WHERE Codigo = '$code'");

		if($_POST['recomendacao'] == '0'){
			$recomendacao = 1;
			$recomend = $linha['RecomendacaoP'] + 1;
			$sql = mysqli_query($conexao, "UPDATE disciplina SET RecomendacaoP='$recomend'WHERE Codigo = '$code'");
		}
		if($_POST['recomendacao'] == '1'){
			$recomendacao = 0;
			$recomend = $linha['RecomendacaoN'] + 1;
			$sql = mysqli_query($conexao, "UPDATE disciplina SET RecomendacaoN='$recomend'WHERE Codigo = '$code'");
			
		}

		$sql = mysqli_query($conexao, "INSERT INTO pessoaavaliadisciplina (Utilidade, Facilidade, Recomenda, Professor, Comentario, ReacoesNegativas, CodigoDisc, IdPessoa) VALUES ('{$_POST['utilidade']}', '{$_POST['facilidade']}', '{$recomendacao}', '{$_POST['professor']}', '{$_POST['comentario']}', 0 , '{$code}', '{$idUser}')" ); 

		$total = $linha['TotalDeAvaliacoes'] + 1;
		$sql = mysqli_query($conexao, "UPDATE disciplina SET TotalDeAvaliacoes='$total'WHERE Codigo = '$code'");

		echo "<script>successfully()</script>";

	?>

</body>
</html>