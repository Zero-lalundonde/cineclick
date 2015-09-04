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
$alias=$_GET['alias'];
$guarec=$_GET['guarec'];
$Ncap=$_GET['Ncap'];
$Ndura=$_GET['Ndura'];
$Ndura=round($Ndura);

if(!$alias){ echo "<script>alert('Se te olvido escribir tu Alias')</script>";
}else{

//Recordar Capitulo
if($guarec==0){
$consulta = "select serie, cap, dura from actual where serie = '$id' and alias = '$alias'";
$resp=mysql_query($consulta, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($resp)) {
$seriedb = $row['serie'];
$capdb = $row['cap'];
$segdb = $row['dura'];
}

if(!$capdb) echo "Aun no haz guardado tu posision actual";

$capr = $capdb -1;
echo "<script>jwplayer('reproductor').playlistItem($capr);</script>";
echo "<script>setTimeout (\"jwplayer('reproductor').seek($segdb);\", 1000);</script>";
}elseif($guarec==1){
//Guardar Capitulo

$consulta = "select * from actual where serie = '$id' and alias = '$alias'";
$resp=mysql_query($consulta, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($resp)) {
$aliasdb = $row['alias'];
$Vcap = $row['cap'];
$duradb = $row['dura'];
$seriedb = $row['serie'];

}

if(!$aliasdb){
//Insertar registro Nuevo Alias

$insertar = "INSERT INTO actual (serie, cap, alias, dura) VALUES ('$id', '$Ncap', '$alias', '$Ndura')";
if(mysql_query($insertar)){
echo "$alias guardaste tu posision en el capitulo $Ncap";
}else{
echo "No se guardo, vuelve a intentar";
}
}else{
//Actualizar nuevo capitulo

$actualizar = "update actual set cap='$Ncap' where alias='$alias' AND serie='$id'";
mysql_query($actualizar);
$actualizar = "update actual set  dura='$Ndura' where alias='$alias' AND serie='$id'";
mysql_query($actualizar);
echo "$alias Actualizaste tu posision en el capitulo $Ncap";
}
//Tienes registrado un capitulo posterior a este.
if($Ncap < $Vcap) echo "<br><strong>¿Te equivocaste?</strong><a href='deshacer.php?serie=$seriedb&cap=$Vcap&alias=$aliasdb&dura=$duradb'><button id='deshacer'><strong>+</strong> Deshacer</button></a>";

}
}
?>
