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

include('ultima');
$cual2 = str_replace(" ", "_", $cual);
$seccion = "Dibujitos";
include('include-ip.php');
?>
<html>
<head>
<title>Dibujitos Animados</title>
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

<style>
body{font-family: arial;margin-top:30px;color:#D71F1F;background-color:#E5E5E5;font-size:12px;padding-bottom:150px;}
.muestra{width:100px;height:150px;margin-bottom:25px;position:relative;margin-left:5%;display:inline-block;box-sizing: border-box;border-radius:15px;}
.muestra:hover{left:2px;top:2px;}
#armar{width:200px;height:auto;border-radius:10px;padding:5px;border:solid 1px #D74D4D;background:#D74D4D;color:#FFF;float:right;right:200px;position:relative;}
a:link { text-decoration: none; }
.contiene{position:fixed;bottom:10px;right:300px;}
hr{width:80%;}
#secciontitulo{margin-left:5%;font-size:40px;margin-bottom:10px;}
#numser{margin-left:10px;font-size:20px;margin-bottom:10px;}
#ultiser{background:#FFF;height:120px;padding:0;width:300px;border:solid 2px #CCC;margin: 0px auto 50px auto;position:relative;border-top-right-radius:10px;border-bottom-right-radius:10px;}
#ultisertxt{font-weight:bold;width:150px;float:right;postition;absolute;text-align:center;padding-top:10px;}
#ultisernue{font-size:22px;color:#2C4AAA;}
#ultiserimg{float:left;position:relative;background-image:url(../dibujitos/imagen/mini/<?php echo $cual2 ?>.jpg);background-size: 100% 100%;width:150px;height:120px;border:solid 0px #000;}
#ultisernum{font-size:17px;color:#347C17;border:solid 2px #777;padding:3px;border-radius:20px;padding-right:4px;}
#ultiserspan1{font-size:15px;}
#ultiserspan2{font-size:12px;color:#A4A4A4;}

@media screen and (max-width: 480px){
.contiene{right:10px;display:none;}
#armar{display:none;}
}
</style>

</head>
<body>
<a href="../jwplayer/capitulo.php"> <div id="armar" align="center"><strong>Crea tu lista de reprduccion</strong></div></a>
<?php
$sql = "SELECT sd FROM series where sd = 0";
$result = mysql_query($sql);
$row_cnt = mysql_num_rows($result);
echo "<p id='secciontitulo'>Dibujitos Animados<span id='numser'>(Vamos en $row_cnt)</span></p>";
?>

<hr style="margin-bottom:20px;">

<?php
//Ultima serie Subida

if($ultisd == '3'){ $Nuevo = "Nuevo Audio";};
if($ultisd == '1'){ $Nuevo = "Nueva Serie";};
if($ultisd == '0'){ $Nuevo = "Nuevo Dibujo";};


echo "<div id='ultiser'><div id='ultisertxt'><span id='ultisernue'>$Nuevo</span><hr>";
echo "<span id='ultiserspan1'>$cual</span><br><span id='ultiserspan2'>Capitulo Nro. <span id='ultisernum'>$cuanto </span></span>";
echo "</div>";
echo "<a><div id='ultiserimg'></div></a></div>";
?>

<?php
$sql = "SELECT id, serie, directorio, numerocap FROM series where sd = 0 ORDER BY id DESC";
$result = mysql_query($sql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result)) {
$idd = $row['id'];
$serie = $row['serie'];
$numerocap = $row['numerocap'];
$directorio = $row['directorio'];
echo "<a href='reproducir.php?id=$idd'>";
echo "<div class='muestra' align='center' style='background-image:url(../dibujitos/imagen/mini/$directorio.jpg);background-size: contain;padding-top:5px;'>";
echo "<p style='position:absolute;bottom:0px;height:auto;opacity:0.8;background-color:#4B1C1C;color:#FFF;padding-bottom:5px;padding-right:2px;padding-left:2px;padding-top:5px;margin-top:0px;border:solid 1px #FFF;'>$serie</p>";
echo "<p style='position:absolute;bottom:-10px;opacity:0.85;background:#218004;color:#FFF;padding-left:5px;padding-right:5px;width:90px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;font-size:10px'><strong>$numerocap capitulos</strong></p>";
echo "</div>";
echo "</a>";
}
?>

<?php
$idsa = rand(1, $ids);
$sql2 = "SELECT * FROM series where sd=0 ORDER BY rand(" . time() . " * " . time() . ") LIMIT 1";
$result2 = mysql_query($sql2, $connect) or die (mysql_error());
$rows = mysql_fetch_array($result2);
$exrr = $rows['exten'];$serr = $rows['serie'];$dirr = $rows['directorio'];$nurr = $rows['numerocap'];$verr = rand(1, $nurr);

if(!$dirr){
$dirr="../../peliculas/";
$verr="cuenta";
$exrr="mp4";
}
?>

<div class="contiene">
<div id="reprodu"></div>
</div>

<script>
jwplayer("reprodu").setup({
primary:"flash",
width: 240,
height: 150,
provider: "http",
"startparam": "start",
smoothing: "false",
autostart: "true",
stretching: "exactfit",
playlist: [
{sources: [{ file: '/dibujitos/<?php echo "$dirr/$verr.$exrr"; ?>',}]},
]
});
</script>

<?php
if (!$sql2){}else{unset($exrr);unset($serr);unset($dirr);unset($nurr);unset($verr);unset($sql2);unset($result2);unset($rows);};

?>

</body>
</html>









