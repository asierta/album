<?php	
	if (isset($_GET['id']) && isset($_GET['nombre'])){
	include 'conexionBD.php';
		if (!$mysqli){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
		$id=$_GET['id'];
		$nombre=$_GET['nombre']; 
		$sql="Select * FROM Album WHERE Nombre='$nombre'";
		if (!mysqli_query($mysqli ,$sql)){
			die('Error');
		}
		$cont= mysqli_num_rows($sql); 
		if($cont==0){
			$sql="UPDATE Album SET Nombre='$nombre' WHERE Id='$id'";
			if (!mysqli_query($mysqli ,$sql)){
				die('Error');
			}
			echo 'Foto actualizada';
		}else{
			echo 'Ya existe';	
		}
	}else{
		echo 'Falta información';
	}
?>