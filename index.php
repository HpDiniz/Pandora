<?php

	session_start();

	$host = "localhost";
	$user = "root";
	$senha = "";
	$banco = "pandora";

	$conexao = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());

	mysqli_select_db($conexao, $banco);
	$query= "SELECT * FROM `disciplina`";
	$result1= mysqli_query($conexao,$query);
	$faceis = "SELECT * FROM `disciplina` ORDER BY `SomaNotaFacilidade` DESC";
	$result2= mysqli_query($conexao,$faceis);
	$uteis = "SELECT * FROM `disciplina` ORDER BY `SomaNotaUtilidade` DESC";
	$result3= mysqli_query($conexao,$uteis);
	$recomendadas = "SELECT * FROM `disciplina` ORDER BY `RecomendacaoP` DESC";
	$result4= mysqli_query($conexao,$recomendadas);

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
.botao1 {
    background-color: #999999;
    border: solid;
    border-color: #CCCCCC;
	color:white;
    padding: 15px;
    text-align: center;
    text-decoration: none;
   
    font-size: 12px;
	border-radius: 14px;
}	

.w3-sidebar a {font-family: "Roboto", sans-serif}
	body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif; color: black;}
	body {
		
	    background-color: #cccccc;
	}
	
	table, th, td {
    border: 1px solid black;
}
th{
	
	background-color:#F5F5F5;
	
}

</style>

</head>

<body>



<div style="width:all;height:270px;border:1px solid #000; background-color:#651296;z-index:150;">
	<input type="checkbox" id="check">
	<label id="icone" for="check"><img src="imagemMenu.png"></label>

	<div class="barra" style="position:absolute; z-index:150;">

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
	
	<img src="logo.png"  style=" width:600px; height:300px; position:absolute; left:30%;"> </img>
	
	<?php 
		if(!isset($_SESSION["usuario"]) ){
			?> <a href="login.php"><button class = "botao1" style= "position:relative; left:1200px; top :20px;" > Login </button ></a> <?php
		} 
	?>
		<?php if(isset($_SESSION["usuario"]) ){
			?>
			<button class = "botao1" style= "position:relative; left:1200px; top :20px;"><?php echo "Olá {$_SESSION["usuario"]}"; ?></button><?php
		} 
	?>


</div>



	<center>
		<br>
		<form method="post" action="PesquisaDisciplina.php" >
			<input class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white w3-black" style=" position:absolute; right:200px;" type="submit" name="pesquisa" value="Pesquisar"/>
			<input class="w3-input w3-right w3-border" style=" position:absolute; right:300px; width:800px;" type="text" placeholder="Pesquisar Disciplina" required type ="text" list="datalist1"  name="discipl"/>
			<datalist id="datalist1">
				<?php while($row1 = mysqli_fetch_array($result1) ) :; ?>
				<option value="<?php echo $row1[1]; ?>"> 
				<?php endwhile; ?>
				
				
			</datalist>
	
	</center>




		
	
	
			<table style=" position:absolute; width:100%; z-index=0; top:400px; left:100; width:311;height:202px;border:1px solid #000; background-color:#FFFFFF;">
				<tr>
				<th >As mais fáceis</th>
				</tr>
				
				<?php $i=0; while($row2 = mysqli_fetch_array($result2) and $i!=3 ) :; ?>
				<tr><td><?php echo "$row2[0] - $row2[1]"; $i++; ?> </td></tr>
				<?php endwhile; ?>
				
			</table>
			
			<table style=" position:absolute; width:100%; z-index=0; top:400px; left:511; width:311;height:202px;border:1px solid #000; background-color:#FFFFFF;">
				<tr>
				<th>As mais úteis</th>
				</tr>
				
				<?php $i2=0; while($row3 = mysqli_fetch_array($result3) and $i2!=3 ) :; ?>
				<tr><td><?php echo "$row3[0] - $row3[1]"; $i2++; ?> </td></tr>
				<?php endwhile; ?>
				
			</table>
			
			<table style=" position:absolute; width:100%; z-index=0; top:400px; left:922; width:311;height:202px;border:1px solid #000; background-color:#FFFFFF;">
				<tr>
				<th>As mais recomendadas</th>
				</tr>
				
				<?php $i3=0; while($row4 = mysqli_fetch_array($result4) and $i3!=3 ) :; ?>
				<tr><td><?php echo "$row4[0] - $row4[1]"; $i3++; ?> </td></tr>
				<?php endwhile; ?>
				
			</table>
			
		
	

</body>

</html>

