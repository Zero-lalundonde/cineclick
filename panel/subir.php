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

function endKey($array){
end($array);
return key($array);
}

//usuario con privilegio solo para SELECT
$usvisita=$coneccion['usvisita'];
$convisita=$coneccion['convisita'];

//usuario con todos los PRIVILEGIOS
$us=$coneccion['us'];
$contra=$coneccion['contra'];

$ulti = endkey($coneccion['urlremoto']);

$i=1;
while ($i <= $ulti){

$conectar_local = mysql_connect("localhost" , $us , $contra);

//Ultimo ID REMOTO registrado
mysql_select_db("peliculas", $conectar_local);
$consulta=mysql_query("SELECT max(remotoid) FROM lista where remoto='$i'");
$max_id = mysql_result($consulta, 0);

//Conectar base de datos pagina remota
$obtener=mysql_connect($coneccion['urlremoto'][$i] , $usvisita , $convisita);
mysql_select_db("peliculas", $obtener);

//Obtener registros de una pagina
$select="SELECT * from lista where remoto is NULL AND id>'$max_id'";
$establecida = mysql_query($select, $obtener) or die (mysql_error());

while ($row = mysql_fetch_array($establecida)){
$remotoiddb = $row['id'];
$titulodb = $row['titulo'];
$fechadb = $row['fecha'];
$titucomdb = $row['titucom'];
$direcciondb = $row['direccion'];
$duradb = $row['dura'];
$actuaciondb = $row['actuacion'];

$animedb = $row['anime'];
$docudb = $row['docu'];
$subirdb = $row['subir'];
$espdb = $row['esp'];
$subvdb = $row['subv'];

//Integra registros remotos a la base de datos local
$actualizar = "INSERT INTO lista (titulo, fecha, titucom, direccion, actuacion, dura, anime, docu, subir, esp, subv, remoto, remotoid) VALUES ('$titulodb', '$fechadb', '$titucomdb', '$direcciondb', '$actuaciondb', '$duradb', '$animedb', '$docudb', '$subirdb', '$espdb', '$subvdb','$i', '$remotoiddb')";
//$actualizar = "INSERT INTO lista (titulo, fecha, titucom, direccion, actuacion, dura, remoto, remotoid) VALUES ('$titulodb', '$fechadb', '$titucomdb', '$direcciondb', '$actuaciondb','$duradb', '$i', '$remotoiddb')";
mysql_query($actualizar, $conectar_local);

}

$i++;
mysql_close($conectar_local); 
}

?>
