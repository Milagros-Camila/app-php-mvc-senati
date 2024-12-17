<?php
//Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors',1);

//Cargar el archivo de configuración
require_once 'config/config.php';

//Autoload de clases
spl_autoload_register(function ($class_name) {
    $directories = [
        'controllers/',
        'models/',
        'config/',
        'utils/',
        ''
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            // var_dump($file);
            require_once $file;
            return;
        }
    }
});

//Crear una instancia del router
$router = new Router();

$public_routes = [
    '/web',
    '/login',
    '/register',
];

//Obtener la ruta actual
$current_route = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$current_route = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $current_route);
//$current_route = la ruta despues de la carpeta del proyecto.


$router->add('GET','/web','WebController','index');
//login and Register
$router->add('GET','/login','AuthController','showLogin');
$router->add('GET','/register','AuthController','showRegister');

$router->add('POST','auth/login','AuthController','login');
$router->add('POST','auth/register','AuthController','register');

//HOMECONTROLLER
$router->add('GET', '/home', 'HomeController','index');

//CRUD PRODUCTOS -diseño
$router->add('GET', 'productos/', 'ProductoController','index');
//CRUD PRODUCTOS - trae de la BASE DE DATOS
$router->add('GET', 'productos/obtener-todo', 'ProductoController','obtenerProducto');
$router->add('POST', 'productos/guardar-producto', 'ProductoController','guardarProducto');//con esto vas a producto controller
$router->add('POST', 'productos/actualizar-producto', 'ProductoController','actualizarProducto');
$router->add('DELETE', 'productos/eiminar-producto', 'ProductoController','eliminarProducto');
$router->add('GET', 'productos/buscar-producto', 'ProductoController','buscarProducto');





// EMPLEADOS
$router->add('GET', 'empleados', 'EmpleadoController', 'index');
$router->add('GET', 'empleado/create', 'EmpleadoController', 'create');
$router->add('POST', 'empleado/create', 'EmpleadoController', 'create');
$router->add('GET', 'empleado/edit/{id}', 'EmpleadoController', 'edit');
$router->add('POST', 'empleado/edit/{id}', 'EmpleadoController', 'edit');
$router->add('GET', 'empleado/delete/{id}', 'EmpleadoController', 'delete');


// Obtener la URL limpia
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = trim($url, '/');
// index.php o router.php
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Ruta para agregar un nuevo empleado
    if ($url == 'empleado/create') {
        $controller = new EmpleadoController();
        $controller->create();
    }
    // Ruta para listar los empleados
    elseif ($url == 'empleado') {
        $controller = new EmpleadoController();
        $controller->index();
    }
    // Manejo de rutas no encontradas
    else {
        //echo "Página no encontrada.";
    }
}



//Despachar la ruta
try {
    $router->dispatch($current_route, $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    // Manejar el error
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include 'views/errors/404.php';
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}