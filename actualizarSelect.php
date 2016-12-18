<?php
include 'conexionBD.php';
$sql="SELECT * FROM Usuarios WHERE validado='false'";
$usuarios=mysqli_query($mysqli ,$sql);
?>
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
			  <br>
			  <form>  
				<input type ="button" value ="Aceptar Usuario" onclick ="aceptarUsuario()">  
				<input type ="button" value ="Rechazar Usuario" onclick ="rechazarUsuario()">  
			  </form> 
			  	</div>
			 </div>