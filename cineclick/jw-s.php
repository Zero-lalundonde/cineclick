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
<script>
var numEpisodios = <?php echo "$numerocap";?>, i = "1";
var episodios = [];

var anchor = $('#reproductor').width();
if(anchor > 500){
var lista = "right";
};
if(anchor < 500){
var lista = "none";
};


for (i; i<=numEpisodios; i++) {
episodios.push({"image":"none","title":"" + i + "",
"sources":[{"file":"../dibujitos/<?php echo "$directorio";?>/" + i + ".<?php echo "$exten"; ?>"}],
"tracks": [{
"file": '../dibujitos/sub/<?php echo "$directorio"; ?>' + i + '.srt',
"label": "Esp",
"kind": "captions",
"default": "true",
}],
});
}
jwplayer("reproductor").setup({
"stretching": "exactfit",
"width": "100%",
"aspectratio": "16:9",
"primary":"flash",
"provider": "http",
"listbar":{
"position":lista,
"layout": "basic",
"size":"70",
},
"playlist": episodios,
"startparam": "start",
"advertising": {
"client":"vast",
"skipoffset":1,
"skipmessage":"Saltar",
"skiptext":"Saltar",
"schedule": {
"adbreak1": {
"offset": "pre",
"tag": "../dibujitos/op/<?php echo "$directorio";?>.xml",
},
"adbreak2": {
"offset": "post",
"tag": "../dibujitos/op/<?php echo "$directorio";?>f.xml",
},
}},
"captions": {
"color": '#FFF',
"fontSize": 22,
"backgroundOpacity": 50,
},
});
</script>
<script>
var det = 0;
jwplayer("reproductor").onComplete( function(event){
var conta = ++det;
if(conta == 3){
jwplayer().stop();
alert("!genial que te guste tanto esta serie!\n para continuar dale click al capitulo siguiente.");
conta = null;
det = null;
};
});
</script>



