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

include('../datos/conexion.php');
$connect = mysql_connect("localhost" , $coneccion['us'] , $coneccion['contra']);
mysql_select_db("peliculas",$connect);

$id= $_GET['id'];
$actualsql = "SELECT * FROM series where id=$id";
$resultado = mysql_query($actualsql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($resultado)) {
$titulo= $row['serie'];
$directorio= $row['directorio'];
$numerocap= $row['numerocap'];
$exten= $row['exten'];
$sd= $row['sd'];
$quien=$row['quien'];
}
include('include-ip.php');
?>
<html>
<head>
<title><?php echo $titulo ?></title>
<meta charset="utf-8">

<!-- Adaptable a moviles -->
<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Icono -->
<link rel="shortcut icon" href="icono.ico" />

<!-- Jwplayer -->
<script type="text/javascript" src="jwplayer/jwplayer.js"></script>
<script type="text/javascript" src="../datos/clave.js"></script>

<!-- Jquery  -->
<script type="text/javascript" src="jquery.js"></script>

<!-- Comentario Foro -->
<link rel="stylesheet" href="include-comentario.css">

<style>
body{margin:0;padding:0;font-family:arial;width:100%;height:100%;background:url('../dibujitos/imagen/<?php echo $directorio ?>.jpg');background-size:100% auto;}
#titulo{background:rgba(0, 0, 0, 0.4);width:100%;color:rgba(250, 250, 250, 0.8);font-size:35px;padding:8px;box-sizing:border-box;text-align:center;}
#contenedor{max-width:820px;margin:20px auto 20px auto;}
#actual{max-width:820px;margin:0 auto 20px auto;min-height:100px;border:solid 1px #000;background:rgba(250, 250, 250, 0.6);padding:10px;box-sizing:border-box;font-size:17px;position:relative;}
#ir{width:55px;padding:4px;font-weight:bold;margin:0px;border-radius:0px;border:solid 1px #888;height:30px;box-sizing:border-box;}
#botonir{width:30px;height:30px;border:solid 1px rgba(215, 40, 40, 0.9);margin-left:-1px;position:absolute;color:rgba(215, 40, 40, 0.9);}
#viendo{font-size:22px;}
#contiene{float:right;pposition:absolute;right:20px;top:20px;font-size:12px;width:60px;background:rgba(0,0,0, 0.6);color:#fff;text-align:center;padding:5px;}
#comenta{max-width:820px;}
#avanzar{width:210px;font-size:15px;background:rgba(0,0,0, 0.6);padding:5px;color:#FFF;}
#alias{margin-top:5px;width:155px;text-align:center;border:solid 1px #888;border-radius:0px;height:30px;box-sizing:border-box;padding:4px;}
#recordarir{margin-top:5px;display:inline;width:30px;height:30px;border-radius:0px;border:solid 1px #888;position:absolute;margin-left:-1px;padding: 4px 4px;color:#FFF;background:rgba(215, 40, 40, 0.9);font-weight:bold;}
#guardar{margin-top:5px;display:block;border-radius:0;border:solid 0px #888;background:rgba(59, 170, 35, 0.9);color:#FFF;ffont-weight:bold;padding:4px;}
#deshacer{border-radius:0px;border:solid 1px #888; background: rgba(75, 97, 244, 0.9);padding:4px;color:#FFF;ddisplay:none;}
#ajaxactual{color:#333;}

@media screen and (max-width: 480px){
#contiene{margin-top:50px;}
}

</style>

<script type="text/javascript">
$(document).ready(function(){
$("#boton07").click(function () {
$.get("comenta.php",{pel: "0", serie: "<?php echo $id?>",comtext: $('textarea[name=comtext]').val(),comalias: $('input:text[name=comalias]').val()},function(respuesta){$("#micomenta").html(respuesta);
});});});
</script>

<script type="text/javascript">
$(document).ready(function(){
$("#recordarir").click(function () {
$.get("actual.php",{guarec: "0", id: "<?php echo $id?>",alias: $('input[name=alias]').val()},function(respuesta){$("#ajaxactual").html(respuesta);
});});});
</script>

<script type="text/javascript">
$(document).ready(function(){
$("#guardar").click(function () {
$.get("actual.php",{Ncap: + jwplayer('reproductor').getPlaylistItem().title, Ndura: + jwplayer('reproductor').getPosition(), guarec: "1", id: "<?php echo $id?>",alias: $('input[name=alias]').val()},function(respuesta){$("#ajaxactual").html(respuesta);
});});});
</script>

<script type="text/javascript">
function justNumbers(e){
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
return /\d/.test(String.fromCharCode(keynum));
}
</script>

<script type="text/javascript">
function ir(){
var ir = $('input[name=ir]').val();
var fir = ir - 1;
jwplayer('reproductor').playlistItem(fir);
}
</script>

</head>
<body>
<div id="titulo"><?php 
if(isset($quien)){
echo "$titulo -	$quien";
}else{
echo "$titulo";
}
?></div>
<div id="contenedor"><div id="reproductor"></div></div>

<div id="actual">
<div id="contiene">cap. <div id="viendo"></div></div>
<div id="avanzar">Avanzar al capitulo <input type="number" placeholder="N°" name="ir" id="ir" onkeypress="return justNumbers(event);">
<button id="botonir" name="bir" onclick="ir()">Ir</button></div>
<div id="recordar">
<input type="search" placeholder="Tu Alias" name="alias" id="alias">
<button id="recordarir">></button>
<button id="guardar"><strong>+ </strong>Guardar posision actual</button>
<div align="center"><span id="ajaxactual"></span></div>
</div>
</div>

<?php
//Jwplayer para Series y Dibujitos
include('jw-s.php');

//Comentarios
include('include-comentario.php');

?>
<script>
jwplayer("reproductor").onPlaylistItem( function(event){
document.getElementById("viendo").innerHTML = jwplayer("reproductor").getPlaylistItem().title;
});
</script>
</body>
</html>
