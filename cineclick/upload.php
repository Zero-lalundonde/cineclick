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

// función reconocer utf-8

define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);
function codificacion($texto){
       	
$c = 0;
$ascii = true;
for ($i = 0;$i<strlen($texto);$i++) {
$byte = ord($texto[$i]);
if ($c>0) {
if (($byte>>6) != 0x2) {
return ISO_8859_1;
} else {
$c--;
}
} elseif ($byte&0x80) {
$ascii = false;
if (($byte>>5) == 0x6) {
$c = 1;
} elseif (($byte>>4) == 0xE) {
$c = 2;
} elseif (($byte>>3) == 0x1E) {
$c = 3;
} else {
return ISO_8859_1;
}}}
	
return ($ascii) ? ASCII : UTF_8;
}

// comienza la pagina
function array_recibe($array) {
$tmp = stripslashes($array);
$tmp = urldecode($tmp);
$tmp = unserialize($tmp);
return $tmp;
}

$array = $_POST['titulo1'];
$array=array_recibe($array);

//var_dump($array);

//directorio dibujos
$diredib = "../dibujitos/"; 

//directorio imagenes
$di = "../dibujitos/imagen/";
$min = "mini/";
$tmp = "tmp/";

//directorio subtitulos
$disub = "../dibujitos/sub/";

$tex = "mp4";
$sd = $_POST['sd'];

$titu1 = $array[0];
$idb = $array[1];

//$titu1 = $_POST['titulo1'];
$titu2 = $_POST['ns'];

//CANTIDAD DE CAPITULOS
$epi2 = $array[2];

//$epi = $_POST['nc'];
$vv = $_POST['nn'];

//Audio Libro
$quien = $_POST['quien'];

$dire1 = str_replace(" ", "_", $titu1);
$dire2 = str_replace(" ", "_", $titu2);

//$dire2 = str_replace(" ", "_", $dire2);
$dire2 = str_replace(")", "_", $dire2);
$dire2 = str_replace("(", "_", $dire2);
$dire2 = str_replace("\'", "_", $dire2);

$dire2 = str_replace("á", "a", $dire2);
$dire2 = str_replace("é", "e", $dire2);
$dire2 = str_replace("í", "i", $dire2);
$dire2 = str_replace("ó", "o", $dire2);
$dire2 = str_replace("ú", "u", $dire2);
$dire2 = str_replace("ü", "u", $dire2);

if($vv == 'nues'){
$epi = "1" ;
$dire = $dire2;
shell_exec("mkdir $diredib$dire");
shell_exec("mkdir $diredib$dire/tmp");
}elseif($vv == 'cap'){
$epi = ++$epi2;
$dire = $dire1;
}

//directorio videos
$ddi = "../dibujitos/$dire/"; 


//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    
//obtenemos el archivo a subir
$files = $_FILES['archivo']['name'];
$ext = $_FILES['archivo']['type']; 
$i = 0;
    
//comprobamos si el archivo ha subido
foreach($files as $file)
{
        
$trofiles = explode(".", $files);
$extv = end($trozos);

// VIDEO y AUDIO


if ($ext[$i] == "audio/ogg" OR $ext[$i] == "audio/vnd.wav" OR $ext[$i] == "audio/basic" OR $ext[$i] == "audio/x-aiff" OR $ext[$i] == "audio/x-mpegurl" OR $ext[$i] == "audio/vorbis" OR $ext[$i] == "audio/mpeg" OR $ext[$i] == "video/x-ms-wmv" OR $ext[$i] == "video/avi" OR $ext[$i] == "video/msvideo" OR $ext[$i] == "video/x-msvideo" OR $ext[$i] == "video/x-flv" OR $ext[$i] == "video/mp4" OR $ext[$i] == "video/ogg" OR $ext[$i] == "video/mpeg" OR $ext[$i] == "video/x-matroska" OR $extv == "mp3" OR $extv == "avi" OR $extv == "flv" ){


$files2[$i] = str_replace(" ", "_", $files[$i]);
$files3[$i] = str_replace(")", "_", $files2[$i]);
$files4[$i] = str_replace("(", "_", $files3[$i]);
$files5[$i] = str_replace("\'", "_", $files4[$i]);

$files5[$i] = str_replace("á", "a", $files5[$i]);
$files5[$i] = str_replace("é", "e", $files5[$i]);
$files5[$i] = str_replace("í", "i", $files5[$i]);
$files5[$i] = str_replace("ó", "o", $files5[$i]);
$files5[$i] = str_replace("ú", "u", $files5[$i]);
$files5[$i] = str_replace("ü", "u", $files5[$i]);


if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$ddi.$tmp.$files5[$i])){
	
echo "<div id='rs'>Terminando... faltan unos segundos y listo, bkn que aportes!!!</div>";
shell_exec("echo '<?php' > ultima");
shell_exec("echo '\$cual = \"$titu1$titu2\";' >> ultima");
shell_exec("echo '\$cuanto = \"$epi\";' >> ultima");
shell_exec("echo '\$exul = \"$tex\";' >> ultima");
shell_exec("echo '\$direul = \"$dire\";' >> ultima");
shell_exec("echo '\$ultisd = \"$sd\";' >> ultima");
shell_exec("echo '?>' >> ultima");
echo "<script>ActivarEnviar()</script>";

if($vv == 'nues'){
	
if($sd == '0' || $sd == '1'){
$sql1 = "INSERT INTO series (serie, directorio, numerocap, exten, sd, quien) VALUES ('$titu2', '$dire', '$epi', '$tex', '$sd', null)";
}elseif($sd == '3'){
$sql1 = "INSERT INTO series (serie, directorio, numerocap, exten, sd, quien) VALUES ('$titu2', '$dire', '$epi', '$tex', '$sd', '$quien')";
} 
mysql_query($sql1, $connect);
}elseif($vv == 'cap'){
$sql1 = " UPDATE series SET numerocap='$epi' WHERE id = $idb ";
mysql_query($sql1, $connect);
}
$i++;
}}

// Formato IMAGEN

if ( $ext[$i] == "image/svg+xml" OR $ext[$i] == "image/jpeg" OR $ext[$i] == "image/png" OR $ext[$i] == "image/bmp" OR $ext[$i] == "image/gif")	{
$imagen = $_FILES['archivo']['name'][$i];
$trozos = explode(".", $imagen); 
$extension = end($trozos);  
if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$di.$tmp.$dire.".".$extension)){
shell_exec("ffmpeg -i $di$tmp$dire.$extension -qmax 50 -pix_fmt yuv420p $di$dire.jpg");
shell_exec("ffmpeg -i $di$dire.jpg -qmax 50 -s 100x150 -pix_fmt yuv420p $di$min$dire.jpg");
$i++;
}}

// Formato SUBTIULO
if ( $ext[$i] == "text/plain" OR $ext[$i] == "application/x-subrip" OR  $ext[$i] == "text/x-ssa"){

$subtitul = $_FILES['archivo']['name'][$i];   
$trozos = explode(".", $subtitul);	
$extsub = end($trozos);

if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$disub.$tmp.$dire.$epi.".".$extsub)){

//DESDE AQUI
$filename = "$disub$tmp$dire.$extsub";
$text = file_get_contents($filename);


if (codificacion($text) == 1 OR codificacion($text) == 2){
//SRT UTF-8
if($extsub == "srt"){
shell_exec("cp $disub$tmp$dire.$extsub $disub$dire$epi.$extsub");
}

//ASS UTF-8
if($extsub == "ass"){
shell_exec("./subti.sh $disub$tmp$dire$epi.$extsub $tmp$dire$epi.srt-2");
shell_exec("cp $disub$tmp$dire$epi.srt-2 $disub$dire$epi.srt");
shell_exec("rm -f $disub$tmp$dire$epi.srt-2");
}

}else{
//SRT ISO-8859-1
if($extsub == "srt"){
shell_exec("iconv -f ISO-8859-1  -t UTF-8 '$disub$tmp$dire$epi.$extsub' -o '$disub$dire$epi.$extsub'");
}

//ASS ISO-8859-1
if($extsub == "ass"){
shell_exec("./subti.sh $disub$tmp$dire$epi.$extsub $tmp$dire$epi.srt-2");
shell_exec("iconv -f ISO-8859-1  -t UTF-8 '$disub$tmp$dire$epi.srt-2' -o '$disub$dire$epi.srt'");
shell_exec("rm -f $disub$tmp$dire$epi.srt-2");
}

};

//HASTA AQUI
$i++;
}}}
}else{
throw new Exception("Error Processing Request", 1);   
}

echo "<script>window.location.href=\"subdib.php\";</script>";

?> 
