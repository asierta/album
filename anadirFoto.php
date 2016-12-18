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
		<script src="script.js"></script>
	</head>
<body>
	<div id="nav">
		<?php include 'sesionIniciada.php';?>
	</div>
	<div id="content">
		<br><br>
		<div class="album-page">
 			<div class="form">
 				<h1>Añadir fotos al álbum</h1>
 				<form id="album" action="" method="post" enctype="multipart/form-data">
					Imagenes: <br><div class="filediv">
									Imagen 1: <br><input name="file[]" required type="file" id="file"/><br>
								 	Nombre Foto:<br><input type="text" placeholder="nombre foto" required id="nFoto" name="nFoto[]" /><br>
								 	Etiqueta:<br><input type="text" placeholder="etiqueta" required id="etiqueta" name="etiqueta[]" />
								  </div>
								  <br>
							  <input type="button" id="add_more" class="upload" value="Add More Files"/><br/>
					<input id="input" type="submit" value="Añadir"/>
				</form>
			</div>
 		</div>
	</div>
</body>
</html>
<?php
if(isset($_FILES['file']["name"])){
include 'conexionBD.php';
$idAlbum=$_GET['id'];
		        for($i=0;$i<count($_FILES["file"]["name"]);$i++)
		        {	
		        	
		        	echo $i;
		            # si es un formato de imagen
		            if($_FILES["file"]["type"][$i]=="image/jpeg" || $_FILES["file"]["type"][$i]=="image/pjpeg" || $_FILES["file"]["type"][$i]=="image/gif" || $_FILES["file"]["type"][$i]=="image/png")
		            {
		            		$ruta2 = "imagenes/" . $_FILES["file"]["name"][$i];
							$resultado = @move_uploaded_file($_FILES["file"]["tmp_name"][$i], $ruta2);
							if ($resultado){
								$nombre =  $_FILES["file"]["name"][$i];
								$sql="SELECT usuario FROM Album WHERE Id=$idAlbum";
								if (!($res=mysqli_query($mysqli ,$sql)))
								{
									//$error=mysqli_error($mysqli);
									die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum', 'error');});</script>");
								}
								$resul=mysqli_fetch_array($res);
							
								$usuario=$resul['usuario'];
								$nFoto=$_POST['nFoto'][$i];
								$etiqueta=$_POST['etiqueta'][$i];
								$sql2="INSERT INTO Foto (Album, Usuario, Nombre, Ruta, Etiqueta) VALUES ($idAlbum, '$usuario', '$nFoto', '$ruta2', '$etiqueta')";
								if (!mysqli_query($mysqli ,$sql2))
								{
									//$error=mysqli_error($mysqli);
									die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al subir la imagen', 'error');});</script>");
									//die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum 1', 'error');});</script>");
								}
		                }else{
		                    die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al crear el álbum 2', 'error');});</script>");
		                }
		            }else{
		                 die("<script>jQuery(function(){sweetAlert('Opss...', 'Formato de archivo no válido', 'error');});</script>");
		            }
		        }
		        echo "<script>jQuery(function(){sweetAlert('Enhorabuena', 'Se han subido las fotos!', 'success');});</script>";	
}
?>
