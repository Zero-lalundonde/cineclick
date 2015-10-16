############# OpenCineClick ###########################

Sistema Web para publicar y compartir contenido multimedia en linea, "streaming", 
con capacidad de comunicarse en red entre los servidores que lo instalen, siempre y cuando 
lo configuren para ello.

Este Proyecto nace como una alternativa al sistema actual de censura de los medios, con la esperanza
de abrir nuevas puertas a peliculas, series, dibutos animados y audio libros que no encajan en el estandar
del filtro con el que se seleccionan los materiales a reproducir en las plataformas tradicionales.

############# Licencia ################################

OpenCineClick es un programa libre: puedes redistribuir y/o modificar bajo
los terminos de la GNU Affero General Public License "Licencia Publica General"
publicada por la fundacion Free Software "Programa Libre", ya sea para la version 3
de la licencia, o versiones anteriores.

Recuerda publicar el codigo fuente para que otros tambien tengan acceso a el.

############# Sistema #################################

El script de instalación funciona sin problemas en Debian 7, en versiones mas modernas puede
presentar problemas por la dependencia de ffmpeg y ffmpeg-php que aun no se encuentra en los 
repocitorios oficiales.

############# Descarga e Instalacion ###################

Al descargar OpenCineClick con git, el directorio raiz / se llama cineclick,
y a su vez tambien tiene un subdirectorio que se llama igual:

        cineclick/
        |---cineclick/
        |---datos/
        |---panel/
        |---peliculas/
        |---script/
        |---LEEME
        |---LICENSE
        |---README.md
        |---crossdomain.xml
        |---htacces
        |---index.html

Es el contenido del directorio raiz llamado cineclick el que se debe mover al 
directorio de acceso publico de Apache "/var/www", el contenido y no el directorio mismo.

         mv cineclick/* /var/www/

############# Instalacion Automatica ###################

Con estos pasos se descarga e instala de forma automatica, el ultimo paso ejecuta el script
de instalacion llamado LEEME.

    cd ~
    git clone https://github.com/Zero-lalundonde/cineclick.git
    mkdir /var/www
    mv cineclick/* /var/www/
    cd /var/www/
    chmod +x LEEME
    ./LEEME 
    
############# Script de Instalacion ################### 

El Script se llama LEEME, este instala mysql y crea la base de datos
necesaria para gestionar la pagina, tambien instala ffmpeg que es necesario
para la conversion de los diferentes formatos multimedia.

Instala el modulo H264 MP4 en apache para reproduccion streaming.

Este script agrega el siguiente repositorio para cubrir las dependencias:

        "deb http://www.deb-multimedia.org wheezy main non-free"

############# CONTACTO #################################

La wiki de OpenCineClick esta aun en construccion, mientras tanto las consultas
pueden hacerlas a 

        deja.vecu@hotmail.fr

Wiki OpenCineClick

        https://github.com/Zero-lalundonde/cineclick/wiki
