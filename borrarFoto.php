<?php
		include 'conexionBD.php';
		$id=$_GET['id'];
		$sql1="DELETE FROM Foto WHERE Id='$id'";
		$res=mysqli_query($mysqli ,$sql1);
		if (!$res)
		{
			die('Error al eliminar la foto');
		}
		$id=$_GET['Album'];
		$sql="SELECT * FROM Foto WHERE Album=$id";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die('Error al obtener las fotos');
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<img class="resize" ondblclick="verFoto()" onClick="ajustesFoto(\''.$row['Id'].'\')" src="'.$row['Ruta'].'">';
    				echo '</div>';
    			}
			}else{
				die('No tienes ninguna foto en este álbum');
			}
		}
?>