
</body>
</html>


<DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title></title>
	<script type="text/javascript">
		function loginsuccessfully(){
			setTimeout("window.location='index.php'", 20);
		}

		function loginfailed(){
			setTimeout("window.location='index.php'", 20);
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

		



		$host = "localhost";
		$user = "root";
		$senha = "";
		$banco = "pandora";

		$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

		mysqli_select_db($conexao, $banco);

		$query = sprintf("SELECT * FROM pessoa WHERE idpessoa = 2"); // TODAS AS SOLICITAÇÕES QUE JÁ FORAM CONCLUIDAS (Logado como cliente)

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);

		 
		session_start();
		$_SESSION['usuario'] = $linha['Nome'];
		$_SESSION['id'] = $linha['idpessoa'];
		$_SESSION['codigoAtual'] = NULL;
		//echo "<script>alert('Logado com sucesso')</script>";
		echo "<script>loginsuccessfully()</script>";
		 
		?>


	?>


</body>
</html>
