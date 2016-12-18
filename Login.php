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
		<title>Inicio sesión</title>
	</head>
<body>
		<div id="nav">
		<?php
			session_start();
			if(isset($_SESSION['usuario'])){
				echo '<script>swal({ title: "Opss...", text: "Ya has iniciado sesión",type: "warning"}, function() {
				            window.location = "home.php";});</script>';			
			}else{
	    		 include 'menu.php';
			}
		?>
	</div>
 <div class="login-page">
 	<div class="form">
 		<h1>Iniciar Sesión</h1>
 		<form id="login" action="Login.php" method="post">
   			Usuario: <input type="text" placeholder="usuario" pattern="^[a-z0-9ü][a-z0-9ü_]{3,9}$" required id="usuario" name="usuario" /><br><br>               
			Contraseña: <input type="password" placeholder="contraseña" required id="pass" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$" name="pass" size="21" value="" /><br><br>
			<input id="input" type="submit" value="Iniciar sesión"/>
		</form>
	<p class="message">¿No estás registrado? <a href="Registro.php">Crear una cuenta</a></p>
	</div>
 </div>
</body>
</html>
<?php
	if (isset($_POST['usuario']) && isset($_POST['pass'])){
		include 'conexionBD.php';
		if (!$mysqli){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
		$usuario=$_POST['usuario'];
		$contrasena=$_POST['pass'];
		$usuarios = mysqli_query($mysqli,"select * from Usuarios where usuario='$usuario' and contrasena='$contrasena' and validado='1'"); 
		$cont= mysqli_num_rows($usuarios); 
		if($cont==1){
			//echo "<script>jQuery(function(){sweetAlert('', 'Bienvenido ".$usuario ."!', 'success'),function(){window.location.href = 'Registro.php';}) ;});</script>";
			echo '<script>swal({ title: "", text: "Bienvenido '.$usuario .'!",type: "success"}, function() {
            window.location = "home.php";});</script>';
            session_start();
			$_SESSION['usuario']=$usuario;
		}else{
			echo "<script>jQuery(function(){sweetAlert('Opss...', 'Error en la utenticación!', 'error');});</script>";	
		}
	}
?>