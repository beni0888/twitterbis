La aplicación está implementada en php, para su correcto funcionamiento es necesario disponer del motor php instalado 
en el sistema. La versión mínima requerida es la 5.6. 

La aplicación está implementada como un paquete Composer, para instalarla hay que hacer lo siguiente:
> cd /path/to/application/
> php composer.phar install

Para correr la aplicación simplemente:
> cd /path/to/application/
> php /src/twitterbis.php

Funcionamiento:
- Es autoexplicativa, por pantalla se indican las instrucciones.
- Al comienzo se pide el listado de usuarios

Test:
- Por falta de tiempo he hecho muchos menos de los que me gustaría
- No obstante, para ejecutar los que hay:
> cd /path/to/application/
> php vendor/phpunit/phpunit/phpunit --bootstrap vendor/autoload.php tests/