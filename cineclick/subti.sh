##  «Copyright © 2015 Fco. Gamboa Ortiz»
##  This file is part of OpenCineClick.

##  OpenCineClick is free software: you can redistribute it and/or modify
##  it under the terms of the GNU Affero General Public License as published by
##  the Free Software Foundation, either version 3 of the License, or
##  (at your option) any later version.

##  OpenCineClick is distributed in the hope that it will be useful,
##  but WITHOUT ANY WARRANTY; without even the implied warranty of
##  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
##  GNU Affero General Public License for more details.

##  You should have received a copy of the GNU Affero General Public License
##  along with this program.  If not, see <http://www.gnu.org/licenses/>.
#########################################################################
##  Traduccion al español de esta Licencia

##  Este archivo es parte de OpenCineClick.

##  OpenCineClick es un programa libre: puedes redistribuirlo y/o modificar bajo
##  los terminos de la GNU Affero General Public License "Licencia Publica General"
##  publicada por la fundacion Free Software "Programa Libre", ya sea para la version 3
##  de la licencia, o versiones anteriores.

##  OpenCineClick es distribuido con la esperanza de que sea útil,
##  pero SIN NINGUNA GARANTÍA; ni siquiera la garantía implícita de
##  COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR . Vea el
##  Licencia Pública General Affero GNU para más detalles.  

##  Debería haber recibido una copia de la Licencia Pública General Affero GNU
##  Junto con este programa . Si no es así , consulte < http://www.gnu.org/licenses/ > .
##  Por precaución la licencia está copiada completa en dos archivos, 
##  uno llamado COPYING y otro llamado LICENCIA

#!/bin/bash

TMP=/var/www/dibujitos/sub/tmp
SUB=/var/www/dibujitos/sub

touch $TMP/prueba.srt
touch $TMP/prueba2.srt
touch $TMP/prueba3.srt
touch $TMP/prueba4.srt
touch $TMP/prueba5.srt
touch $TMP/prueba6.srt

chmod 777 $TMP/*
chown apache:apache $TMP/*

sed -n -e '/^[Dialogue]/p' $1 >> $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt
sed -i 's/,/ /' $TMP/prueba.srt

cut -d " " -f 1,3,4,10-50 $TMP/prueba.srt >> $TMP/prueba2.srt
awk '{print "SALTO""SALTO" NR "SALTO" 0 $2 0, "-->", 0 $3 0 "SALTO";i=4; while (i<=NF){print $i ;i++}}' $TMP/prueba2.srt >> $TMP/prueba3.srt
sed -n -e '1x;1!H;${x;s-\n- -gp}' $TMP/prueba3.srt >> $TMP/prueba4.srt
sed -e 's/SALTO/\n/g' $TMP/prueba4.srt >> $TMP/prueba5.srt
sed -e 's/\r//g' $TMP/prueba5.srt  >> $TMP/prueba6.srt
sed -i 's/\\N/<br>/g' $TMP/prueba6.srt
nom=$(echo "$1" | rev | cut -d'.' -f2 | rev)
cp $TMP/prueba6.srt $SUB/$2

rm -f $TMP/prueba.srt
rm -f $TMP/prueba2.srt
rm -f $TMP/prueba3.srt
rm -f $TMP/prueba4.srt
rm -f $TMP/prueba5.srt
rm -f $TMP/prueba6.srt
