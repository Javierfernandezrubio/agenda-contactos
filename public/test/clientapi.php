<?php
require '../../bootstrap.php';

//Direcci贸n de api
$issuer ='http://apirestcontactos.local';

//Credenciales
$credenciales =  [
    'usuario' => 'admin',
    'password'=> 'admin'
];

// Obtenemos el token de acceso.
$token = obtainToken($credenciales, $issuer);
echo $token;

//Tests 
getAllContactos($token);
getContacto($token, 4);

$contacto = [
    "id"=>"18",
    "nombre"=>"Rafael Nadal",
    "telefono"=>"938289328",
    "email"=>"rnada@correo.es"
];
addContacto($token, $contacto);

function obtainToken($datos, $issuer) {
    echo "Obteniendo token...<br/>";

    //Comprobamos si disponemos del token en almacenamiento local, en cuyo caso lo leemos.

    //Cargamos ruta de login
    $uri = $issuer . '/login';
    
    // Petici贸n curl
    
    //Inicio
    $ch = curl_init();
   
    //Parametrizaci贸n
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Petici贸n
    $response = curl_exec($ch);

    //Comprabamos que el token es correcto
    $response = json_decode($response, true);
    if (! isset($response['jwt'])) {
        exit('failed, exiting.');
    }

    echo "Token OK <br/>";
    //Almacenamiento local del token.

    
    return $response['jwt'];
}

function getAllContactos($token) {
    echo "<br/>Obteniendo todos los contactos...<br/>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json',"Authorization: Bearer $token" ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    echo $response;
}

function getContacto($token, $id) {
    echo "<br/>Obteniendo contacto por id: $id...<br/>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos/" . $id);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer $token"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    echo $response;
}

function addContacto($token, $datos) 
{
    echo "<br/>Nuevo contacto...<br/>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://apirestcontactos.local/contactos");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', "Authorization: Bearer $token" ]);
    curl_setopt($ch,CURLOPT_POST,true);
    var_dump($datos);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($datos));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    echo $response;
   
}