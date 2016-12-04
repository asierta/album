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
		<title>Registro</title>
	</head>
<body>
 <div class="register-page" >
 	 <div class="alert" id="alert">
  		<span class="closebtn" onclick="this.parentElement.style.visibility='hidden';">&times;</span>
  				<div id="error">This is an alert box.</div>
	</div>
 	<div class="form">
 		<h1>Registro</h1>
 		<form id="registro" action="Registro.php"   method="post" onSubmit="return verificar()">
 			E-mail:<input type="email" title="Introduce un correo válido"placeholder="Email" required id="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email"/>
 			Nombre: <input type="text" title="Introduce tu nombre" placeholder="Nombre" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" name="nombre" required id="nombre" />
 			Apellidos: <input type="text" title="Introduce apellidos" placeholder="Apellidos" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" name="apellidos" required id="apellidos" />
   			Usuario  : <input type="text" title="El nombre de usuario debe tener entre 4 y 8 caracteres en minuscula" placeholder="Nombre de usuario" pattern="^[a-z0-9ü][a-z0-9ü_]{3,9}$" required id="usuario" name="usuario" />              
			Contraseña: <input type="password" title="Entre 6 y 15 caracteres, con mayusculas, minusculas y caracteres numericos" placeholder="Contraseña" required id="pass" name="pass" size="21" value=""  pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$"/>
			Repetir Contraseña: <input type="password" placeholder="Repetir contraseña"  title="Entre 6 y 15 caracteres, con mayusculas, minusculas y caracteres numericos" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$" required id="pass2" name="pass2" />
			<input id="input" type="submit" value="Registrar"/>
		</form>
	<p class="message">¿Ya tienes una cuenta? <a href="Login.php">Iniciar sesión</a></p>
	</div>
 </div>
</body>
</html>
<?php
	if(isset($_POST['email'])&&isset($_POST['nombre'])&&isset($_POST['apellidos'])&&isset($_POST['usuario'])&&isset($_POST['pass'])&&isset($_POST['pass2'])){ 
		if (!preg_match("^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$^", $_POST['email']))
		{
			 echo "<script>jQuery(function(){sweetAlert('', 'Email introducido incorrecto!', 'warning');});</script>";
		}else if(!preg_match("^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$^", $_POST['nombre']))
		{
			echo "<script>jQuery(function(){sweetAlert('', 'Nombre introducido incorrecto!', 'warning');});</script>";
		}else if(!preg_match("^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$^", $_POST['apellidos']))
		{
			echo "<script>jQuery(function(){sweetAlert('', 'Apellidos introducidos incorrectos!', 'warning');});</script>";
		}else if(!preg_match("^[a-z0-9ü][a-z0-9ü_]{3,9}$^", $_POST['usuario']))
		{
			echo "<script>jQuery(function(){sweetAlert('', 'Nombre de usuario incorrecto!', 'warning');});</script>";				
		}else if(!preg_match("^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$^", $_POST['pass']))
		{
			echo "<script>jQuery(function(){sweetAlert('', 'Contraseña incorrecta!', 'warning');});</script>";				
		}else if(!preg_match("^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$^", $_POST['pass2']))
		{
			echo "<script>jQuery(function(){sweetAlert('', 'La contraseña repetida no es correcta!', 'warning');});</script>";				
		}else if($_POST['pass']!=$_POST['pass2']){
			echo "<script>jQuery(function(){sweetAlert('', 'Las contraseñas no coinciden!', 'warning');});</script>";	
		}else{
			$servername = getenv('IP');
			$username = getenv('C9_USER');
			$password = "";
			$dbport = 3306;
		    // Create connection
		    $mysqli = new mysqli($servername, $username, $password, "album", $dbport);
		    $sql="INSERT INTO Usuarios VALUES ('$_POST[email]','$_POST[nombre]','$_POST[apellidos]','$_POST[usuario]','$_POST[pass]', '0')";
			if (!mysqli_query($mysqli ,$sql))
			{
				//$error=mysqli_error($mysqli);
				die("<script>jQuery(function(){sweetAlert('Opss...', 'Error en el registro', 'error');});</script>");
			}
			echo "<script>jQuery(function(){sweetAlert('Enhorabuena', 'Te has registrado correctamente!', 'success');});</script>";	
		}
	
	}
?>