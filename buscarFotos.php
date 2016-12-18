<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<meta charset="utf-8" /> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Sweet Alert Script -->
		<script src="js/sweetalert.min.js"></script>
		<!-- Sweet Alert Styles -->
		<link href="css/sweetalert.css" rel="stylesheet">
	</head>
<body>
	<div id="nav">
		<?php
		session_start();
		if(isset($_SESSION['usuario']) && $_SESSION['usuario']=="admin"){
			include 'menuLoginAdmin.php';
		}else if(isset($_SESSION['usuario'])){
			include 'menuLogin.php';
		}else{
			include 'menu.php';	
		}
		?>
	</div>
	<div id="content">
		<div class="buscar-page">
			<div class="form">
				<h2>Buscar fotos por etiqueta</h2>
		    <form> 
		   		 Etiqueta:<br>
				 <input type="text" name="etiqueta" id="etiquetaFoto" size="35" required>
			</form>
				<form class="boton">  
					<input type ="button" value ="Buscar Fotos" onClick ="buscarFotos()">  
				</form> 
			 </div>
		 </div>
		  <div id="fotos">
		  </div>
	</div>
</body>
<script type="text/javascript">
		function buscarFotos()
		{
			var id = document.getElementById("etiquetaFoto").value;
			if(id.length==0 || id.trim()=="")
			{
				jQuery(function(){sweetAlert('Opss...', 'Introduce una etiqueta', 'warning');});
			}
			else
			{
				id=id.trim();
				var xmlhttp = new XMLHttpRequest();
		
				xmlhttp.onreadystatechange = function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("fotos").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","obtenerFotosPorEtiqueta.php?etiqueta="+id); 
				xmlhttp.send();
			}
		}
	</script>
</html>