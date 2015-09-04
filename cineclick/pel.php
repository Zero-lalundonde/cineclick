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

$us = $coneccion['us'];
$contra = $coneccion['contra'];

$conectar = mysql_connect("localhost" , $us , $contra);
mysql_select_db("peliculas",$conectar);

$seccion = "Peliculas";
include('include-ip.php');

function series($iddib,$serie,$directorio,$numerocap,$sd){
if($sd==0){
$dibujitos = "
<a href='reproducir.php?id=$iddib'>
<div class='divrd' style='background-image:url(\"$url../dibujitos/imagen/mini/$directorio.jpg\");background-size:100% 100%;'>
<div class='divtd'>$serie <br></div>
</div>
</a>
";
return $dibujitos;
}


if($sd==1){
$series = "
<a href='reproducir.php?id=$iddib'>
<div class='divrd' style='background-image:url(\"$url../dibujitos/imagen/mini/$directorio.jpg\");background-size:100% 100%;'>
<div class='divtd'>$serie <br></div>
</div>
</a>
";
return $series;
}

}
?>
<html>
<head>
<title>Cartelera</title>
<meta charset="utf-8">

<!-- Adaptable a moviles -->
<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Icono -->
<link rel="shortcut icon" href="icono.ico" />

<!-- Jquery  -->
<script type="text/javascript" src="jquery.js"></script>

<style>
body{margin:0;padding:80px 0 30px 0;font-family:arial;}
#fixed{border-bottom:solid 1px #999;width:100%;height:32px;position:fixed;top:0;padding:3px;box-sizing:border-box;background:rgba(200, 200, 200, 1);z-index:2;}
@media (max-width: 1000px){#fixed{height:64px;}#inputs{margin: 0 0 5px 60px;}}
@media (max-width: 600px){#fixed{height:32px;}#inputs{display:none;}}
#inputbuscar{border:solid 1px rgba(231, 106, 35, 1);border-radius:0;width:300px;height:25px;box-sizing:border-box;margin:0 0 0 5%;padding:4px;}
#submitbuscar{background:#D42424;border:0px;color:#fff;height:25px;box-sizing:border-box;position:absolute;margin: 0 0 0 -5px;}
#inputs{height:25px;width:580px;padding:0;border:0px;top:0;float:right;}
.sw{border-radius:0;color:#fff;height:25px;box-sizing:border-box;margin-right:3px;display:inline-block;border:solid 1px #2A6317;background:#46A527;}
.sw:hover{font-weight:bold;font-size:12px;cursor:pointer;}
.divr{ display: inline-block; position:relative; border:0; color:#fff; text-align:center; font-size:13px; width:200px; height:130px; margin:27px -4px 27px 0px; box-sizing:border-box; z-index:1;} 
.divrd{ display: inline-block; position:relative; border:0; color:#fff; text-align:center; font-size:13px; width:200px; height:130px; margin:0px -4px 27px 0px; box-sizing:border-box; z-index:1;} 
.divt{ background: rgba(137, 176, 113, 1); padding:2px; padding-top:5px; font-weight:bold; opacity:0.8; box-sizing:border-box; position:absolute; width:100%; top:-65px; min-height:60px; border-left:solid 1px #888; border-right:solid 1px #888:} 
.divtd{background: rgba(94, 117, 207, 0.9); padding:2px; padding-top:5px; font-weight:bold; opacity:0.8; box-sizing:border-box; position:absolute; width:100%; top:-35px; min-height:30px; border-left:solid 1px #888; border-right:solid 1px #888:}
.divt div{ font-weight:normal; font-size:12px; background:rgba(0, 0, 0, 0.9); bottom:0; width:100%; padding:3px; position:absolute; margin-left:-2px; box-sizing:border-box;} 
#divd{font-weight:bold; color:#fff; padding:6px; margin-top:5px; background:rgba(103, 86, 240, 0.4); border-top:solid 1px rgba(0, 0, 0, 0.3); box-sizing:border-box;}
a:link{text-decoration:none;}
a:focus {outline:0px;}
button::-moz-focus-inner { border: 0; }
#scroll{width:90%; height:180px; overflow-x:hidden; overflow-y:hidden; margin:auto auto; padding-top:40px; position:relative;}
.scroll{width:90%; height:150px; overflow-x:hidden; overflow-y:hidden; margin:auto auto; padding-top:40px; position:relative;}
@media (max-width: 650px){#scroll, .scroll{overflow-x:scroll;}#inputbuscar{width:200px;}}
#imgavanzar{width:40px;}
#imgavanzar:hover{width:44px;}
#imgretroceder{width:40px;}
#imgretroceder:hover{width:44px;}
#retroceder{top:150px; z-index:3; float:left; position:absolute; opacity: 0.6; left:5px; display:none;} 
#retroceder:hover{top:145;left:5;border:0px;}
#avanzar{top:150px; z-index:3; float:right; position:absolute; opacity: 0.6; right:5px; display:none;}
#avanzar:hover{top:145; right:5; border:0px;}
#cartel{background:rgba(50, 50, 50, 1); width:350px; min-height:150px; float:left; display:none; z-index:9999; position:absolute; margin-left:10px; margin-top: 180px; font-size:12px;}
#info{color:#fff; text-align:center; padding-top:10px; font-weight:bold;}
#infoestre{margin-bottom:27px;}
.inf{ background:#888; padding:5px; margin-top:5px; width:100%; box-sizing:border-box;}
.Sec{ font-size:32px; font-weight:bold; margin-left:10%; margin-bottom:0;color:rgba(204, 76, 25, 1);}

</style>

<script type="text/javascript">
$(document).ready(function(){
$(".sw").click(function () {
$.get("buscar.php",{tablaget: "lista",seccion: $(this).val()},function(respuesta){$("#resultado").html(respuesta);
});});});
</script>

<script>
//MOVER TODOS LOS SCROLL
function MoverRaton(Mscroll,Nscroll,anchodiv,raton){
var adelante = (85*anchodiv)/100;
var atras = (15*anchodiv)/100;

if(raton > adelante ){
$(Nscroll).animate( { scrollLeft: '+=10' }, 7);
};
if(raton < atras ){
$(Nscroll).animate( { scrollLeft: '-=10' }, 7);
};

}
</script>


<script>
//IDENTIFICAR QUE SCROLL MOVER
$(document).ready(function(){

//Peliculas
$('#resultado').mousemove(function(event){
if (this.id == 'resultado'){
var anchodiv = $(this).width();
var raton = event.pageX - this.offsetLeft;
MoverRaton('#resultado','#scroll',anchodiv,raton);
}
$('#retroceder').css('display','inline-block');
$('#avanzar').css('display','inline-block');
});

//Dibujitos
$('#resultadodib').mousemove(function(event){
if (this.id == 'resultadodib'){
var anchodiv = $(this).width();
var raton = event.pageX - this.offsetLeft;
MoverRaton('#resultadodib','#scrolldib',anchodiv,raton);
}
});

//Series
$('#resultadoser').mousemove(function(event){
if (this.id == 'resultadoser'){
var anchodiv = $(this).width();
var raton = event.pageX - this.offsetLeft;
MoverRaton('#resultadoser','#scrollser',anchodiv,raton);
}
});

});
</script>

<script>
//Aparece info cuando el raton esta encima
function cartel(interno,tiempo,nombre,direccion,reparto,estreno){
$('.divr').mouseenter(function(event){
var raton = event.pageX; // posicion del raton
var anchodiv = $('#scroll').width(); // ancho del div
var adelante = (85*anchodiv)/100; // 80% del ancho
var atras = (20*anchodiv)/100; // 20% del ancho

//If cuando el raton esta al comienzo o final, se oculta  la info
if(raton > atras && raton < adelante){ 
$('#cartel').css('display','inline-block');
$('#cartel').css('left', raton);
$('#info').text(nombre);
$('#divd').text(tiempo);
$('#infodire').text("Direccion: " + direccion);
$('#inforepa').text("Reparto: " + reparto);
$('#infoestre').text("Estreno: " + estreno);

if(reparto.length){
// la variable existe, no hacer nada
$('#inforepa').css('display','inline-block');
}else{
$('#inforepa').css('display','none');
};

}else{
$('#cartel').css('display','none');
}; 
//Fin del IF

});

//Se oculta la info si el raton sale del Scroll
$('.divr').mouseleave(function(event){
$('#cartel').css('display','none');
});
//
}
</script>

<script>
//Mover el Scroll con un Click
$(document).ready(function(){
var anchodiv = $('#scroll').width();
var adelante = (90*anchodiv)/100;

$('#avanzar').click(function(){
$('#scroll').animate( { scrollLeft: '+=' + adelante }, 2000);
});
$('#retroceder').click(function(){
$('#scroll').animate( { scrollLeft: '-=' + adelante }, 2000);
});
});
</script>

</head>
<body onLoad="inicio()">
<div id="fixed">

<div id="inputs">
<button name="wi" value="anime" class="sw" id="anime">Anime</button>
<button name="wi" value="docu" class="sw" id="docu">Documentales</button>
<button name="wi" value="subir" class="sw" id="subir">Subidoras de animo</button>
<button name="wi" value="esp" class="sw" id="esp">En espaniol</button>
<button name="wi" value="subv" class="sw" id="subv">Subversivas</button>
</div>

<form action="" method="post">
<input type="hidden" name="tabla" value="lista">
<input type="search" id="inputbuscar" name="cadena">
<input type="submit" id="submitbuscar" value="Buscar">
</form>

</div>
<div id='cartel'>
<div id='info'></div>
<div id='divd'></div>
<div id='infodire' class='inf'></div>
<div id='inforepa' class='inf'></div>
<div id='infoestre' class='inf'></div>
</div>

<div class="Sec">Peliculas</div>
<a href="#" id="retroceder"><img id="imgretroceder" src="retroceder.png"></a> 
<div id='scroll'>
<div id="resultado">
<?php
$cadena = $_POST['cadena'];
$tabla = $_POST['tabla'];

if(!$cadena){
$cadena = "";
$tabla = "lista";
}

include('buscar.php');
//if(isset($cadena)) include('buscar.php');

?>
</div>
</div>
<a href="#" id="avanzar"><img id="imgavanzar" src="avanzar.png"></a> 

<div class="Sec">Dibujitos</div>
<div id='scrolldib' class="scroll" style="margin-top:0px;">
<div id="resultadodib">
<?php
// Dibujitos
$resultado = mysql_query("SELECT * FROM series WHERE sd='0' order by id desc", $conectar) or die (mysql_error());
$ancho = mysql_num_rows($resultado) * 200;
echo "<div style='width:$ancho\px;'>";
while ($row = mysql_fetch_array($resultado)) {
$id = $row['id'];$serie = $row['serie'];$directorio = $row['directorio'];$numerocap = $row['numerocap'];$sd = $row['sd'];

echo series($id,$serie,$directorio,$numerocap,$sd);
}
echo "</div>";
//Fin Dibujitos
?>
</div>
</div>


<div class="Sec">Series</div>
<div id='scrollser' class="scroll" style="margin-top:0px;">
<div id="resultadoser">
<?php
// Series
$resultado = mysql_query("SELECT * FROM series WHERE sd='1' order by id desc", $conectar) or die (mysql_error());
$ancho = mysql_num_rows($resultado) * 200;
echo "<div style='width:$ancho\px;'>";
while ($row = mysql_fetch_array($resultado)) {
$id = $row['id'];$serie = $row['serie'];$directorio = $row['directorio'];$numerocap = $row['numerocap'];$sd = $row['sd'];

echo series($id,$serie,$directorio,$numerocap,$sd);
}
echo "</div>";
//Fin Series
?>
</div>
</div>


</body>
</html>

