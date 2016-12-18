$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
var wrapper = $(".filediv"); //Fields wrapper
var x = 1;
$('#add_more').click(function() {
    x++;
    var str='<div>Imagen '+x+'<br><input name="file[]" required type="file" id="file"/><br>Nombre Foto:<br><input type="text" placeholder="nombre foto" required id="nFoto" name="nFoto[]" />';
    var str2='<br> Etiqueta:<br><input type="text" placeholder="etiqueta" required id="etiqueta" name="etiqueta[]" /><a href="#" class="remove_field">X</a></div>';
    var str3='<fieldset class="privacidad"><legend>Privacidad</legend><label><input type="radio" name="privacidad[]" value="privado" checked="checked">Privada</label>';
    var str4='<label><input type="radio" name="privacidad[]" value="accesoLimitado">Acceso Limitado</label><label><input type="radio" name="privacidad[]" value="publica">Pública</label></fieldset>';
 $(wrapper).append('<div>Imagen '+x+'<br><input name="file[]" required type="file" id="file"/><br>Nombre Foto:<br><input type="text" placeholder="nombre foto" required id="nFoto" name="nFoto[]" /><br> Etiqueta:<br><input type="text" placeholder="etiqueta" required id="etiqueta" name="etiqueta[]" /><a href="#" class="remove_field">X</a></div>');
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});