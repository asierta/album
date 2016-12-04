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
		<style type="text/css">
		    a.fancybox img {
		        border: none;
		        box-shadow: 0 1px 7px rgba(0,0,0,0.6);
		        -o-transform: scale(1,1); -ms-transform: scale(1,1); -moz-transform: scale(1,1); -webkit-transform: scale(1,1); transform: scale(1,1); -o-transition: all 0.2s ease-in-out; -ms-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out;
		    } 
		    a.fancybox:hover img {
		        position: relative; z-index: 999; -o-transform: scale(1.03,1.03); -ms-transform: scale(1.03,1.03); -moz-transform: scale(1.03,1.03); -webkit-transform: scale(1.03,1.03); transform: scale(1.03,1.03);
		    }
		</style>
	</head>
<body>
	
	<div id="nav">
		<?php include 'sesionIniciada.php';?>
	</div>
	<div id="albumes">
		<?php
		$servername = getenv('IP');
		$username = getenv('C9_USER');
		$password = "";
		$dbport = 3306;
		// Create connection
		$mysqli = new mysqli($servername, $username, $password, "album", $dbport);
		$id=$_GET['id'];
		$sql="SELECT * FROM Foto WHERE Album=$id";
		$resultado=mysqli_query($mysqli ,$sql);
		if (!$resultado)
		{
			die("<script>jQuery(function(){sweetAlert('Opss...', 'Error al obtener las fotos', 'error');});</script>");
		}else{
			if(mysqli_num_rows($resultado)>0){
    			while($row=mysqli_fetch_array($resultado)){
    				echo '<div class="box2">';
    				echo '<a class="fancybox" href="'.$row['Ruta'].'" rel="fancyboxgallery"><img class="fancybox" src="'.$row['Ruta'].'"></a>';
    				echo '</div>';
    			}
			}else{
				die("<script>jQuery(function(){sweetAlert('Opss...', 'Todavía no has creado ningún álbum', 'warning');});</script>");
			}
		}
		?>
		</div>
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
		<script type="text/javascript">
		    $(function($){
		        var addToAll = false;
		        var gallery = true;
		        var titlePosition = 'over';
		        $(addToAll ? 'img' : 'img.fancybox').each(function(){
		            var $this = $(this);
		            var title = $this.attr('title');
		            var src = $this.attr('data-big') || $this.attr('src');
		            var a = $('<a href="#" class="fancybox"></a>').attr('href', src).attr('title', title);
		            $this.wrap(a);
		        });
		        if (gallery)
		            $('a.fancybox').attr('rel', 'fancyboxgallery');
		        $('a.fancybox').fancybox({
		            titlePosition: titlePosition
		        });
		    });
		    $.noConflict();
		</script>
</body>
</html>
<script type="text/javascript">
function borrarAlbum(id, usuario)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var respuesta=xmlhttp.responseText;
						if(respuesta=="Error al eliminar el álbum"){
							jQuery(function(){sweetAlert('Opss...', 'Error al borrar el álbum!', 'error');});
					}else if (respuesta=='Error al obtener tus albumes'){
						jQuery(function(){sweetAlert('Opss...', 'Error al validar al usuario!', 'error');});
					}else if(respuesta=='Todavía no has creado ningún album'){
						jQuery(function(){sweetAlert('Opss...', 'Todavía no has creado ningún álbum!', 'warning');});
					}else{
						jQuery(function(){sweetAlert('', 'Álbum borrado correctamente!', 'success');});
						document.getElementById("albumes").innerHTML = respuesta;
					}
				}
			};
			xmlhttp.open("GET","borrarAlbum.php?id="+id+"&usuario="+usuario); 
			xmlhttp.send();
		}
	
</script>