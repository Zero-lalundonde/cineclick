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

//FFMPEG PELICULAS Y CORTOMETRAJES

//Threads o Cantidad de nucles disponibles del prosesador
include('../datos/conexion.php');
$th =$coneccion['th'];

//Bitraje Video - en 350k lo tube siempre
$bit = "550k";

//Bitraje Audio
$bita = "110k";

//Idioma para audio-dual
$idioma = "1";

//Tiempo en segundos desde el que iniciará
$tin = "0";

//Conversion a resolucion 720 HD
$HD = "720";

//Directorio peliculas y su tmp
$tmp = "../files/";
$diref = "../peliculas/";

//Nombre de la Pelicula o corto
$titulo = $_POST['titulo2'];
$pelnomf = str_replace(" ", "_", $titulo);
$pelnomf = str_replace(")", "_", $pelnomf);
$pelnomf = str_replace("(", "_", $pelnomf);
$pelnomf = str_replace("'", "_", $pelnomf);
$pelnomf = str_replace("á", "a", $pelnomf);
$pelnomf = str_replace("é", "e", $pelnomf);
$pelnomf = str_replace("í", "i", $pelnomf);
$pelnomf = str_replace("ó", "o", $pelnomf);
$pelnomf = str_replace("ú", "u", $pelnomf);
$pelnomf = str_replace("ü", "u", $pelnomf);
$pelnomf = str_replace("ć", "c", $pelnomf);
$pelnomf = str_replace("ë", "e", $pelnomf);


//nombre del archivo
$files = $_POST['archivo'];
$files2 = str_replace(" ", "_", $files);
$files3 = str_replace(")", "_", $files2);
$files4 = str_replace("(", "_", $files3);
$files5 = str_replace("'", "_", $files4);
$files5 = str_replace("á", "a", $files5);
$files5 = str_replace("é", "e", $files5);
$files5 = str_replace("í", "i", $files5);
$files5 = str_replace("ó", "o", $files5);
$files5 = str_replace("ú", "u", $files5);
$files5 = str_replace("ü", "u", $files5);
$files5 = str_replace("ć", "c", $files5);
$files5 = str_replace("ë", "e", $files5);



//FORMATOS ISO

//Obtener extension
$trozos = explode(".", $files);
$ext = end($trozos);

if ($ext == "iso" OR $ext == "ISO"){

shell_exec("mkdir $tmp$pelnomf");
shell_exec("7z x $tmp$pelnomf.$ext -o$tmp$pelnomf");
chmod("$tmp$pelnomf", 0777);
$VOB = "/VIDEO_TS/VTS_01_[12345].VOB";
shell_exec("cat $tmp$pelnomf$VOB > $tmp$pelnomf.VOB");
shell_exec("ffmpeg -threads $th -i $tmp$pelnomf.VOB -vcodec libx264 -vb $bit -maxrate $bit -bufsize 1000k -s hd720 -acodec libfaac -ab $bita -ac 2 $diref$pelnomf.mp4");
shell_exec("rm -Rf $tmp$pelnomf");
shell_exec("rm -Rf $tmp$pelnomf.VOB");


}else{

//Formatos tradicionales de video


$pelif = "../files/$files5";
$varpel = new ffmpeg_movie($pelif);

//obtener ancho y alto original del video
$ancho = $varpel->getFrameWidth();
$alto = $varpel->getFrameHeight();

//Hz del audio
$hz= $varpel->getAudioSampleRate();

//Framer por segundo
$fps = $varpel->getFrameRate();

//Canales
$canales = $varpel->getAudioChannels();

// Formula para convertir alto equivalente para ancho 720

$calcula = ($HD*$alto)/$ancho;

if ($calcula%2==0){
$altof = "$calcula";
}else{
$altof = ++$calcula;
};

// Fin de Formula


//Resolucion
$x = "x";
if($ancho >= $HD){
$resolucion = "$HD$x$altof";
}else{
$resolucion = "$ancho$x$alto";
};

$resolucion = "hd720";

//Conversion a MP4 streaming
if(!$canales){
shell_exec("ffmpeg -threads $th -i $tmp$files5 -map 0:0 -ss $tin -vcodec libx264 -vb $bit -maxrate $bit -bufsize 1000k -s $resolucion $diref$pelnomf.mp4");
}else{
shell_exec("ffmpeg -threads $th -i $tmp$files5 -map 0:0 -map 0:$idioma -ss $tin -r $fps -vcodec libx264 -vb $bit -maxrate $bit -bufsize 1000k -s $resolucion -acodec libfaac -ab $bita -ac $canales -ar $hz $diref$pelnomf.mp4");
};


}


?>

