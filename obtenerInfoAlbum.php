<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
	$sql = mysqli_query($mysqli, "SELECT * FROM Album WHERE Id='$id'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
	$album=mysqli_fetch_row($sql);
	?>
			<form> 
			  Nuevo nombre:<br>
			  <input type="text" name="nombreAlbum" id="nombreAlbum" size="35" required value="<?php echo $album[1]?>">
			  <br><br>
			  </form>
			  <?php
			  	if($usuario[4]==0){
			  	?>
				  <form>  
					<input type ="button" value ="Aplicar Cambios" onClick ="aplicarCambios('<?php echo $id ?>')">  
					<input type ="button" value ="Borrar álbum" onClick ="borrarAlbum('<?php echo $id ?>', '<?php echo $album[3] ?>')"><br/>
				  </form>
				  <div class="boton">
				 	 <button onclick="window.location.href='/anadirFoto.php?id=<?php echo $id; ?>'">Añadir fotos</button>	
				  </div>
				 
				 
				 
			  <?php
			  	}
			  	?>
			  	
			