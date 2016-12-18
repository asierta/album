<?php	
	if (isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['etiqueta']) && isset($_GET['priv'])){
		include 'conexionBD.php';
		if (!$mysqli){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
		$id=$_GET['id'];
		$nombre=$_GET['nombre']; 
		$etiqueta=$_GET['etiqueta'];
		$privacidad=$_GET['priv'];
		$sql="UPDATE Foto SET Nombre='$nombre', Etiqueta='$etiqueta', Privacidad='$privacidad' WHERE Id='$id'";
		if (!mysqli_query($mysqli ,$sql)){
			die('Error');
		}
		echo 'Foto actualizada';
	}else{
		echo 'Falta información';
	}
?>