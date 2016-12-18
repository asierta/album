<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    $sql = mysqli_query($mysqli, "SELECT * FROM VisitasFotos WHERE IdFoto='$id' AND Visita='0'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
    $numVisitasFuera=mysqli_num_rows($sql);
	$sql = mysqli_query($mysqli, "SELECT * FROM VisitasFotos WHERE IdFoto='$id' AND Visita='1'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
    $numVisitasDentro=mysqli_num_rows($sql);
	?>
	<h2>Estadísticas foto:</h2>
	 <fieldset>
			 	 <legend><h4>Visitas internas</h4></legend>
			 	 <label><?php echo $numVisitasDentro; ?></label>
	 </fieldset>
	 <fieldset>
			  <legend><h4>Visitas externas</h4></legend>
			  <label><?php echo $numVisitasFuera; ?></label>
	 </fieldset>