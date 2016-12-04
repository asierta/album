	<?php
		$servername = getenv('IP');
		$username = getenv('C9_USER');
		$password = "";
		$dbport = 3306;
		// Create connection
		$mysqli = new mysqli($servername, $username, $password, "album", $dbport);
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
			if($usuario=="admin"){
				$sql="SELECT * FROM Album";
			}else{
				$sql="SELECT * FROM Album WHERE usuario='$usuario'";
			}
			$resultado=mysqli_query($mysqli ,$sql);
			if (!$resultado)
			{
				die('Error al obtener tus albumes');
			}else{
				if(mysqli_num_rows($resultado)>0){
	    			while($row=mysqli_fetch_array($resultado)){
	    				echo '<div class="box2">';
	    				echo '<a href="verFotos.php?id="'.$row['Id'].'"><img class="resize" src="'.$row['Portada'].'"></a>';
	    				echo '<table id="tablaAlbum">';
	    				echo '<tr>';
	    				echo '<td><h3>'.$row['Nombre'] .'</h3></td>';
	    				echo '<td><button id="botonBorrar" style="background-color: transparent; border:transparent; cursor:pointer;" onClick="borrarAlbum(\''.$row['Id'] .'\', \''.$usuario.'\')"><img id="basura" style="float:right; right:10%; cursor:pointer;" class="resize"src="imagenes/basura.png"></button></td>';
    					echo '</tr>';
    					echo '</table>';
    					echo '</div>';
	    			}

			}
		}
?>