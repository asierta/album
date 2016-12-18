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
		include 'conexionBD.php';
		$sql="SELECT * FROM Album WHERE usuario='$usuario'";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener tus álbumes', 'error');});</script>");
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<img class="resize" ondblclick="verFotos(\''.$row['Id'].'\')" onClick="ajustesAlbum(\''.$row['Id'].'\')" src="'.$row['Portada'].'">';
    				echo '</div>';
    			}
			}else{
				die("<script>jQuery(function(){sweetAlert('Opss...', 'Todavía no has creado ningún álbum', 'warning');});</script>");
			}
		}
		?>
		</div>
		<div class="ajustes">
			<h2 style="align:center;">Ajustes del álbum</h2>
			<div id="info">
				¡Haz click en un álbum para ver información!
			</div>
		</div>
</body>
</html>
<script type="text/javascript">
var timer;
var status = 1;

$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
var wrapper = $(".filediv"); //Fields wrapper
var x = 1;
$('#add_more').click(function() {
    x++;
 $(wrapper).append('<div>Imagen '+x+'<br><input name="file[]" required type="file" id="file"/><br>Nombre Foto:<br><input type="text" placeholder="nombre foto" required id="nFoto" name="nFoto[]" /><br> Etiqueta:<br><input type="text" placeholder="etiqueta" required id="etiqueta" name="etiqueta[]" /><a href="#" class="remove_field">X</a></div>'); 
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

function ajustesAlbum(id){
	status = 1;
    timer = setTimeout(function() {
	    if (status == 1) {
		    var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("info").innerHTML = xmlhttp.responseText;
					}
				}
			xmlhttp.open("GET","obtenerInfoAlbum.php?id="+id); 
			xmlhttp.send();
	    }
    }, 500);
}

function verFotos(id){
	clearTimeout(timer);
    status = 0;
	window.location = "verFotos.php?id="+id;
}

function aplicarCambios(id){
	var xmlhttp = new XMLHttpRequest();
	var nombreFoto= document.getElementById('nombreAlbum').value;
	//alert(nombreFoto+etiqueta);
			xmlhttp.onreadystatechange = function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var respuesta=xmlhttp.responseText;
						if(respuesta=="Falta información"){
							jQuery(function(){sweetAlert('Opss...', 'Completa todos los campos!', 'warning');});
						}else if (respuesta=='Error'){
							jQuery(function(){sweetAlert('Opss...', 'Error a la hora de aplicar los cambios!', 'error');});
						}else if(respuesta=='Ya existe'){
							jQuery(function(){sweetAlert('Opss...', 'Ya tienes un álbum con este nombre!', 'warning');});
						}else{
							jQuery(function(){sweetAlert('', 'Álbum actualizado correctamente!', 'success');});
						}
					}
				}
			xmlhttp.open("GET","aplicarCambiosAlbum.php?id="+id+"&nombre=" + nombreFoto, true); 
			xmlhttp.send();
}

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