<?php
session_start();
if(!isset($_SESSION['usuario']) ){
     die( '<script>swal({ title: "Opss...", text: "No has iniciado sesión correctamente",type: "warning"}, function() {
            window.location = "home.php";});</script>');
}else if($_SESSION['usuario']=="admin"){
     include 'menuLoginAdmin.php';
     $usuario=$_SESSION['usuario'];
}else{
     include 'menuLogin.php';
     $usuario=$_SESSION['usuario'];
}
?>