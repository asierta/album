<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    $sql = mysqli_query($mysqli, "SELECT Nombre, Etiqueta, Album, Privacidad FROM Foto WHERE Id='$id'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
	$foto=mysqli_fetch_row($sql);
	$idAlbum=$foto[2];
	$sql = mysqli_query($mysqli, "SELECT Nombre FROM Album WHERE Id='$idAlbum'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
	$album=mysqli_fetch_row($sql);
	?>
	<h2>Compartir con:</h2>
			 	 <input type="text" placeholder="usuario" pattern="^[a-z0-9ü][a-z0-9ü_]{3,9}$" id="usuario" name="usuario" /><br>
			 	  <form>  
					<input type ="button" value ="Compartir" onClick ="Compartir('<?php echo $id ?>')">  
				  </form>
				  <div id="lista">
					<select id="validar" name="validar">
								<?php
									$sql="SELECT * FROM FotoCompartida WHERE IdFoto='$id'";
									$usuarios=mysqli_query($mysqli ,$sql);
									echo '<option value="" selected="selected">- Compartida con -</option>';
									while ($row = mysqli_fetch_array($usuarios)) {
										echo'<option value="'. $row['Usuario'] .'">'.$row['Usuario'].'</option>';
									}
								echo '</select>';
							?>
				</div>
				<form>  
					<input type ="button" value ="Dejar de Compartir" onClick ="DejarCompartir('<?php echo $id ?>')">  
				  </form>
  	<hr style="color:white;">
	<h2>Ajustes de la foto</h2>
			<form> 
			  Álbum:<br>
			  <input type="text" name="album" id="albumFoto" size="35" readonly required value="<?php echo $album[0]?>">
			  <br>
			  Nombre:<br>
			  <input type="text" name="nombre" id="nombreFoto" size="35"  required value="<?php echo $foto[0]?>">
			  <br>
			  Etiqueta:<br>
			  <input type="text" name="etiqueta" id="etiquetaFoto" size="35" required value="<?php echo $foto[1]?>">
			  
	<?php
	if($foto[3]=="privado"){
	?>
			  <fieldset id="priva">
        			<legend>Privacidad</legend>
        					<label>
								 <input type="radio" name="privacidad" value="privado" checked="checked">Privada
							</label>
							<br>
							<label>
  								<input type="radio" name="privacidad" value="accesoLimitado">Acceso Limitado
  							</label>
  							<label>
  								<input type="radio" name="privacidad" value="publica">Pública
  							</label>
  				</fieldset><br>
  	<?php
	}else if($foto[3]=="accesoLimitado"){
  	?>
  			 <fieldset id="priva">
        			<legend>Privacidad</legend>
        					<label>
								 <input type="radio" name="privacidad" value="privado">Privada
							</label>
							<br>
							<label>
  								<input type="radio" name="privacidad" value="accesoLimitado"  checked="checked">Acceso Limitado
  							</label>
  							<label>
  								<input type="radio" name="privacidad" value="publica">Pública
  							</label>
  				</fieldset><br>
  	<?php
	}else if($foto[3]=="publica"){
  	?>
  			 <fieldset id="priva">
        			<legend>Privacidad</legend>
        					<label>
								 <input type="radio" name="privacidad" value="privado">Privada
							</label>
							<label>
  								<input type="radio" name="privacidad" value="accesoLimitado" >Acceso Limitado
  							</label>
  							<label>
  								<input type="radio" name="privacidad" value="publica" checked="checked">Pública
  							</label>
  				</fieldset><br>
  	<?php
	}
  	?>
			  </form>
			  <?php
			  	if($usuario[4]==0){
			  	?>
				  <form>  
					<input type ="button" value ="Aplicar Cambios" onClick ="aplicarCambios('<?php echo $id ?>')">  
					<input type ="button" value ="Borra foto" onClick ="borrarFoto('<?php echo $id ?>')">  
				  </form> 
			  <?php
			  	}
			  	?>
			  	
			