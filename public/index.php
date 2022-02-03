<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Front controller
 * 
 */

require '../vendor/autoload.php';
require '../bootstrap.php';

// Clases a usar
//use App\Models\Contactos;
use App\Controllers\ContactosController;

/* // Cabeceras
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: OPTIONS,GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
 */
// Cabeceras de Jose
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Parseamos la dirección de entrada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $request);

$requestMethod = $_SERVER['REQUEST_METHOD'];

// Datos de usuario en la url si existe. es opcional
$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
}

/* echo "<h1>Agenda de contactos</h1>";

echo DBHOST;
echo "<br>";
echo DBUSER;
echo "<br>";
echo DBPASS;
echo "<br>";
echo DBPORT;
echo "<br>";
echo DBNAME;
echo "<br>";


$conatctos = new ContactosController($_SERVER['REQUEST_METHOD'], $_GET['id']);

echo $conatctos->processRequest(); */

if ($uri[1] !== 'contactos') {
    header('HTTP/1.1 404 Not Found');
    exit('404 Not Found');
}

$controller = new ContactosController($requestMethod, $userId);
$controller->processRequest();



// Definimos las rutas validas
$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/contactos(\/[0-9])?$/',
    'action' => ContactosController::class));

$route = $router->match($request);
if (route) {
    $controllerName = $route->getAction();
    $controller = new $controllerName($requestMethod, $userId);
    $controller->processRequest();
} else {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = 'Resource not found';
    header($response['status_code_header']);
    echo $response['body'];
    echo json_encode($response);
}