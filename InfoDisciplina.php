<?php

	session_start();

	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "pandora";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);

	if(isset($_POST['discipl'])){

		$DisciplinaBuscada = $_POST['discipl'];

		$code = strstr($DisciplinaBuscada, ' ', true);

		$_SESSION['codigoAtual'] = $code;
	}
	else{
		if(isset($_SESSION['codigoAtual'])){
			$code = $_SESSION['codigoAtual'];
		}
		else{
			header("Location: index.php");
		}
	}

	$query = "SELECT `codigo`,`RecomendacaoP`,`RecomendacaoN` FROM `disciplina` WHERE `codigo` = '".$code."' ";
	$res = mysqli_query($conexao,$query);


?>

<DOCTYPE html>
<html lang="pt-br">
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
table,th,td{
	
	border:1px solid black;
	border-collapse: collapse;
	opacity:0.95;
	
	
}
td{
	
	
	text-align:center;
	
}





.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif; color: black;}
	body {
	    background-color: #cccccc;
	    align-content: center
	}

</style>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		 var data = google.visualization.arrayToDataTable([
          ['RecomendacaoP','Recomendacao'],
		 
		  
		  
		  
		  
		   <?php 
$row=$res->fetch_assoc();

    echo "['positivo',".$row['RecomendacaoP']."],";
	echo "['negativo',".$row['RecomendacaoN']."],";


		  
		   ?>

        ]);

        var options = {
          legend:{position:'none'},
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</head>

<body style="background-color: #946b4a;">

	

	<input type="checkbox" id="check">
	<label id="icone" for="check"><img src="imagemMenu.png"></label>

	<div class="barra" style="z-index:150;">

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

	
	<?php

		$query = sprintf("SELECT * FROM disciplina WHERE Codigo = '$code'");

		$dados = mysqli_query($conexao, $query) or die(mysql_error());

		$linha = mysqli_fetch_assoc($dados);

		$total = mysqli_num_rows($dados);


		if($total < 1){
			header("Location: index.php");
		}

		?> <center><div class="barra_de_cima" style="background-color:#D9D9D9; margin-top:0%; width:all; height:10%; font-size:2vw;  border:1px solid #404040;""><h2 style="margin:auto;"> <?php
			echo "INFORMACOES DE {$code}:";?></h2></div> </center><h4><br>
			
			<div class="barraRecomenda"style=" position:absolute; background-color:#FFFFFF; left:10%; width:30%;height:70%; border-radius:15px; border-left:2px solid #404040; border-right:2px solid #404040; border-bottom:2px solid #404040; z-index:4;">
				<div style="position:relative; font-size: 2vw;; background-color:#D9D9D9; height:10%; border-radius:15px; border:2px solid #404040;"> <center>Recomendações</center></div>
			
				<center><div id="piechart" style=" position:relative; width: 60%; height: 60%;"></div></center> <br>
				<center><div style=" position:relative; ">
				<form method="post" action="AvaliarDisciplina.php">
					<input class="w3-bar-item w3-button w3-hide-small  w3-hover-white w3-black" style="" type="submit" value="Avalie esta disciplina!">
					<input type="hidden" name="codigo" value="<?php echo $linha['Codigo']?>">
					</form></div></center>
				
				
				
				
				
				</div >
			
			
			<?php
			if($linha['TotalDeAvaliacoes'] != 0){
				$mediaU = ($linha['SomaNotaUtilidade']/$linha['TotalDeAvaliacoes']);
				$mediaF = ($linha['SomaNotaFacilidade']/$linha['TotalDeAvaliacoes']);
				} else{
				$mediaU = 0;
				$mediaF = 0;
			}
			
			?> 
			
		<div class="barraEstatisticas"style=" position:absolute;  background-color:#FFFFFF; right:5%; width:50%;height:auto; min-height:70%;  border-left:2px solid #404040; border-right:2px solid #404040; border-bottom:2px solid #404040; z-index:4;">
				<div style="position:relative; font-size: 2vw;; background-color:#D9D9D9; height:10%;  border:2px solid #404040;"> <center>Estatísticas Gerais</center></div>
			
			<div class="circulo" style="padding:15% 0 ;border-radius:50%;border:1px solid #D9D9D9; position:relative; display: inline-block; width:30%; height:0; background-color:#60B7FA;  margin-top:5%; left:10%; text-align: center; "><?php
			
			
			echo "Nivel de Utilidade: ".number_format($mediaU,2,',','.')."";?><br><?php
			?><br>
			
			
			</div>
			
			
			<div class="circulo2" style=" padding:15% 0; border-radius:50%;border:1px solid #D9D9D9; position:relative; display: inline-block; width:30%; height:0; margin-top:5%; background-color:#60B7FA;    float:right; right:10%;  text-align: center;"><?php
			
				
			
				echo "Nivel de Facilidade: ".number_format($mediaF,2,',','.')."";?><br><?php
				?>
			
			
			</div>
			
				<center><br><br><h3>AVALIAÇÕES PASSADAS</h3><br>

	<table >
		
		<tr>
			
			<th>Nome</th>
			<th>Utilidade</th>
			<th>Facilidade</th>
			<th>Recomendado?</th>
			<th>Professor</th>
			<th>Comentario</th>
			<th>Dislike</th>
		</tr>
		
		
		
	
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

				?><tr>  <td><?php echo $linha3['Nome'];?></td>
				<td> <?php echo $linha2['Utilidade'] ?></td>
				<td> <?php echo $linha2['Facilidade'] ?></td>
				<td> <?php if($linha2['Recomenda'] == 1){ echo "SIM";} else { echo "NAO"; }?> </td> 
				<td> <?php echo "{$linha2['Professor']}";?> </td> 
				<td> <?php if($linha2['Comentario'] == NULL){ echo "Esse avaliador nao deixou comentarios";} else { echo "{$linha2['Comentario']}"; }?></td>
				<td><button type="button" >Dislike</button></td><tr> <?php


			}while($linha2 = mysqli_fetch_assoc($dados2));

						?> <center> <?php
		}
		

?>
	</table>
			
		</div>

					


	





</body>

</html>
