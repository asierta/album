<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<meta charset="utf-8" /> 
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Sweet Alert Script -->
		<script src="js/sweetalert.min.js"></script>
		<!-- Sweet Alert Styles -->
		<link href="css/sweetalert.css" rel="stylesheet">
	</head>
<body>
<?php
     session_start(); 
     session_destroy();
     echo '<script>swal({ title: "Adiós", text: "Gracias por su visita",imageUrl: "imagenes/mano.png"}, function() {
                 window.location = "home.php";});</script>';
?>

</body>
</html>