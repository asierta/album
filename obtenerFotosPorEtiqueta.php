	<?php
		include 'conexionBD.php';
		$etiqueta=$_GET['etiqueta'];
		session_start();
		$usuario=$_SESSION['usuario'];
		$sql="SELECT * FROM Foto WHERE Etiqueta='$etiqueta' AND Usuario='$usuario'";
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
				die('No tienes ninguna foto con esa etiqueta');
			}
		}
		?>