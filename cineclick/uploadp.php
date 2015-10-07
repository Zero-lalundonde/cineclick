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
function codificacion($texto)
{
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
                        }
                }
        }
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

//directorio Peliculas, Imagen y Subtitulos
$peldir = "../peliculas/"; 

//temporales
$peltmp = "../files/";

$tex = "mp4";
$sd = $_POST['sd'];

//Nombre de pelicula y corto
$pelnom = $_POST['ns'];

//Año de estreno
$ap = $_POST['ap'];

//Direccion
$dp = $_POST['dp'];

//Nombre final, cambiar espacio por guion bajo
$pelnomf = str_replace(" ", "_", $pelnom);
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



//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    //obtenemos el archivo a subir
    $files = $_FILES['archivo']['name'];
    $ext = $_FILES['archivo']['type']; 
     $i = 0;
    //comprobamos si el archivo ha subido
    foreach($files as $file)
    {



	$imav = $_FILES['archivo']['name'][$i];
	$trov = explode(".", $imav); 
	$extv = end($trov);  



// VIDEO

if ($ext[$i] == "application/vnd.rn-realmedia" OR $ext[$i] == "video/x-ms-wmv" OR $ext[$i] == "video/avi" OR $ext[$i] == "video/msvideo" OR $ext[$i] == "video/x-msvideo" OR $ext[$i] == "video/x-flv" OR $ext[$i] == "video/mp4" OR $ext[$i] == "video/ogg" OR $ext[$i] == "video/mpeg" OR $ext[$i] == "video/x-matroska" OR $extv == "avi" OR $extv == "flv" ){


$files2[$i] = str_replace(" ", "_", $files[$i]);
$files3[$i] = str_replace(")", "_", $files2[$i]);
$files4[$i] = str_replace("(", "_", $files3[$i]);
$files5[$i] = str_replace("'", "_", $files4[$i]);
$files5[$i] = str_replace("á", "a", $files5[$i]);
$files5[$i] = str_replace("é", "e", $files5[$i]);
$files5[$i] = str_replace("í", "i", $files5[$i]);
$files5[$i] = str_replace("ó", "o", $files5[$i]);
$files5[$i] = str_replace("ú", "u", $files5[$i]);
$files5[$i] = str_replace("ü", "u", $files5[$i]);
$files5[$i] = str_replace("ć", "c", $files5[$i]);
$files5[$i] = str_replace("ë", "e", $files5[$i]);





if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$peltmp.$files5[$i]))	
{
	
	echo "<div id='rs'>Ya subio, ahora espera un rato para que este disponible!!!</div>";

//Duracion del video
$peldur = "$peltmp$files5[$i]"; 
$movie = new ffmpeg_movie($peldur); 
$seg = $movie->getDuration(); 
$horas = floor($seg/3600); 
$minutos = floor(($seg-($horas*3600))/60); 
if ($minutos < 10){$min = "0$minutos";
}else{$min = "$minutos";
}$segundos = number_format($seg-($horas*3600)-($minutos*60));
$dura= $horas.':'.$min.':'.$segundos;


if($sd == '0'){
//Insertar base de datos de Peliculas

	$sql1 = "INSERT INTO lista (titulo, fecha, titucom, direccion, bueno, malo, dura) VALUES ('$pelnom', '$ap', '$pelnomf', '$dp', '0', '0', '$dura' )";
        mysql_query($sql1, $connect);

}elseif($sd == '1'){
//Insertar base de datos de Cortometraje

	$sql1 = "INSERT INTO corto (nombre, dura, archivo) VALUES ('$pelnom', '$dura','$pelnomf' )";
        mysql_query($sql1, $connect);
	
//Imagen de Muestra
$impr = rand(1,$seg);
shell_exec("ffmpeg -i ../files/$files5[$i] -ss $impr -vframes 1 -qmax 50 -s 100x100 -pix_fmt yuv420p ../peliculas/$pelnomf.jpg");

}





            $i++;
}	

											
}

// Formato IMAGEN

	    if ( $ext[$i] == "image/svg+xml" OR $ext[$i] == "image/jpeg" OR $ext[$i] == "image/png" OR $ext[$i] == "image/bmp" OR $ext[$i] == "image/gif")	{

	$imagen = $_FILES['archivo']['name'][$i];
	$trozos = explode(".", $imagen); 
	$extension = end($trozos);  


        if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$peltmp.$pelnomf.".".$extension))
        {
	    shell_exec("ffmpeg -i $peltmp$pelnomf.$extension -qmax 50 -s 100x150 -pix_fmt yuv420p $peldir$pelnomf.jpg");

            $i++;

        }
 
}


//Formato ISO

	    if ( $ext[$i] == "application/x-iso9660-image")	{

$ariso = $_FILES['archivo']['name'][$i];   
$part = explode(".", $ariso);	
$extiso = end($part);

if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$peltmp.$pelnomf.".".$extiso)){

if ($extiso == "iso" OR $extiso == "ISO" AND $sd == "0"){
	$sql1 = "INSERT INTO lista (titulo, fecha, titucom, direccion, bueno, malo, dura) VALUES ('$pelnom', '$ap', '$pelnomf', '$dp', '0', '0', '' )";
        mysql_query($sql1, $connect);
      }
	echo "<div id='rs'>Ya subio, ahora espera un rato para que este disponible!!!</div>";

										
								            $i++;

											}

								}


// Formato SUBTIULO

	    if ( $ext[$i] == "text/plain" OR $ext[$i] == "application/x-subrip" OR  $ext[$i] == "text/x-ssa"){

$subtitul = $_FILES['archivo']['name'][$i];   
$trozos = explode(".", $subtitul);	
$extsub = end($trozos);

if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$peltmp.$pelnomf.".".$extsub)){

//DESDE AQUI





$filename = "$peltmp$pelnomf.$extsub";
$text = file_get_contents($filename);

// para utf-8
if (codificacion($text) == 1 OR codificacion($text) == 2){
	
	// Extension ass UTF-8
	if($extsub == "ass"){
shell_exec("./subtip.sh $peltmp$pelnomf.$extsub $pelnomf.srt-2");
shell_exec("cp $peltmp$pelnomf.srt-2 $peldir$pelnomf.srt");
shell_exec("rm -f $peltmp$pelnomf.srt-2");
	}

	// Extension srt UTF-8
if($extsub == "srt"){
shell_exec("cp $peltmp$pelnomf.$extsub $peldir$pelnomf.$extsub");
		   }


			     }else{

	// Extension ass ISO-8859-1
	if($extsub == "ass"){
shell_exec("./subtip.sh $peltmp$pelnomf.$extsub $pelnomf.srt-2");
shell_exec("iconv -f ISO-8859-1  -t UTF-8 '$peltmp$pelnomf.srt-2' -o '$peldir$pelnomf.srt'");
shell_exec("rm -f $peltmp$pelnomf.srt-2");
	}

	// Extension srt ISO-8859-1
if($extsub == "srt"){
shell_exec("iconv -f ISO-8859-1  -t UTF-8 '$peltmp$pelnomf.$extsub' -o '$peldir$pelnomf.$extsub'");
		   }






     				}







            $i++;

        }
 
						}









	}

}else{
    throw new Exception("Error Processing Request", 1);   
}


?> 

