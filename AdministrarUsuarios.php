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
		<?php
			session_start();
			if(!isset($_SESSION['usuario']) || $_SESSION['usuario']!="admin"){
				echo $_SESSION['usuario'];
				echo '<script>swal({ title: "Opss...", text: "No has iniciado sesión correctamente",type: "warning"}, function() {
				            window.location = "home.php";});</script>';			
			}else{
	    		 include 'menuLoginAdmin.php';
	    		 $usuario=$_SESSION['usuario'];
			}
		?>
	</div>
	<div id="content">
		<?php
		include 'conexionBD.php';
		$sql="SELECT * FROM Usuarios WHERE validado='false'";
		$usuarios=mysqli_query($mysqli ,$sql);
		if (!$usuarios)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener los usuarios', 'error');});</script>");
		}
	?>
	
	<div class="admin-page">
		<div class="form" id="formulario">
			<form>
				<select id="usuario" name="usuario" onChange="tipoUsuarioSeleccionado()" >
					<option value="pendientes" selected="selected">- Pendientes de aceptar -</option>'
					<option value="aceptados">- Aceptados -</option>'
				</select>
				<div id="select">
				<select id="validar" name="validar" onChange="usuarioSeleccionado()" >
				<?php
				echo '<option value="" selected="selected">- Selecciona un usuario -</option>';
					while ($row = mysqli_fetch_array($usuarios)) {
						echo'<option value="'. $row['usuario'] .'">'.$row['usuario'].'</option>';
					}
				echo '</select>';
			echo '</form>';
			?>
			<div id="formModificarPregunta">
			<h3>Información del usuario seleccionado:</h3>
			<form id="formulario">
			  Email:<br>
			  <input type="text" name="autor" id="autor" size="35" readonly>
			  <br><br>
			  Nombre:<br>
			  <input type="text" name="nombre" id="nombre" size="35" readonly>
			  <br><br>
			  Apellidos:<br>
			  <input type="text" name="apellido" id="apellido" size="35" readonly>
			  <br><br>
			  Usuario:<br>
			  <input type="text" name="usuario" id="usuario" size="35" readonly>
			  </form>
			  <form>  
				<input type ="button" value ="Aceptar Usuario" onclick ="aceptarUsuario()">  
				<input type ="button" value ="Rechazar Usuario" onclick ="rechazarUsuario()">  
			  </form> 
			  	</div>
			 </div>
			 </div>
			  <br>
		</div>
		</div>
</body>
</html>
<script language="javascript">

	function usuarioSeleccionado()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("formModificarPregunta").innerHTML = xmlhttp.responseText;
				}
			}
			
			var lista = document.getElementById("validar");
			// Obtener el valor de la opción seleccionada
			var valorSeleccionado = lista.options[lista.selectedIndex].value;
			xmlhttp.open("GET","obtenerUsuario.php?id="+valorSeleccionado); 
			xmlhttp.send();
		}
		
	function tipoUsuarioSeleccionado()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("formulario").innerHTML = xmlhttp.responseText;
				}
			}
			
			var lista = document.getElementById("usuario");
			// Obtener el valor de la opción seleccionada
			var valorSeleccionado = lista.options[lista.selectedIndex].value;
			xmlhttp.open("GET","obtenerTipoUsuario.php?id="+valorSeleccionado); 
			xmlhttp.send();
		}
		
	function aceptarUsuario()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var respuesta= xmlhttp.responseText;
					if(respuesta=="Usuario validado correctamente!"){
						jQuery(function(){sweetAlert('', 'Usuario validado correctamente!', 'success');});
					}else{
						jQuery(function(){sweetAlert('Opss...', 'Error al validar al usuario!', 'error');});
					}
					 actualizarSelect();
				}
			}
			
			var lista = document.getElementById("validar");
			// Obtener el valor de la opción seleccionada
			var valorSeleccionado = lista.options[lista.selectedIndex].value;
			if (valorSeleccionado==""){
					jQuery(function(){sweetAlert('Opss...', 'Selecciona un usuario!', 'warning');});
					return;
			}
			xmlhttp.open("GET","aceptarUsuario.php?id="+valorSeleccionado); 
			xmlhttp.send();
		}
		
	function rechazarUsuario()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var respuesta= xmlhttp.responseText;
					if(respuesta=="Usuario validado correctamente!"){
						jQuery(function(){sweetAlert('', 'Usuario rechazado correctamente!', 'success');});
					}else if(respuesta=="Usuario expulsado correctamente!"){
						jQuery(function(){sweetAlert('', 'Usuario expulsado correctamente!', 'success');});
					}else{
						jQuery(function(){sweetAlert('Opss...', 'Error al rechazar al usuario!', 'error');});
					}
					tipoUsuarioSeleccionado();
				}
			}
			
			var lista = document.getElementById("validar");
			// Obtener el valor de la opción seleccionada
			var valorSeleccionado = lista.options[lista.selectedIndex].value;
			if (valorSeleccionado==""){
					jQuery(function(){sweetAlert('Opss...', 'Selecciona un usuario!', 'warning');});
					return;
			}
			xmlhttp.open("GET","rechazarUsuario.php?id="+valorSeleccionado); 
			xmlhttp.send();
		}

function actualizarSelect()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
						document.getElementById("select").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","actualizarSelect.php"); 
			xmlhttp.send();
		}
		
function actualizarSelectTodos()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
						document.getElementById("formulario").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","actualizarSelectTodos.php"); 
			xmlhttp.send();
		}
	
</script>