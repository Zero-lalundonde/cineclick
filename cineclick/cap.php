<!--   
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
-->
<div class="ar" id="layer">
<input type="hidden" name="sd" value="0">
		<div class="nu2">

Selecciona una serie de la lista:<br>
<?php
include('../datos/conexion.php');
$connect = mysql_connect("localhost" , $coneccion['us'] , $coneccion['contra']);
mysql_select_db("peliculas",$connect);

function array_envia($array) {
     $tmp = serialize($array);
//     $tmp = urlencode($tmp);
     return $tmp;
}



echo "<select id='sel' name='titulo1'>";
//echo "<option>Sin seleccionar</option>";

//$sql = "SELECT id, serie, numerocap FROM series where sd = 0";
$sql = "SELECT id, serie, directorio, numerocap, exten FROM series where sd = 0 ORDER BY id desc";
$result = mysql_query($sql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result)) {
$idb = $row['id'];
$serie = $row['serie'];
$numerocap = $row['numerocap'];
$array = array("$serie", "$idb", "$numerocap");
$array=array_envia($array);
echo "<option value='$array'>$serie</option>";
}
echo " </select><br>";

?>
		</div>

		<div class="nu2">
	Adjunta el episodio a subir:
	 <input type="file" name="archivo[]" class="fil" id="arar">
		</div>
		<div id="nu" style="display:none">
El número del capítulo:
<input type="text" id="te" name="nc" placeholder="1">
<input type="hidden" name="nn" value="cap">
		</div>

<div style="margin-right:5%" align="right"><input type="submit" id="submit" value="Subir"></div>

</div>


