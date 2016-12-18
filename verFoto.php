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
	   <?php
		include 'conexionBD.php';
		session_start();
		if(!isset($_GET['id'])){
			header('Location: home.php');	
		}
		$id=$_GET['id'];
		$sql="SELECT * FROM Foto WHERE Id='$id'";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
		}else{
			$row=mysqli_fetch_array($resultado);
			echo "<h1>".$row['Nombre']."</h1>";
			echo '<div class="foto">';
			echo '<img src="'.$row['Ruta'].'">';
			echo'</div>';
			session_start();
			if(isset($_SESSION['usuario'])){
				$sql="INSERT INTO VisitasFotos VALUES('$id', '1')";
				$resultado=mysqli_query($mysqli ,$sql);
			}else{
				$sql="INSERT INTO VisitasFotos VALUES('$id', '0')";
				$resultado=mysqli_query($mysqli ,$sql);
			}
		}
		?>
		</div>
</body>
</html>