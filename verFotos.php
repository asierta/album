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
		if(!isset($_GET['id'])){
			header('Location: home.php');	
		}
		include 'conexionBD.php';
		$id=$_GET['id'];
		$sql="SELECT Usuario FROM Album WHERE Id=$id";
		$resultado=mysqli_query($mysqli ,$sql);
		$row=mysqli_fetch_array($resultado);
		session_start();
		if($row['Usuario']!=$_SESSION['usuario']){
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Este álbum no es tuyo', 'error');});window.location.replace(\"home.php\");</script>");
		}
		$sql="SELECT * FROM Foto WHERE Album=$id";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<img class="resize" ondblclick="verFoto(\''.$row['Id'].'\')" onClick="ajustesFoto(\''.$row['Id'].'\')" src="'.$row['Ruta'].'">';
    				echo '</div>';
    			}
			}else{
				die("<script>jQuery(function(){sweetAlert('Opss...', 'No tienes ninguna foto en este álbum', 'warning');});</script>");
			}
		}
		?>
		</div>
		<div class="ajustes">
			<div id="info">
					<h2 style="align:center;">Compartir y Ajustes de la foto</h2>
				¡Haz click en una foto para ver información y doble click para verla ampliada!
				
			</div>
		</div>
<script type="text/javascript">
var timer;
var status = 1;
function borrarAlbum(id, usuario)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var respuesta=xmlhttp.responseText;
					if (respuesta=='Error al obtener tus albumes'){
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

function ajustesFoto(id){
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
			xmlhttp.open("GET","obtenerInfoFoto.php?id="+id); 
			xmlhttp.send();
	    }
    }, 500);
	
}

function aplicarCambios(id){
	var xmlhttp = new XMLHttpRequest();
	var nombreFoto= document.getElementById('nombreFoto').value;
	var etiqueta= document.getElementById('etiquetaFoto').value;
	var privacidad=document.querySelector('input[name="privacidad"]:checked').value;
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
						}else{
							jQuery(function(){sweetAlert('', 'Foto actualizada correctamente!', 'success');});
						}
					}
				}
			xmlhttp.open("GET","aplicarCambiosFoto.php?id="+id+"&nombre=" + nombreFoto +"&etiqueta="+etiqueta +"&priv="+privacidad, true); 
			xmlhttp.send();
}

function Compartir(id){
	var xmlhttp = new XMLHttpRequest();
	var usucom= document.getElementById('usuario').value;
	if((usucom.trim().length)==0){
		jQuery(function(){sweetAlert('Opss...', 'Introduce un nombre de usuario!', 'warning');});
		return;
	}
	if(usucom.trim()=="<?php echo $_SESSION['usuario']; ?>"){
		jQuery(function(){sweetAlert('Opss...', 'No puedes compartir una foto contigo mismo!', 'warning');});
		return;
	}
			xmlhttp.onreadystatechange = function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var respuesta=xmlhttp.responseText;
						if(respuesta=="Falta información"){
							jQuery(function(){sweetAlert('Opss...', 'Introduce un nombre de usuario!', 'warning');});
						}else if (respuesta=='Error'){
							jQuery(function(){sweetAlert('Opss...', 'Error al compartir la foto!', 'error');});
						}else{
							jQuery(function(){sweetAlert('', 'Foto compartida correctamente!', 'success');});
							actualizarSelect(id);
						}
					}
				}
			xmlhttp.open("GET","CompartirFoto.php?id="+id+"&nombre="+usucom, true); 
			xmlhttp.send();
}

function DejarCompartir(id){
	var xmlhttp = new XMLHttpRequest();
	var lista = document.getElementById("validar");
			// Obtener el valor de la opción seleccionada
	var usucom = lista.options[lista.selectedIndex].value;
	if(usucom=="- Compartida con -"){
		jQuery(function(){sweetAlert('Opss...', 'Selecciona un nombre de usuario!', 'warning');});
		return;
	}
			xmlhttp.onreadystatechange = function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var respuesta=xmlhttp.responseText;
						if(respuesta=="Falta información"){
							jQuery(function(){sweetAlert('Opss...', 'Introduce un nombre de usuario!', 'warning');});
						}else if (respuesta=='Error'){
							jQuery(function(){sweetAlert('Opss...', 'Error al dejar de compartir la foto!', 'error');});
						}else{
							jQuery(function(){sweetAlert('', 'Se ha dejado de compartir la foto correctamente!', 'success');});
							actualizarSelect(id);
						}
					}
				}
			xmlhttp.open("GET","DejarCompartirFoto.php?id="+id+"&nombre="+usucom, true); 
			xmlhttp.send();
			
}

function borrarFoto(id){
	var xmlhttp = new XMLHttpRequest();
	var idAlbum= "<?php echo $id;?>";
			xmlhttp.onreadystatechange = function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var respuesta=xmlhttp.responseText;
						if(respuesta=="Error al eliminar la foto"){
							jQuery(function(){sweetAlert('Opss...', 'Error al eliminar la foto!', 'warning');});
						}else if (respuesta=='Error al obtener las fotos'){
							jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos!', 'error');});
						}else if(respuesta=="No tienes ninguna foto en este álbum"){
							jQuery(function(){sweetAlert('Opss...', 'No tienes ninguna foto en este álbum!', 'warning');});
							document.getElementById("albumes").innerHTML="";
						}else{
							jQuery(function(){sweetAlert('', 'Foto borrada correctamente!', 'success');});
							document.getElementById("albumes").innerHTML=respuesta;
						}
					}
				}
			xmlhttp.open("GET","borrarFoto.php?id="+id+"&Album=" + idAlbum, true); 
			xmlhttp.send();
			
}

function verFoto(id){
	clearTimeout(timer);
    status = 0;
	window.open('verFoto.php?id='+id, '_blank');
}

function actualizarSelect(id)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
						document.getElementById("lista").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","actualizarSelectCompartir.php?id="+id); 
			xmlhttp.send();
		}
</script>
</body>

</html>
