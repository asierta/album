<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<meta charset="utf-8" /> 
		<script type="text/javascript"> 
</script> 
	</head>
<body>
	<div id="nav">
		<?php
		session_start();
		if(isset($_SESSION['usuario']) && $_SESSION['usuario']=="admin"){
			include 'menuLoginAdmin.php';
		}else if(isset($_SESSION['usuario'])){
			include 'menuLogin.php';
		}else{
			include 'menu.php';	
		}
		?>
	</div>
	<div id="content">
	   <h1>Pagina principal</h1>
	</div>
</body>
</html>
