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

$id=$_GET['id'];
$pel="1";

$actualsql = "SELECT * FROM lista where id=$id";
$resultado = mysql_query($actualsql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($resultado)) {
$archivo= $row['titucom'];
$titulo= $row['titulo'];
$direccion= $row['direccion'];
$anio= $row['fecha'];
$reparto= $row['actuacion'];
$guion= $row['guion'];
$triler= $row['triler'];
$cat1=$row['anime'];$cat2=$row['docu'];$cat3=$row['subir'];$cat4=$row['esp'];$cat5=$row['subv'];
}

$random = array("anime","docu","subir","esp","subv");
$alea=array_rand($random, 1);
$cat=$random[$alea];
?>
<html>
<head>
<title>Cine en accion...</title>
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

<!-- Votos -->
<link rel="stylesheet" href="include-votos.css">

<style>
body {margin:0;padding:0; width:100%; font-family: arial;}
#scroll{max-width:900px;height:130px;margin:auto auto;padding-bottom: 10px;margin-top:20px;overflow-x: auto; overflow-y: hidden;	}
#scroll a:link{text-decoration:none;color: #fff;}
#prevcontenedor{height: inherit;}
#actual{font-weight:bold;font-size:20px;background: rgba(141, 178, 102, 1);background: rgba(141, 201, 195, 1);color: #fff;box-sizing:border-box;padding:5px;text-align:center;}
#contenedor{max-width:640px;Hheight:380px;margin: 50px auto 50px auto;}
.mini{background:url(negativo.png);background-size: 100% 100%;width: 140px;height: inherit;box-sizing:border-box;float:left;padding-right:0px;}
.minitext{font-weight: bold;font-size: 12px;width: 134px;height: 92px;margin: auto auto;margin-top:0px;box-sizing:border-box;position:relative;opacity:0.8;}
.minitext:hover{opacity:1;}
a:visited{color: #fff;}
.link{position:absolute;bottom:	0px;background:#FFF;opacity:0.6;color: #000;text-align:center;font-size:10px;width:100%;}
#bidiv1{width:70%;float:left;display: inline-block;}
#bidiv2{width:29%;float:right;dislpay: inline-block;}
#datos{width:90%;min-height:500px;background:rgba(46, 92, 245, 0.79);border:solid 1px #000;margin-top:50px;}
.datos{font-size:13px;}
@media (max-width: 920px) {#bidiv2{display:none;}#bidiv1{width:100%;}}
.categ{ display:inline-block; color:#fff; background:rgba(26, 45, 96, 1); border:solid 1px rgba(35, 60, 128, 1); border-radius:3px; padding:5px;margin-left:5px;}
#categ, #Mcateg{color:#fff; background:rgba(78, 124, 34, 1); border:solid 1px rgba(128, 201, 59, 1); border-radius:3px; padding:5px; width:200px; text-align:center;margin: auto auto;}
#categorias{border:solid 1px rgba(42, 119, 152, 1); max-width:640px;margin:0 auto 20px auto;padding:10px;box-sizing:border-box;font-size:12px}
#variascat{font-weight:bold;font-size:13px;margin-bottom:8px;color:rgba(31, 88, 112, 1);}
</style>

<script type="text/javascript">
$(document).ready(function(){
$("#boton07").click(function () {
$.get("comenta.php",{pel: "1", serie: "<?php echo $id?>",comtext: $('textarea[name=comtext]').val(),comalias: $('input:text[name=comalias]').val()},function(respuesta){$("#micomenta").html(respuesta);
});});});
</script>


<script>
function playerCorto(video, titulo, subtitulo) { 
var playerInstance = jwplayer("reproductor");
playerInstance.load([{
file: video,
title: titulo,
tracks: [{
file: subtitulo,
label: "Español",
kind: "captions",
"default": "true",
}],
}]);
playerInstance.pause();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
$("#categ").click(function () {
$("#modificat").css('display','block');
$("#categ").css('display','none');
$(".categ").css('display','none');
$("#variascat").text('Selecciona las categorias');
});});
</script>


<script type="text/javascript">
$(document).ready(function(){
$("#Mcateg").click(function () {
if($("#Manime").is(':checked')) { var Manime1 = "1";  };
if($("#Mdocu").is(':checked')) { var Mdocu1 = "1";  };
if($("#Msubir").is(':checked')) { var Msubir1 = "1";  };
if($("#Mesp").is(':checked')) { var Mesp1 = "1";  };
if($("#Msubv").is(':checked')) { var Msubv1 = "1";  };
$("#modificat").css('display','none');
$("#variascat").css('display','none');

$.get("Mcateg.php",{Mid: "<?php echo $id?>", Manime: + Manime1, Mdocu: + Mdocu1, Msubir: + Msubir1, Mesp: + Mesp1, Msubv: + Msubv1},function(respuesta){$("#actualizado").html(respuesta);
});});});
</script>




</head>
<body>
<!-- Calendario lunas-->
<?php include('include-calendario.php'); ?>

<?php
$alea2=rand(1,15);
$sql = "SELECT * FROM lista where $cat=1 ORDER BY id ASC LIMIT $alea2, 10";
$result = mysql_query($sql, $connect) or die (mysql_error());
$prev = mysql_num_rows($result);	//cantidad de cortos

if($prev == 0)$none="display:none";
echo "<div id='scroll' align='center' style='$none'>";

$anchoprev = $prev *140;		// ancho de prevcontenedor, segun la cantidad de cortos
$px = "px";
echo "<div id='prevcontenedor' style='width:$anchoprev$px'>";

while ($row = mysql_fetch_array($result)) {
$iddb = $row['id'];
$nombredb= $row['titulo'];
$duradb= $row['dura'];
$archivodb= $row['titucom'];

echo "<div class='mini'>";
echo "​<a href=\"javascript:playerCorto('../peliculas/$archivodb.mp4','$nombredb', '../peliculas/$archivodb.srt')\">";
echo "<div class='minitext' style='background:url(../peliculas/$archivodb.jpg);background-size:100% 100%;'><div class='link'>$nombredb</div></div>";
echo "</a>";
echo "</div>"; //cierre mini
}		// fin while
echo "</div>"; // cierre prevcontenedor
?>
<!--  cierre scroll  -->
</div>

<div id="bidiv1">
<div id="contenedor">
<div id="actual"></div>
<div id="reproductor"></div>
</div>

<?php
include('include-votos.php');


echo "<div id='categorias'>";
if(!$cat1 && !$cat2 && !$cat3 && !$cat4 && !$cat5){
echo "<div id='variascat'>¿A que categoria pertenece esta pelicula?, aún nadie la clasifica.</div>";
echo "<div id='categ'>Seleccionar categoría</div>";
}else{
echo "<div id='variascat'>Categoria(s): </div>";
if($cat1=='1'){$checked1="checked"; echo "<div class='categ'>Anime</div>";}
if($cat2=='1'){$checked2="checked"; echo "<div class='categ'>Documental</div>";}
if($cat3=='1'){$checked3="checked"; echo "<div class='categ'>Subir el Animo</div>";}
if($cat4=='1'){$checked4="checked"; echo "<div class='categ'>en Español</div>";}
if($cat5=='1'){$checked5="checked"; echo "<div class='categ'>Subversiva</div>";}
echo "<div id='categ'>Modificar</div>";
}

echo "<div id='modificat' style='display:none;'>";

echo "<input type='checkbox' id='Manime' name='Manime' value='1' $checked1>Anime ";
echo "<input type='checkbox' id='Mdocu' name='Mdocu' value='1' $checked2>Documental ";
echo "<input type='checkbox' id='Msubir' name='Msubir' value='1' $checked3>Subir el Animo ";
echo "<input type='checkbox' id='Mesp' name='Mesp' value='1' $checked4>En Español ";
echo "<input type='checkbox' id='Msubv' name='Msubv' value='1' $checked5>Subversiva ";
echo "<button id='Mcateg' >Actualizar</button>";
echo "</div>";
echo "<div id='actualizado'></div>";


echo "</div>";

?>

<script>
jwplayer("reproductor").setup({
file: "../peliculas/<?php echo $archivo ?>.mp4",
title: "<?php echo $titulo ?>",
width: "100%",
aspectratio: "16:9",
primary:"flash",
provider: "http",
"startparam": "start",
"captions": {
"color": '#FFF',
"fontSize": 22,
"backgroundOpacity": 50
},
tracks: [
{
file: "../peliculas/<?php echo $archivo ?>.srt",
label: "Español",
kind: "captions",
"default": "true",
}],
advertising: {
"client": 'vast',
"skipoffset":1,
"skipmessage":'pelicula',
"skiptext":'pelicula',
schedule: {
adbreak1: {
"offset": "pre",
"tag": "../peliculas/cuenta.xml",
},
adbreak2: {
offset: "post",
tag: "../peliculas/final.xml",
},
}},
});
</script>


<script>
jwplayer().onPlaylistItem( function(event){
document.getElementById("actual").innerHTML = jwplayer().getPlaylistItem().title;
});
</script>


<?php
//Comentarios
include('include-comentario.php');

?>
</div>

<div id="bidiv2">
<div id="datos">
<div style="width:120px;margin:30px auto 0px auto;">
<img style="width:120px" src="../peliculas/<?php echo $archivo?>.jpg">
</div>
<div style="font-size:2em;font-weight:bold;color:#FFF;margin-top:20px;text-align:center;background:rgba(15, 6, 8, 0.48);">
<?php echo $titulo ?>
</div>

<div style="font-size:1em;font-weight:bold;color:#FFF;margin-top:20px;text-align:center;background:rgba(15, 6, 8, 0.48);">
<?php echo "$direccion - $anio" ?>
</div>

<?php 
if(isset($guion)){
echo "<div style='font-size:em;color:#FFF;margin-top:20px;background:rgba(43, 65, 110, 1);padding:5px 5px 5px 10px;'>";
$guion = str_replace(",", "<br>", $guion);
echo "<strong>Guion:</strong><br><span class='datos'>$guion</span>";
echo "</div>";
};

if(isset($reparto)){
echo "<div style='font-size:em;color:#FFF;margin-top:20px;background:rgba(43, 65, 110, 1);padding:5px 5px 5px 10px;'>";
$reparto = str_replace(",", "<br>", $reparto);
echo "<strong>Reparto:</strong><br><span class='datos'>$reparto</span>";
echo "</div>";
};

if(!$triler){}else{
echo "<div style='font-size:em;color:#FFF;margin-top:20px;background:rgba(43, 65, 110, 1);padding:5px 5px 5px 10px;'>";
echo "<strong>Adelanto:</strong><br><span class='datos'>$triler</span>";
echo "</div>";
};

include('include-ip.php');
?>
</div>
</div>

</body>
</html>


