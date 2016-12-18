	<?php
		include 'conexionBD.php';
		$id=$_GET['id'];
		$sql1="DELETE FROM Album WHERE Id='$id'";
		$res=mysqli_query($mysqli ,$sql1);
		if (!$res)
		{
			die('Error al eliminar el álbum');
		}
		
		$sql1="DELETE FROM Foto WHERE Album='$id'";
		$res=mysqli_query($mysqli ,$sql1);
		if (!$res)
		{
			die('Error al eliminar el álbum');
		}
			$usuario=$_GET['usuario'];
			$sql="SELECT * FROM Album";
			$resultado=mysqli_query($mysqli ,$sql);
			if (!$resultado)
			{
				die('Error al obtener tus albumes');
			}else{
				if(mysqli_num_rows($resultado)>0){
	    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<img class="resize" ondblclick="verFotos(\''.$row['Id'].'\')" onClick="ajustesAlbum(\''.$row['Id'].'\')" src="'.$row['Portada'].'">';
    				echo '</div>';
	    			}

			}
		}
?>