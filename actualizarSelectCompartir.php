<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    ?>
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