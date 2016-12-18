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
	   <h1>Fotos públicas</h1>
	   <?php
		include 'conexionBD.php';
		session_start();
		$id=$_GET['id'];
		if(isset($_SESSION['usuario'])){
			$usuario=$_SESSION['usuario'];
			$sql="SELECT * FROM Foto WHERE Privacidad='publica' OR Privacidad='accesoLimitado'";
		
		}else{
			$sql="SELECT * FROM Foto  WHERE Privacidad='publica'";
		}
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<img class="resize" onClick="verFoto(\''.$row['Id'].'\')" src="'.$row['Ruta'].'">';
    				echo '</div>';
    			}
			}
    		if(isset($_SESSION['usuario'])){
				$usuario=$_SESSION['usuario'];
				$sql="SELECT * FROM Foto AS F, FotoCompartida AS FC WHERE F.Id=FC.IdFoto AND FC.Usuario='$usuario'";
				$resultado=mysqli_query($mysqli ,$sql);
				if (!$resultado)
				{
					die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
				}else{
					if(mysqli_num_rows($resultado)>0){
						echo'<h1>Fotos compartidas contigo</h1>';
		    			while($row=mysqli_fetch_array($resultado)){
		    				echo '<div class="box2">';
		    				echo '<img class="resize" onClick="verFoto(\''.$row['Id'].'\')" src="'.$row['Ruta'].'">';
		    				echo '</div>';
		    			}
					}
				}
			}
		}
		?>
		</div>
</body>
<script type="text/javascript">
	function verFoto(id){
		window.open('verFoto.php?id='+id, '_blank');
	}
</script>
</html>