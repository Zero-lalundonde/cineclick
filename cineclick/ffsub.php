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

function array_recibe($array) {
     $tmp = stripslashes($array);
     $tmp = urldecode($tmp);
     $tmp = unserialize($tmp);

    return $tmp;
}

$array = $_POST['titulo1'];
$array=array_recibe($array);

//Threads o Cantidad de nucles disponibles del prosesador
include('../datos/conexion.php');
$th =$coneccion['th'];

//Directorio dibujitos
$dired = "../dibujitos/";
$tmp = "tmp/";

// cap = agregar capitulo
// nues = nueva serie
$vv = $_POST['nn'];

//solo identifica si se agrega un capitulo o es una nueva serie
//sepuede borrar
if ($vv == 'cap'){$vvf = 'Capitulo Agregado';};
if ($vv == 'nues'){$vvf = 'Serie Nueva';};


//Dibujito elejido con <select>
$titu1 = $array[0];
//$titu1 = $_POST['titulo1'];
$dire1 = str_replace(" ", "_", $titu1);


//Nombre de nueva serie
$titu2 = $_POST['titulo2'];
$dire2 = str_replace(" ", "_", $titu2);
$dire2 = str_replace(")", "_", $dire2);
$dire2 = str_replace("(", "_", $dire2);

if($vv == 'nues'){
$dire = $dire2;
}elseif($vv == 'cap'){
$dire = $dire1;
}

//CANTIDAD DE CAPITULOS
$epi2 = $array[2];
$epi = ++$epi2;

//numero de capitulo
//$epi = $_POST['epi'];

//nombre del archivo
$files = $_POST['archivo'];
$files2 = str_replace(" ", "_", $files);
$files3 = str_replace(")", "_", $files2);
$files4 = str_replace("(", "_", $files3);

$files4 = str_replace("\'", "_", $files4);
$files4 = str_replace("á", "a", $files4);
$files4 = str_replace("é", "e", $files4);
$files4 = str_replace("í", "i", $files4);
$files4 = str_replace("ó", "o", $files4);
$files4 = str_replace("ú", "u", $files4);
$files4 = str_replace("ü", "u", $files4);

//el mismo nombre de archivo con el que se guardo el archivo con upload.php
$final = str_replace("\'", "_", $files4);


//echo "$vvf, dire = $dire, epi = $epi, file = $final";

//Idioma
$idioma = "1";

//Tiempo en que segundo empieza el video
$tin = "0";

//Resolucion
$resolucion = "640x480";

//Bitraje video
//$bit = "300k";
$bit = "450k";

//Bitraje audio
$bita = "100k"; 

shell_exec("ffmpeg -threads $th -i $dired$dire/$tmp$final -map 0:0 -map 0:$idioma -ss $tin -vcodec libx264 -vb $bit -maxrate $bit -minrate $bit -bufsize $bit -s $resolucion -acodec libfaac -ab $bita -ac 2 $dired$dire/$epi.mp4");
?>

