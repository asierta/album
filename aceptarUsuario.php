<?php
    $servername = getenv('IP');
	$username = getenv('C9_USER');
	$password = "";
	$dbport = 3306;
	// Create connection
	$mysqli = new mysqli($servername, $username, $password, "album", $dbport);
    $id=$_GET['id'];
    $sql = mysqli_query($mysqli, "UPDATE Usuarios SET validado='1' WHERE Usuario='$id'");
    if (!$sql) {
       echo "Error al validar al usuario!";
        exit;
    }else{
        echo "Usuario validado correctamente!";
    }
?>