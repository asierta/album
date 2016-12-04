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
		$servername = getenv('IP');
		$username = getenv('C9_USER');
		$password = "";
		$dbport = 3306;
		// Create connection
		$mysqli = new mysqli($servername, $username, $password, "album", $dbport);
		$id=$_GET['id'];
		$sql="SELECT * FROM Foto WHERE Album=$id";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<a href="verFotos.php?id='.$row['Id'].'"><img class="resize" src="'.$row['Ruta'].'"></a>';
    				echo '<table id="tablaAlbum">';
    				echo '<tr>';
    				echo '<td><h3>'.$row['Nombre'] .'</h3></td>';
    				echo '<td><button id="botonBorrar" style="background-color: transparent; border:transparent; cursor:pointer;" onClick="borrarAlbum(\''.$row['Id'] .'\', \''.$usuario.'\')"><img id="basura" style="float:right; right:10%; cursor:pointer;" class="resize"src="imagenes/basura.png"></button></td>';
    				echo '</tr>';
    					echo '</table>';
    				echo '</div>';
    			}
			}else{
				die("<script>jQuery(function(){sweetAlert('Opss...', 'Todavía no has creado ningún álbum', 'warning');});</script>");
			}
		}
		?>
		</div>
</body>
</html>
<script type="text/javascript">
function borrarAlbum(id, usuario)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var respuesta=xmlhttp.responseText;
						if(respuesta=="Error al eliminar el álbum"){
							jQuery(function(){sweetAlert('Opss...', 'Error al borrar el álbum!', 'error');});
					}else if (respuesta=='Error al obtener tus albumes'){
						jQuery(function(){sweetAlert('Opss...', 'Error al validar al usuario!', 'error');});
					}else if(respuesta=='Todavía no has creado ningún album'){
						jQuery(function(){sweetAlert('Opss...', 'Todavía no has creado ningún álbum!', 'warning');});
					}else{
						jQuery(function(){sweetAlert('', 'Álbum borrado correctamente!', 'success');});
						document.getElementById("albumes").innerHTML = respuesta;
					}
				}
			};
			xmlhttp.open("GET","borrarAlbum.php?id="+id+"&usuario="+usuario); 
			xmlhttp.send();
		}
	
</script>