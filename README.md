

# phpmy_webservice

Generic Webservice for PHP-MySQL Database


Codigo de creación de webservice para sistema en MySQL

Author: Daniel Blanco - Blanco Martin y Asociados
Licence: LGPL

https://www.gnu.org/licenses/lgpl.txt

## Instructions

-Rename authentication.php.sample to authentication.php

-Edit this file including your authentication data

-Copy both files to a web accesible address.

-user_test and user_hash provided in example are intented
 for testing purposes.

-uncomment from line 78 to 97 to allow only authorized 
 users, making the modification you need.

## Usage for consumption

Method designed: get_list

Accepted request method GET or POST

Example request:

[
   'user_test' => 'daniel',
   'user_hash' => '8a72-528c25ad8dd1',
   'model' => 'accounts',
   'method' => 'get_list',
   'fields' => Array('name','id'),
   'filter' => Array(
       Array('name','=','Pepe'),
       Array('apellido','!=','Martinez'),
   ),
   'limit' => 10,
]


# phpmy_webservice

Webservice generico para base de datos MySQL (php)


Codigo de creación de webservice para sistema en MySQL

Autor: Daniel Blanco - Blanco Martin y Asociados
Licencia: LGPL

https://www.gnu.org/licenses/lgpl.txt

## Instrucciones

-Renombre authentication.php.sample a authentication.php

-Edite este archivo incluyendo en el mismo sus datos de 
 autenticación para su base de datos.

-Copie ambos archivos a una dirección accesible desde web.

-user_test y user_hash provistos en el ejemplo, son utlizables 
 para test.

-descomente desde linea 78 a 97 para permitir acceso a sus usuarios
 de sistema, realizando las modificaciones que necesite.

## Uso para consumo

Metodo diseñado: get_list

Metodo de solicitud aceptado: GET o POST

Request de ejemplo:

[
   'user_test' => 'daniel',
   'user_hash' => '8a72-528c25ad8dd1',
   'model' => 'accounts',
   'method' => 'get_list',
   'fields' => Array('name','id'),
   'filter' => Array(
       Array('name','=','Pepe'),
       Array('apellido','!=','Martinez'),
   ),
   'limit' => 10,
]

## Credits
<p>
<img alt="Logo BMYA" src="http://crm.blancomartin.cl/index.php?entryPoint=image&name=c82ab43f-e8dd-b2fa-25ff-56017f69d116" />
</p>

Blanco Martín & Asociados - BMyA S.A.

http://www.blancomartin.com.ar
