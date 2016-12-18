<?php	
	if (isset($_GET['id']) && isset($_GET['nombre'])){
		include 'conexionBD.php';
		if (!$mysqli){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
		$id=$_GET['id'];
		$nombre=$_GET['nombre']; 
		$sql="DELETE FROM FotoCompartida WHERE IdFoto='$id' AND Usuario='$nombre'";
		//echo $sql;
		if (!mysqli_query($mysqli ,$sql)){
			die('Error');
		}
		echo 'Foto actualizada';
	}else{
		echo 'Falta información';
	}
?>