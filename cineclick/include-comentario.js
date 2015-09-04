$(document).ready(function(){
$("#boton07").click(function () {
$.get("/subpaginas/comenta.php",{pel: "<?php echo $pel?>", serie: "<?php echo $id?>",comtext: $('textarea[name=comtext]').val(),comalias: $('input:text[name=comalias]').val()},function(respuesta){$("#micomenta").html(respuesta);
});});});
