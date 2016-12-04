function verificar(){ 
	var alert = document.getElementById ( "alert" ) ;
	var error = document.getElementById ( "error" ) ;
	valor = document.getElementById("email").value;
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
		error.innerHTML="Introduce un email";
    	alert.style.visibility = "visible" ;
		return false;
	}
	
	valor = document.getElementById("nombre").value;
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
		error.innerHTML="Introduce Nombre y apellidos";
    	alert.style.visibility = "visible" ;
		return false;
	}
	valor = document.getElementById("usuario").value;
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
		error.innerHTML="Introduce un nombre de usuario";
    	alert.style.visibility = "visible" ;
		return false;
	}
	
	valor = document.getElementById("pass").value;
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
		error.innerHTML="Introduce una contraseña";
    	alert.style.visibility = "visible" ;
		return false;
	}
	
	valor = document.getElementById("pass2").value;
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
		error.innerHTML="Repite la contraseña";
    	alert.style.visibility = "visible" ;
		return false;
	}
	var pass1 = document.getElementById("pass").value;
	var pass2 = document.getElementById("pass2").value;
	if(pass1!=pass2){
		error.innerHTML="Las contraseñas no coinciden";
    	alert.style.visibility = "visible" ;
		return false;
	}
	return verificarEmail();
}

function verificarEmail() {
	var valor = document.getElementById("email").value;
	if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(valor)){
		return verificarNApellidos();
  } else {
  	var alert = document.getElementById ( "alert" ) ;
	var error = document.getElementById ( "error" ) ;
	error.innerHTML="La dirección de email es incorrecta";
    alert.style.visibility = "visible" ;
    return false;
  }
}

function verificarNApellidos() {
	var valor = document.getElementById("nombre").value;
	if (/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/.test(valor)){
		return verificarUsuario();
  } else {
  	var alert = document.getElementById ( "alert" ) ;
	var error = document.getElementById ( "error" ) ;
	error.innerHTML="Introduce nombre y apellidos";
    alert.style.visibility = "visible" ;
    return false;
  }
}

function verificarUsuario() {
	var valor = document.getElementById("usuario").value;
	if (/^[a-z0-9ü][a-z0-9ü_]{3,9}$/.test(valor)){
		return verificarContrasena();
  } else {
  	var alert = document.getElementById ( "alert" ) ;
	var error = document.getElementById ( "error" ) ;
	error.innerHTML="Introduce un nombre de usuario válido";
    alert.style.visibility = "visible" ;
    return false;
  }
}

function verificarContrasena() {
	var valor = document.getElementById("pass").value;
	if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/.test(valor)){
		return true;
  } else {
  	var alert = document.getElementById ( "alert" ) ;
	var error = document.getElementById ( "error" ) ;
	error.innerHTML="Introduce un nombre de usuario válido";
    alert.style.visibility = "visible" ;
    return false;
  }
}
 