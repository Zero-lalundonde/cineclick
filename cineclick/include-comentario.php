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
<div id="comenta" align="left">
<span id="micomenta">
<?php
echo "<div class='respcom'><div class='rca'>Un@ mas:</div><div class='rct' style='font-size:13px;color:green;'>Este es un espacio autogestionado, sin censura. Es un medio de comunicación fuera de los canones horrendos de ley.<br> Sientete incitad@ a publicar el material que tu capricho defienda.</div></div>";
$listacom = "select * from comenta where serie = '$id' and pel='$pel' order by id asc";
$result2 = mysql_query($listacom, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result2)) {
$rescomalias = $row['alias'];
$rescomtext = $row['texto'];
echo "<div class='respcom'><div class='rca'>$rescomalias:</div><div class='rct'>$rescomtext</div></div>";
};
?>
</span>
<input type="text" name="comalias" id="comalias" placeholder="Alias">
<div align="right" style="display:inline;">
<input  type="button" name="boton07" id="boton07" value="Comentar">
</div>
<textarea name="comtext" id="comtext" placeholder="opino que..."></textarea>
</div></div>
