<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<meta charset="utf-8" /> 
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Sweet Alert Script -->
		<script src="js/sweetalert.min.js"></script>
		<!-- Sweet Alert Styles -->
		<link href="css/sweetalert.css" rel="stylesheet">
	</head>
<body>
	
	<div id="nav">
		<?php include 'sesionIniciada.php';?>
	</div>
	<div id="albumes">
		<?php
		session_start();
		if(!isset($_SESSION['usuario'])){
			header('Location: home.php');	
		}
		include 'conexionBD.php';
		$usuario=$_SESSION['usuario'];
		$sql="SELECT * FROM Foto WHERE Usuario='$usuario' AND Privacidad!='privado'";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<img class="resize" onClick="ajustesFoto(\''.$row['Id'].'\')" src="'.$row['Ruta'].'">';
    				echo '</div>';
    			}
			}else{
				die("<script>jQuery(function(){sweetAlert('Opss...', 'No tienes ninguna foto en este álbum', 'warning');});</script>");
			}
		}
		?>
		</div>
		<div class="ajustes">
			<div id="info">
					<h2 style="align:center;">Estadísticas de la foto</h2>
				¡Haz click en una foto para sus estadísticas!
			</div>
		</div>
<script type="text/javascript">
function ajustesFoto(id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("info").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","obtenerEstadFoto.php?id="+id); 
	xmlhttp.send();
}
</script>
</body>

</html>
