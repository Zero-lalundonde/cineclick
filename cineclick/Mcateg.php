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

$Mid = $_GET['Mid'];

$Manime = $_GET['Manime'];
$Mdocu = $_GET['Mdocu'];
$Msubir = $_GET['Msubir'];
$Mesp = $_GET['Mesp'];
$Msubv = $_GET['Msubv'];
$Modificar = "update lista set anime='$Manime', docu='$Mdocu', subir='$Msubir', esp='$Mesp', subv='$Msubv' where id='$Mid'";

if(mysql_query($Modificar, $connect)){

echo "<div id='variascat'>Categoria(s) Seleccionada con exito: </div>";
if($Manime=='1'){$checked1="checked"; echo "<div class='categ'>Anime</div>";}
if($Mdocu=='1'){$checked2="checked"; echo "<div class='categ'>Documental</div>";}
if($Msubir=='1'){$checked3="checked"; echo "<div class='categ'>Subir el Animo</div>";}
if($Mesp=='1'){$checked4="checked"; echo "<div class='categ'>en Español</div>";}
if($Msubv=='1'){$checked5="checked"; echo "<div class='categ'>Subversiva</div>";}

echo "<script>listo()</script>";
//echo "listo";
}else{
echo "Error";
};
?>

