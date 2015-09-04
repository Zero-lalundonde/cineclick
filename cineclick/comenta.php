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

$serie=$_GET['serie'];
$pel2=$_GET['pel'];

if(!$pel2){
$pel="0";
}else{
$pel="1";
}

$comalias=$_GET['comalias'];
$comtext=$_GET['comtext'];

if(!$comalias){
echo "<div style='font-weight:bold;color:#000;text-align:center;margin-bottom:10px;'>No seas cagón(a), escríbe tu alias</div>";
}else{
if(!$comtext){
echo "<div style='font-weight:bold;color:#000;text-align:center;margin-bottom:10px;'>No escribiste ningún comentario jil</div>";
}else{
$sql = "INSERT INTO comenta (serie, alias, texto, pel) VALUES ('$serie', '$comalias', '$comtext', '$pel')";
mysql_query($sql);
};
};

$listacom = "select * from comenta where serie = '$serie' and  pel='$pel' order by id asc";
$result2 = mysql_query($listacom, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result2)) {
$rescomalias = $row['alias'];
$rescomtext = $row['texto'];

echo "<div class='respcom'><div class='rca'>$rescomalias:</div><div class='rct'>$rescomtext</div></div>";
};

if($pel == 1)	{
if (!$comtext || !$comalias){
}else{
echo "<div class='respcom'><div class='rct' style='color:green'>Siiiiiiiii, que bien que participes</div></div>";
};
}
?>






