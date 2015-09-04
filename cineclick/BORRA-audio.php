<?php
include('../datos/conexion.php');
$connect = mysql_connect("localhost" , $us , $contra);
mysql_select_db("peliculas",$connect);

?>
<html>
<head>
<title>Audio</title>
<meta charset="utf-8">

<!-- Icono -->
<link rel="shortcut icon" href="icono.ico" />

<style>
body{font-family: arial;margin-top:30px;color:#D71F1F;background-color:#E5E5E5;font-size:12px;}

.muestra{width:100px;height:150px;margin-bottom:25px;position:relative;margin-left:5%;display:inline-block;box-sizing: border-box;border-radius:15px;}

.muestra:hover{left:2px;top:2px;}

#armar{width:200px;height:auto;border-radius:10px;padding:5px;border:solid 1px #D74D4D;background:#D74D4D;color:#FFF;float:right;right:200px;position:relative;}

a:link { text-decoration: none; }

</style>

</head>
<body>
<p style="margin-left:5%;font-size:40px;margin-bottom:10px;">Audio Libro y Similares</p>
<hr style="margin-bottom:20px;">
<?php

$sql = "SELECT * FROM audio GROUP BY album";
$result = mysql_query($sql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result)) {
$albumdb = $row['album'];
$autoriadb = $row['autoria'];
$titulodb = $row['titulo'];

$titulodbsa = str_replace("_", " ", $titulodb);
$albumdbsa = str_replace("_", " ", $albumdb);

echo "<a href='../jwplayer/audiolib.php?album=$albumdb&autoria=$autoriadb'>";
echo "<div class='muestra' align='center' style='background-image:url(../dibujitos/imagen/mini/$albumdb.jpg);background-size: contain;padding-top:5px;'>";
echo "<p style='position:absolute;bottom:0px;height:auto;opacity:0.8;background-color:#4B1C1C;color:#FFF;padding-bottom:5px;padding-right:2px;padding-left:2px;padding-top:5px;margin-top:0px;border:solid 1px #FFF;'>$albumdbsa</p>";
echo "<p style='position:absolute;bottom:-10px;opacity:0.85;background:#218004;color:#FFF;padding-left:5px;padding-right:5px;width:90px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;font-size:10px;'><strong>$autoriadb</strong></p>";
echo "</div>";
echo "</a>";
}

?>

</body>
</html>
