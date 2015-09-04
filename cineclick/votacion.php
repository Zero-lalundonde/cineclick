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
$mysqli = new mysqli('localhost', $coneccion['us'], $coneccion['contra'], 'peliculas');

	// verificamos la conexión 
	if (mysqli_connect_errno()) {
	    printf("La conexión falló: %s\n", mysqli_connect_error());
	    exit();
	}

	// si está seteada la variable nombre
	// es que se presionó alguno de los botones
	if(isset($_POST['nombre'])) {
		$id=mysql_escape_String($_POST['id']);
		$nombre=mysql_escape_String($_POST['nombre']);

		// actualizamos el valor del video
		$query = "UPDATE lista SET $nombre = $nombre + 1 WHERE id = $id";
		$mysqli->query($query);
	}

	if(isset($_POST['id'])) {
		$id=mysql_escape_String($_POST['id']);
		$query2 = "SELECT `bueno`,`malo` FROM `lista` WHERE `id` = $id";
		$resultado = $mysqli->query($query2); 

		if($resultado !== FALSE) {
		    while ($obj = $resultado->fetch_object()) {
		        $bueno = $obj->bueno;
		        $malo = $obj->malo;
	    	}	

			$total=$bueno+$malo; 
			$buenoPorcentaje=floor(($bueno*99)/$total); 
			$maloPorcentaje=floor(($malo*99)/$total); 
			
			// se devuelve el resultado
			?>
			<b>

<?php 



//echo $total; 

if($total > 44){
$total2 = "44";
}else{
$total2 = $total;
};


$fum = 135 - ($total2 * 3);

//echo $fum;

?>


</b>
			<div id="votos">


<div id="porro"><div id="quemado" style="background-position: <?php echo $fum; ?>px 0;"></div></div>

			</div>
			<?php
		}
	}
?>
