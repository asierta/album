<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    $sql = mysqli_query($mysqli, "SELECT Email, Nombre, Apellidos, Usuario, Validado FROM Usuarios WHERE Usuario='$id'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
	$usuario=mysqli_fetch_row($sql);
	?>
	
	<h3>Información del usuario seleccionado:</h3>
		<form id="formulario">
			  Email:<br>
			  <input type="text" name="autor" id="autor" size="35" value="<?php echo $usuario[0]?>" readonly>
			  <br><br>
			  Nombre:<br>
			  <input type="text" name="nombre" id="nombre" size="35" value="<?php echo $usuario[1]?>" readonly>
			  <br><br>
			  Apellidos:<br>
			  <input type="text" name="apellido" id="apellido" size="35" value="<?php echo $usuario[2]?>" readonly>
			  <br><br>
			  Usuario:<br>
			  <input type="text" name="usuario" id="usuario" size="35" value="<?php echo $usuario[3]?>" readonly>
			  </form>
			  <?php
			  	if($usuario[4]==0){
			  	?>
				  <form>  
					<input type ="button" value ="Aceptar Usuario" onclick ="aceptarUsuario()">  
					<input type ="button" value ="Rechazar Usuario" onclick ="rechazarUsuario()">   
				  </form> 
			  <?php
			  	}else{
			  	?>
			  	<form>  
					<input type ="button" value ="Suprimir Usuario" onclick ="rechazarUsuario()">   
				 </form> 
				 <?php
			  	}
			  	?>
			