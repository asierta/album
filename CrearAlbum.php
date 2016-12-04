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
	<div id="content">
		<div class="album-page">
 			<div class="form">
 				<h1>Crear un nuevo álbum</h1>
 				<form id="album" action="CrearAlbum.php" method="post" enctype="multipart/form-data">
   					Nombre : <br><input type="text" placeholder="nombre" required id="nombre" name="nombre" /><br><br>               
					Imagen de portada: <br><input type="file" name="imagen" required id="imagen" /><br><br>
					Imagenes: <br><input type="file" name="archivo[]" multiple="multiple"/><br><br>
					<input id="input" type="submit" value="Crear"/>
				</form>
			</div>
 		</div>
	</div>
</body>
</html>
<?php
if(isset($_FILES['imagen'])&&isset($_POST['nombre']) && $_FILES["archivo"]["name"][0]){
//conexion a la base de datos
$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$dbport = 3306;
// Create connection
$mysqli = new mysqli($servername, $username, $password, "album", $dbport);
//comprobamos si ha ocurrido un error.
if ($_FILES["imagen"]["error"] > 0){
	echo "ha ocurrido un error";
} else {
	$nAlbum=$_POST['nombre'];
	$sql="SELECT COUNT(*) FROM Album Where Nombre='$nAlbum' AND usuario='$usuario'";
	if (!($num=mysqli_query($mysqli ,$sql)))
	{
		die("<script>jQuery(function(){sweetAlert('Opss...', 'Error en la creación del album', 'error');});</script>");
	}
	$row=mysqli_fetch_array($num);
	if($row[0]==0){
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "image/pjpeg");
	$limite_kb = 1000;
	
	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "imagenes/" . $_FILES['imagen']['name'];
		//if(!mkdir($estructura, 0777, true)) {
    	//die('Fallo al crear las carpetas...');}
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
			if ($resultado){
				$nombre = $_FILES['imagen']['name'];
				$sql="INSERT INTO Album (Nombre, Portada, usuario) VALUES ('$nAlbum', '$ruta', '$usuario')";
				if (!mysqli_query($mysqli ,$sql))
				{
					//$error=mysqli_error($mysqli);
					die("<script>jQuery(function(){sweetAlert('Opss...', 'Error en el registro', 'error');});</script>");
				}
				        # recorremos todos los arhivos que se han subido
				mysqli_commit($mysqli);
		        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
		        {
		            # si es un formato de imagen
		            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
		            {
		            		$ruta2 = "imagenes/" . $_FILES["archivo"]["name"][$i];
							$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"][$i], $ruta2);
							if ($resultado){
								$nombre =  $_FILES["archivo"]["name"][$i];
								$sql="SELECT Id FROM Album WHERE Nombre='$nAlbum' AND usuario='$usuario' AND Portada='$ruta'";
								if (!($res=mysqli_query($mysqli ,$sql)))
								{
									//$error=mysqli_error($mysqli);
									die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum', 'error');});</script>");
								}
								$resul=mysqli_fetch_array($res);
								$idAlbum=$resul['Id'];
								$sql2="INSERT INTO Foto (Album, Usuario, Ruta) VALUES ($idAlbum, '$usuario', '$ruta2')";
								if (!mysqli_query($mysqli ,$sql2))
								{
									//$error=mysqli_error($mysqli);
									die('Error:                                                                    ' . mysqli_error($mysqli));
									//die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum 1', 'error');});</script>");
								}
		                }else{
		                    die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum 2', 'error');});</script>");
		                }
		            }else{
		                 die("<script>jQuery(function(){sweetAlert('Opss...', 'Formato de archivo no válido', 'error');});</script>");
		            }
		        }
				echo "<script>jQuery(function(){sweetAlert('Enhorabuena', 'Se ha creado el álbum!', 'success');});</script>";	
			} else {
					die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum 3', 'error');});</script>");
			}
		
	} else {
		echo "<script>jQuery(function(){sweetAlert('Opss...', 'Archivo no permitido!', 'warning');});</script>";
	//	echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
	}
}else{
	echo "<script>jQuery(function(){sweetAlert('Opss...', 'Ya tienes un álbum con este nombre!', 'warning');});</script>";
}
}
}
?>
