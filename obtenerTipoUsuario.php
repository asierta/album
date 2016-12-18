<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    if($id=="pendientes"){
    	$sql="SELECT * FROM Usuarios WHERE validado='false'";
		$usuarios=mysqli_query($mysqli ,$sql);
		if (!$usuarios)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener los usuarios', 'error');});</script>");
		}
		?>
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
	<?php
    	
    }else{
    	$usuarios = mysqli_query($mysqli, "SELECT * FROM Usuarios Where usuario!='admin' AND validado='1'");
    	if (!$usuarios) {
        	echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        	exit;
    	}
	?>
	
		<form>
				<select id="usuario" name="usuario" onChange="tipoUsuarioSeleccionado()" >
					<option value="pendientes" >- Pendientes de aceptar -</option>'
					<option value="aceptados" selected="selected">- Aceptados -</option>'
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
				<input type ="button" value ="Suprimir Usuario" onclick ="rechazarUsuario()">  
			  </form> 
			  	</div>
			 </div>
    	
    <?php	
    }
    ?>
    
