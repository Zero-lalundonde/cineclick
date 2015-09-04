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

$id="1";
$pel="1";

$seccion = "Corto";
include('include-ip.php');

?>
<html>
<head>
<title>Cortos</title>
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
body {margin:0;padding:0; width:100%; font-family: arial;}
#titulo{margin-top:40px;text-align:center;font-size:24px;font-weight:bold;color:rgba(215, 90, 26, 0.9);}
#scroll{width:80%;height:130px;margin:auto auto;padding-bottom: 10px;margin-top:20px;overflow-x: auto; overflow-y: hidden;	}
#prevcontenedor{height: inherit;}
#actual{font-weight:bold;font-size:20px;background: rgba(141, 178, 102, 1);background: rgba(141, 201, 195, 1);color: #fff;box-sizing:border-box;padding:5px;text-align:center;}
#contenedor{max-width:640px;Hheight:380px;margin: 50px auto 50px auto;}
.mini{background:url(negativo.png);background-size: 100% 100%;width: 140px;height: inherit;box-sizing:border-box;float:left;padding-right:0px;}
.minitext{font-weight: bold;font-size: 12px;width: 134px;height: 92px;margin: auto auto;margin-top:0px;box-sizing:border-box;position:relative;opacity:0.8;}
.minitext:hover{opacity:1;}
a:link{text-decoration:none;color: #fff;}
a:visited{color: #fff;}
.link{position:absolute;bottom:	0px;background:#FFF;opacity:0.6;color: #000;text-align:center;font-size:10px;width:100%;}
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
        tracks: [
        {
	file: subtitulo,
        label: "Español",
        kind: "captions",
        "default": "true",
        }],

  }]);
playerInstance.play();
}
</script>

</head>
<body>

<div id="titulo">
Cortometrajes
</div>

<div id="scroll">
<?php
$sql = "SELECT * FROM corto ORDER BY id DESC";
$result = mysql_query($sql, $connect) or die (mysql_error());
$prev = mysql_num_rows($result);	//cantidad de cortos
$anchoprev = $prev *140;		// ancho de prevcontenedor, segun la cantidad de cortos
$px = "px";
echo "<div id='prevcontenedor' style='width:$anchoprev$px'>";

while ($row = mysql_fetch_array($result)) {
$iddb = $row['id'];
$nombredb= $row['nombre'];
$duradb= $row['dura'];
$archivodb= $row['archivo'];

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

<div id="contenedor">
<div id="actual"></div>
<div id="reproductor"></div>
</div>

<script>
jwplayer("reproductor").setup({
	file: "../peliculas/cuenta.mp4",
    	title: "No olvides dejar tus comentarios",
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
});
</script>


<script>
jwplayer().onPlaylistItem( function(event){
document.getElementById("actual").innerHTML = jwplayer().getPlaylistItem().title;
});
</script>


<?php
//Comentarios
$id=1;
include('include-comentario.php');

?>

</body>
</html>
