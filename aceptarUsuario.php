<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    $sql = mysqli_query($mysqli, "UPDATE Usuarios SET validado='1' WHERE Usuario='$id'");
    if (!$sql) {
       echo "Error al validar al usuario!";
        exit;
    }else{
        echo "Usuario validado correctamente!";
    }
?>