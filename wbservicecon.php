<?php
    /******************************************************************
     * Codigo de creación de webservice para sistema en MySQL
     * Autor: Daniel Blanco - Blanco Martin y Asociados
     * Licencia: LGPL
     * Términos de la licencia: https://www.gnu.org/licenses/lgpl.txt
     ******************************************************************/
        
    /******
     * Validación de usuario
     * esta porción del código valida si el usuario del sistema
     * mysql es válido.
     * Cambiar user_name y password por los nombres de campo que correspondan
     * Cambiar users (tabla) por el nombre de tabla que corresponda
     *
     * $db es una instancia de la clase que haga falta para conectar y 
     * autenticar a nivel de la base de datos
     *******/

    define('VERSION',1);

    $array_result = Array();

    /** Chequea que mysql está instalado **/
    if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
        error_log('msqli no se encuentra instalado');
        die(
            json_encode(Array('version' => VERSION,
            'error' => 1, 'msg' => 'mysqli no se encuentra instalado')));
    }

    /**
     * código de instanciar db y autenticación.
     * Cambiar por el código de instanciar db que corresponda en el archivo
     * authentication.php
     **/
    include('authentication.php');
    $db = New mysqli($servidor, $usuario, $password, $basedatos);
    /* verificar la conexión */
    if ($db->connect_error) {
        error_log('Falló la conexión failed: ', $db->connect_error);
        die(
            json_encode(Array('version' => VERSION,
            'error' => 2, 'msg' => 'database error: '.$db->connect_error)));

    }
    $db->set_charset('utf8');

    // ejemplo1 de request:
    // en este caso traería toda la lista de la tabla abonados

//    $_REQUEST = Array(
//        'user_test' => 'daniel',
//        'user_hash' => '8a72-528c25ad8dd1',
//        'model' => 'accounts',
//        'method' => 'get_list',
//        'fields' => Array('name','id'),
//        'filter' => Array(
//            Array('name','=','Pepe'),
//            Array('apellido','!=','Martinez'),
//        ),
//        'limit' => 10,
//    );

    //

    // para test, el request debe pasar:
    // $_REQUEST['user_test'] == 'daniel';
    // $_REQUEST['user_hash'] == '8a72-528c25ad8dd1';

    /***
     * Porción de autenticación de usuario o permisos. 
     * Hacer los cambios necesarios de nombres de campos para poder realizar la
     * autenticación y descomentar todo el bloque
     ***/


    //    if(
    //        isset($_REQUEST['user_name']) && (isset($_REQUEST['password'])
    //         || 
    //        (isset($_REQUEST['user_hash'])))){
    //        if(isset($_REQUEST['password'])) 
    //            $user_hash="encrypt(lower(md5(
    //                '".$_REQUEST['password']."')),user_hash)";
    //        else $user_hash="'".$_REQUEST['user_hash']."'";
    //        $query="SELECT * FROM users WHERE user_name='".$_REQUEST['user_name']
    //        ."' AND user_hash=".$user_hash
    //        ." AND is_admin AND status = 'Active' AND !deleted";
    //     
    //        $res=$db->query($query, true, 'Error: '.mysql_error());
    //     
    //        if($res->num_rows==0) 
    //            die(
    //                json_encode(Array('version' => VERSION,
    //                'error' => 3, 'msg' => 'Unauthorized User')));
    //        $environment = 'production';
    //    }
// leave commented for production - dejar comentado para producción
    //    elseif(
    //        $_REQUEST['user_test'] == 'daniel'
    //        && $_REQUEST['user_hash'] == '8a72-528c25ad8dd1'){
    //        $environment = 'test_mode';
    //    }
// dejar comentado para producción hasta esta linea
    //    else{
    //        die(json_encode(Array(
    //            'version' => VERSION,
    //            'error' => 4, 'msg' => 'Unrecognized User')));
    //    }


    /***
     * Construcción de query
     ***/
    if (empty($_REQUEST['fields']) || is_null($_REQUEST['fields'])){
        $fields = '*';
    }
    else{
        $fields = implode($_REQUEST['fields'], ', ');
    }


    $query = 'SELECT '. $fields .' FROM '.$_REQUEST['model']. ' WHERE ';

    if(empty($_REQUEST['filter']) || is_null($_REQUEST['filter'])){
        $query .= '1';
    }
    else{
        $bfilter = Array();
        foreach ($_REQUEST['filter'] as $filter){
            $bfilter[] = $filter[0].' '.$filter[1].' "'.$filter[2].'" ';
        }
        $query .= implode($bfilter, 'AND ');
    }

    if(!empty($_REQUEST['limit']) && !is_null($_REQUEST['limit'])){
        $query .= ' LIMIT '.$_REQUEST['limit'];
    }

    // echo $query; 
    // echo "\n";
    // die;

    // $array_result['results']['query'] = $query;
    $array_result = Array(
        'version' => VERSION,
        'format' => 'json',
        'result' => '',
    );

    $res = $db->query($query);
    if(!$res){
        die('Error');
    }

    $i = 0;
    $array_result['result'] = Array();
    while ($obj = $res->fetch_object()){
        $array_result['result'][] = (array)$obj;
    }

    echo json_encode($array_result);

    $db->close();

