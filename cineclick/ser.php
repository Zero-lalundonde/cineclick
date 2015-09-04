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
$seccion = "Series";
include('include-ip.php');
?>
<html>
<head>
<title>Series</title>
<meta charset="utf-8">

<!-- Adaptable a moviles -->
<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Icono -->
<link rel="shortcut icon" href="icono.ico" />

<style>
h1{margin-left:10px;}
body{font-family: arial;margin-top:25px;font-size:12px;background-color:#E5E5E5;color:#D71F1F;}
.muestra{width:100px;height:150px;margin-bottom:25px;position:relative;margin-left:5%;display:inline-block;box-sizing: border-box;border-radius:15px;}
.muestra:hover{left:2px;top:2px;}
.menu{float:right;border:solid 2px #3B580E;margin-right:5px;padding:7px;color:#3B580E;border-radius:14px;background:#BFE683;}
a:link{text-decoration:none;color:#D71F1F;}
a:visited{text-decoration:none;color:#D71F1F;}
</style>
</head>
<body>
<strong>
<a href="subser.php"> <div class="menu">Subir nueva serie</div> </a>
<a href="dibu.php"> <div class="menu">Anime</div> </a>
<a href="pel.php"> <div class="menu">Peliculas</div> </a>
</strong>
<p style="margin-left:5%;font-size:40px;margin-bottom:5px;">Series</p>
<hr style="margin-bottom:30px;">
<?php

if($ultisd == '3'){ $Nuevo = "Nuevo Audio";};
if($ultisd == '1'){ $Nuevo = "Nueva Serie";};
if($ultisd == '0'){ $Nuevo = "Nuevo Dibujo";};


$cual2 = str_replace(" ", "_", $cual);
echo "<div align='center'>";
echo "<div style='background:#FFF;height:120px;padding:0;width:300px;border:solid 2px #CCC;margin-bottom:50px;position:relative;border-top-right-radius:10px;border-bottom-right-radius:10px;'>";
echo "<div style='font-weight:bold;width:150px;float:right;postition;absolute;text-align:center;padding-top:10px;'>";
echo "<span style='font-size:22px;color:#2C4AAA;'>$Nuevo</span><hr>";
echo "<span style='font-size:15px;'>$cual</span><br>";
echo "<span style='font-size:12px;color:#A4A4A4;'>Capitulo Nro. <span style='font-size:17px;color:#347C17;border:solid 2px #777;padding:3px;border-radius:20px;
padding-right:4px;'>$cuanto </span></span>";
echo "</div>";
echo "<a href='../jwplayer/seriesnodib.php?exten=$exul&numerocap=$cuanto&serie=$cual&ver=$cuanto&directorio=$direul';>";
echo "<div style='float:left;position:relative;background-image:url(../dibujitos/imagen/mini/$cual2.jpg);background-size: 100% 100%;//background-size: contain;width:150px;height:120px;
border:solid 0px #000;'>";
echo "</div>";
echo "</a>";
echo "</div>";
echo "</div>";



$sql = "SELECT id, serie, directorio, numerocap, exten FROM series where sd=1";
$result = mysql_query($sql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result)) {
$idd = $row['id'];
$exten = $row['exten'];
$serie = $row['serie'];
$titulo = str_replace(" ", "_", $serie);
$numerocap = $row['numerocap'];
$directorio = $row['directorio'];
$jpg = ".jpg";
$video = "$titulo$exten";
$porta = "$titulo$jpg";
echo "<a href='reproducir.php?id=$idd'>";
echo "<div class='muestra' align='center' style='background-image:url(../dibujitos/imagen/mini/$porta);background-size: contain;padding-top:5px;'>";
echo "<p style='position:absolute;bottom:0px;height:auto;opacity:0.8;background-color:#4B1C1C;color:#FFF;padding-bottom:5px;padding-right:2px;padding-left:2px;padding-top:5px;margin-top:0px;border:solid 1px #FFF;'>$serie</p>";
echo "</div>";
echo "</a>";
}
?>
</body>
</html>






