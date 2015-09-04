<?php
//  «Copyright © 2015 Fco. Gamboa Ortiz»
//  This file is part of OpenCineClick.

//  OpenCineClick is free software: you can redistribute it and/or modify
//  it under the terms of the GNU Affero General Public License as published by
//  the Free Software Foundation, either version 3 of the License, or
//  (at your option) any later version.

//  OpenCineClick is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU Affero General Public License for more details.

//  You should have received a copy of the GNU Affero General Public License
//  along with this program.  If not, see <http://www.gnu.org/licenses/>.

///////////////////////////////////////////////////////////////
//  Traduccion al español de esta Licencia
//
//  Este archivo es parte de OpenCineClick.

//  OpenCineClick es un programa libre: puedes redistribuirlo y/o modificar bajo
//  los terminos de la GNU Affero General Public License "Licencia Publica General"
//  publicada por la fundacion Free Software "Programa Libre", ya sea para la version 3
//  de la licencia, o versiones anteriores.

//  OpenCineClick es distribuido con la esperanza de que sea útil,
//  pero SIN NINGUNA GARANTÍA; ni siquiera la garantía implícita de
//  COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR . Vea el
//  Licencia Pública General Affero GNU para más detalles.  

//  Debería haber recibido una copia de la Licencia Pública General Affero GNU
//  Junto con este programa . Si no es así , consulte < http://www.gnu.org/licenses/ > .
//  Por precaución la licencia está copiada completa en dos archivos, 
//  uno llamado COPYING y otro llamado LICENCIA

$seccion = "Subir-Pelicula/Corto";
include('include-ip.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Subir</title>
<meta charset="utf-8">

<!-- Icono -->
<link rel="shortcut icon" href="icono.ico" />

<!-- Jquery  -->
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>

<!-- Comentario Foro -->
<link rel="stylesheet" href="include-comentario.css">

<!-- CSS seccion subir -->
<link rel="stylesheet" href="subir.css">

<script>
function subtitulos(){
$("#subti").css("display", "block");
}
</script>

<script>
$(document).ready(function(){
$("#ser").click(function(evento){
evento.preventDefault();
$("#destino").load("nserp.html");
$("#ser").css("border", "solid 2px rgba(113, 4, 4, 1)");
$("#ser").css("background", "rgba(207, 7, 7, 1)");
$("#cap").css("border", "solid 1px #276D90");
$("#cap").css("background", "#777");
});
})
</script>

<script>
$(document).ready(function(){
$("#cap").click(function(evento){
evento.preventDefault();
$("#destino").load("capp.html");
$("#cap").css("border", "solid 2px #276D90");
$("#cap").css("background", "#3798C8");
$("#ser").css("border", "solid 1px #276D90");
$("#ser").css("background", "#777");
});
})
</script>

<script>
function ffmpeg(){
$.ajax({
url : 'ffsubp.php',
type: 'POST',
data : { titulo2: $('input:text[name=ns]').val(), archivo: $('#arar').val() }
}).done( function( data )
             {
alert( "Ya puedes ver a pelicula!!" );
});
}
</script>

<script>
var statSend = false;
function checkSubmit() {
if (!statSend) {
statSend = true;
return true;
} else {
alert("Porfa, paciencia que ya empezó");
return false;
}
}
</script>
	
<script>
function PorDefecto(){
$("#destino").load("capp.html");
$("#cap").css("border", "solid 2px #276D90");
$("#cap").css("background", "#3798C8");
$("#ser").css("border", "solid 1px #276D90");
$("#ser").css("background", "#777");
}
</script>

<script>
function checkSubmit() {
document.getElementById("submit").value = "Enviando...";
document.getElementById("submit").disabled = true;
return true;
}
</script>

</head>
<body language=JavaScript onLoad="PorDefecto()">
<h1>Sube tus películas</h1>
<form action="uploadp.php" method="post" enctype="multipart/form-data" name="fform" onsubmit="return checkSubmit();">
<a class="serdib" href="#" id="cap">Subir Pelicula</a>
<a class="serdib" href="#" id="ser" style="Xdisplay:none">Subir Cortometraje</a>
<div id="destino">
</div>
<div id="status"></div>
</form>
<div class="progress">
<div class="bar"></div >
<div class="percent">0%</div >
</div>
 
<script>
(function() {
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
$('form').ajaxForm({
beforeSend: function() {
status.empty();
var percentVal = '0%';
bar.width(percentVal)
percent.html(percentVal);
},
uploadProgress: function(event, position, total, percentComplete) {
var percentVal = percentComplete + '%';
bar.width(percentVal)
percent.html(percentVal);
//console.log(percentVal, position, total);
},
success: function() {
var percentVal = '100%';
bar.width(percentVal)
percent.html(percentVal);
},
complete: function(xhr) {
status.html(xhr.responseText);
ffmpeg();
}
}); 
})();       
</script>

<div id="miclasi"></div>
</body>
</html>





