<html>
<head>
<title>CineClick</title>
<link rel="stylesheet" href="index.css">
<meta charset="utf-8">

<!-- Adaptable a moviles -->
<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Icono -->
<link rel="shortcut icon" href="icono.ico" />

<!-- Jwplayer -->
<script type="text/javascript" src="jwplayer/jwplayer.js"></script>
<script type="text/javascript" src="../datos/clave.js"></script>

<style>
body{font-family:arial;}
#estrenos{width:auto,margin:auto auto;}
@media (max-width: 380px) {#reproductor{display:none;}#estrenos{display:none;}#actual{display:none;}}
</style>
</head>
<body>
<img id="arriba" src="fondoarriba.jpg">
<img id="abajo" src="fondoanajo.jpg">
<section><article>
<main>
CineClick
<section class="mainsection" style="font-family:arial;">                    
<a href="subir.php"><li class="menu" style="background:#000;border-color:#FF8A02;opacity:0.8;"><span style="font-size:13px;color:#FF8A02">Subir Videos</span><span style="font-size:10px;color:#FF8A02"><strong> *nuevo</strong></span></li></a>  
<a title="buscador y listado de las pelis" href="pel.php"><li class="menu">Peliculas</li></a>
<a href="ser.php"><li class="menu">Series</li></a>
<a href="corto.php"><li class="menu" >Cortos<span style="font-size:10px;color:#FF8A02"> Nueva Seccion</span></li></a>
<a href="dibu.php"><li class="menu">Dibujitos Animados</li></a>  
<a href="audio.php"><li class="menu">Audio Libros</li></a>  
</section>

<ul id='estrenos'>
<?php
include('../datos/conexion.php');
$connect = mysql_connect("localhost" , $coneccion['us'] , $coneccion['contra']);
mysql_select_db("peliculas",$connect);

$seccion = "Inicio";
include('include-ip.php');
header('Content-Type: text/html; charset=utf-8');

$http="http://";
$jw="jw";

$sql = "SELECT id, titulo, fecha, titucom, direccion, remoto, remotoid FROM lista order by id desc limit 6";
$result = mysql_query($sql, $connect) or die (mysql_error());
while ($row = mysql_fetch_array($result)) {
$id = $row['id'];
$titucom = $row['titucom'];
$tituex = ".mp4";
$orig = "$titucom$tituex";
$titu = $row['titulo'];
$direccion = $row['direccion'];

//Remoto
$remoto = $row['remoto'];
$urldb =  $coneccion['urlremoto'][$remoto];
$remotoiddb = $row['remotoid'];

$peliculas="../peliculas";

if(isset($remoto)) {$url="$http$urldb/cineclick/"; $id=$remotoiddb;}
if(!$remoto) $url="";

$imgremoto="$http$urldb/peliculas/";

$fondo = "$titucom.jpg";
echo "<li style='top:-20;border-top-left-radius:15px;border-top-right-radius:15px;'>";
//Directora(o)
echo "<div style='margin-left:0;position:relative;height:28px;padding-top:5px;bottom:-26;float:left;font-size:10px;z-index:2;position:absolute;color:#FFF;background:#000;opacity:0.9;padding-left:7px;box-sizing:border-box;border-bottom-right-radius:15px;border-box;border-bottom-left-radius:15px;font-family:arial;width:100%;'><strong>$direccion</strong></div>";
//Titulo pelicula y año de estreno
echo "<div class='titulos' style=' background-image: url($url$peliculas/$fondo);background-size: cover;border-top-left-radius:15px;border-top-right-radius:15px;font-size:13px;'><a href='$url$jw-p.php?id=$id' style='position:absolute;font-family:arial; bottom:0px;right:0px;opacity:0.7;'>" .$row['titulo']."<br>".$row['fecha']. "</a></div></li>";

};
?>                                     
</ul>

</main>
</article>
</section>

<?php
$sql2 = "SELECT titucom, titulo, remoto  FROM lista AS t JOIN (SELECT ROUND(RAND() * (SELECT MAX(id) FROM lista)) AS id) AS x WHERE t.id >= x.id LIMIT 1";
$result2 = mysql_query($sql2, $connect) or die (mysql_error());
$rows = mysql_fetch_array($result2);
$archi = $rows['titucom'];
$titulo = $rows['titulo'];
$remoto = $rows['remoto'];

$urldb =  $coneccion['urlremoto'][$remoto];

if(!$archi){ $archi="cuenta"; $titulo="CineClick";}; 
if(isset($remoto)){$url="$http$urldb"; $id=$remotoiddb;}else{ $url="";};
?>

<div class="contiene" align="center">
<span style="border-colot:#FFF;border-top:solid 1px;border-left:solid 1px;border-right:solid 1px;font-size:14px;color:#FFF;background:#000;opacity:0.8;padding-left:5px;padding-right:5px;padding-top:2px;" id="actual"></span>
<div id="reproductor"></div>
</div>

<script>
jwplayer("reproductor").setup({
primary:"flash",
width: 240,
height: 150,
provider: "http",
"startparam": "start",
smoothing: "false",
autostart: "true",
stretching: "uniform",
playlist: [
{title:"<?php echo $titulo; ?>",
sources: [{
file: '<?php echo "$url"; ?>/peliculas/<?php echo "$archi.mp4"; ?>',}],
tracks: [{
file: '<?php echo "$url"; ?>/peliculas/<?php echo "$archi.srt"; ?>',
label: "Españo",
kind: "captions",
"default": "true",
},]}],
captions: {
color: '#FFF',
fontSize: 22,
backgroundOpacity: 50
}});
</script>

<script>
jwplayer().onPlaylistItem( function(event){
document.getElementById("actual").innerHTML = jwplayer().getPlaylistItem().title;
});
</script>

<?php
if (!$sql2){}else{unset($tirr);unset($sql2);unset($result2);unset($rows);};

?>
</body>
</html>




