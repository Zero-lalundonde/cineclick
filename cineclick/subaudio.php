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
<html>
<head>
<meta charset="utf-8">
<title>Subir Audio/Album</title>
<style>

body{
color:#742E2E;
background:;
font-family:arial;
font-size:14px;}

#num{
margin-left:120px;
border:solid 2px #5849FF;
padding:3px;
color:#5849FF;
width:600px;
border-radius:15px;
text-align:left;
padding-left:30px;
box-sizing:border-box;
}

.datit{
display:block;}

.ser{
margin-left:120px;
border:solid 2px #840A0A;
padding:8px;
width:300px;
border-radius:15px;
text-align:center;
box-sizing:border-box;
margin-bottom:20px;}

#env{
margin-top:10px;
background:#FFF;
color:#;
border:solid 2px #5849FF;
border-radius:5px;
width:100px;
color:#256392;
margin-left:200px;
}

#cabe{
background:#FFF;
color:#;
border:solid 2px #5849FF;
border-radius:15px;
width:600px;
padding-top:8px;
padding-bottom:8px;
padding-left:15px;
color:#256392;
margin-left:120px;

}

h1{
margin-left:150px;
}
</style>
</head>
<body>

<h1>Subir Audio Libros o Similares</h1>


<form method="POST" action="ftpaudio.php" enctype="multipart/form-data">
<div id="cabe">
Audio Libro:
<br>
<input type="file" name="archi" >
<br>
<br>
Portada <span style="font-size:12px">(solo .jpg)</span>:<br>
<input type="file" name="port" >
</div>
<br>
<br>
<div id="num" style="padding-bottom:20px;padding-top:10px">
<strong>Titulo del audio:</strong> <input class="datit" style="border:solid 1px #252997;border-radius:5px;width:320px;padding:3px;margin-bottom:10px" placeholder="" type="text" name="capaudio">
<strong>¿
Quien narra esto        
?:</strong> <input class="datit" style="border:solid 1px #252997;border-radius:5px;width:320px;padding:3px;" value="<?php echo "$autoria"; ?>" placeholder="" type="text" name="autoria">
</div>
<br>               
<br>

<div class="ser">
<strong>Selecciona el album al que pertenece: </strong>
<?php
include('../datos/conexion.php');
$connect = mysql_connect("localhost" , $coneccion['us'] , $coneccion['contra']);
mysql_select_db("peliculas",$connect);

echo "<select style='margin-top:5px;border:solid 2px #121D63;border-radius:5px;padding-left:3px;' name='albumviej'>";
echo "<option>Sin seleccionar</option>";

$sql = "SELECT album FROM audio Group By album";
$result = mysql_query($sql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result)) {
$album2 = $row['album'];
$album = str_replace("_", " ", $album2);
echo "<option value='$album'>$album</option>";
}
echo " </select><br>";

?>
<br>


</div>

<div class="ser">
O si es un album nuevo:
<br>
<input style="width:200px;" placeholder="escribe el nombre aquí" type="text" name="albumnue">
<br>
<br>
</div>

<input type="submit" id="env" value="Enviar"> 

<br>
</form>


</body>
</html>

