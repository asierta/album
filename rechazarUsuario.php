<?php
    include 'conexionBD.php';
    $id=$_GET['id'];
    $sql = mysqli_query($mysqli, "SELECT Email, Nombre, Apellidos, Usuario, Validado FROM Usuarios WHERE Usuario='$id'");
    if (!$sql) {
        echo 'No se pudo ejecutar la consulta: ' . mysql_error();
        exit;
    }
	$usuario=mysqli_fetch_row($sql);
	$sql = mysqli_query($mysqli, "DELETE FROM Usuarios WHERE Usuario='$id'");
    if (!$sql) {
       echo "Error al validar al usuario!";
        exit;
    }else{
        if($usuario[4]==1){
            $sql = mysqli_query($mysqli, "DELETE FROM Album WHERE Usuario='$id'");
            if (!$sql) {
                echo "Error al validar al usuario!";
                exit;
            }
            $sql = mysqli_query($mysqli, "DELETE FROM Foto WHERE Usuario='$id'");
            if (!$sql) {
                echo "Error al validar al usuario!";
                exit;
            }
             echo "Usuario expulsado correctamente!";
        }else {
             echo "Usuario validado correctamente!";
        }
    }
?>