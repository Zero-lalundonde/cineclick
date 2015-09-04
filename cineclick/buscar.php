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

$seccion = $_GET['seccion'];
$tablaget = $_GET['tablaget'];

if(isset($tablaget)){
include('../datos/conexion.php');
}

$us = $coneccion['us'];
$contra = $coneccion['contra'];

$conectar = mysql_connect("localhost" , $us , $contra);

mysql_select_db("peliculas",$conectar);


$campos = "id, titulo, titucom, fecha, direccion, actuacion, dura, remoto, remotoid";
$where = "WHERE titulo LIKE '%$cadena%' OR direccion LIKE '%$cadena%' OR actuacion LIKE '%$cadena%'";
$orderby = "ORDER BY id desc";
$buscar = "SELECT $campos FROM $tabla $where $orderby";

function mostrar($interno, $nombre, $nomarchivo, $estreno, $directora, $tiempo, $visita, $visitaid, $urlR, $actuacion){
$directoras = $directora;
$http="http://";
$cineclick="/cineclick/";
$urlA=$urlR[$visita];
$jw="jw";
//if(isset($visita)){
if(!$visita){
$interno=$interno;
}else{
$url="$http$urlA$cineclick";
$interno=$visitaid;
}
if(strlen($directora)>= '23')$directora="Vari@s Director@s";
$salida = "
<a href='$url$jw-p.php?id=$interno' class='info'>
<div class='divr' onMouseOver=\"cartel('$interno','$tiempo','$nombre','$directoras','$actuacion','$estreno')\" style='background-image:url(\"$url../peliculas/$nomarchivo.jpg\");background-size:100% 100%;'>
<div class='divt'>$nombre <br><div> $directora - $estreno</div></div>
</div>
</a>
";



return $salida;
}

if(isset($cadena)){
$resultado = mysql_query($buscar, $conectar) or die (mysql_error());
$ancho = mysql_num_rows($resultado) * 200;
echo "<div style='width:$ancho\px;'>";
while ($row = mysql_fetch_array($resultado)) {
//$row= str_replace("\"", " ", $row);
$id = $row['id'];$titulo = $row['titulo'];$titucom = $row['titucom'];$fecha = $row['fecha'];$direccion = $row['direccion'];$dura = $row['dura'];$remoto = $row['remoto'];$remotoid = $row['remotoid'];$actuacion = $row['actuacion'];
$urlremoto=$coneccion['urlremoto'];
$actuacion= str_replace("\"", " ", $actuacion);

echo mostrar($id, $titulo, $titucom, $fecha, $direccion, $dura, $remoto, $remotoid, $urlremoto, $actuacion);

}
echo "</div>";
}


if(isset($seccion)){
$resultado = mysql_query("SELECT $campos FROM $tablaget WHERE $seccion='1' $orderby", $conectar) or die (mysql_error());
$ancho = mysql_num_rows($resultado) * 200;
echo "<div style='width:$ancho\px;'>";
while ($row = mysql_fetch_array($resultado)) {
$id = $row['id'];$titulo = $row['titulo'];$titucom = $row['titucom'];$fecha = $row['fecha'];$direccion = $row['direccion'];$dura = $row['dura'];$remoto = $row['remoto'];$remotoid = $row['remotoid'];$actuacion = $row['actuacion'];
$urlremoto=$coneccion['urlremoto'];
$actuacion= str_replace("\"", " ", $actuacion);

echo mostrar($id, $titulo, $titucom, $fecha, $direccion, $dura, $remoto, $remotoid, $urlremoto, $actuacion);

}
echo "</div>";
echo "<script>$('#scroll').animate( { scrollLeft: '+=1' }, 1);</script>";
echo "<script>$('#scroll').animate( { scrollLeft: '0' }, 2000);</script>";
echo "<script>$('.sw').css('background','#46A527');</script>";
echo "<script>$('#$seccion').css('background','rgba(221, 84, 0, 0.95)');</script>";
}
?>
