<?php
// Custom autoloader function
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        error_log("Autoloader: class $class does not use the App\\ prefix");
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace namespace separators with directory separators
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    error_log("Autoloader: attempting to load class $class from file: $file");

    if (file_exists($file)) {
        error_log("Autoloader: file found, requiring $file");
        require $file;
    } else {
        error_log("Autoloader: file not found for class $class at path: $file");
    }
});

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\InventoryController;
use App\Utils\Session;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Simple router
$routes = [
    '/' => [AuthController::class, 'login'],
    '/login' => [AuthController::class, 'login'],
    '/logout' => [AuthController::class, 'logout'],
    '/users' => [UserController::class, 'index'],
    '/users/create' => [UserController::class, 'create'],
    '/users/edit' => [UserController::class, 'edit'],
    '/users/delete' => [UserController::class, 'delete'],
    '/inventory' => [InventoryController::class, 'index'],
    '/inventory/create' => [InventoryController::class, 'create'],
    '/inventory/edit' => [InventoryController::class, 'edit'],
    '/inventory/delete' => [InventoryController::class, 'delete']
];


// Handling dynamic routes with IDs
if (preg_match('/^\/inventory\/edit\/(\d+)$/', $uri, $matches)) {
    $controller = new InventoryController();
    $controller->edit((int)$matches[1]);
} elseif (preg_match('/^\/inventory\/delete\/(\d+)$/', $uri, $matches)) {
    $controller = new InventoryController();
    $controller->delete((int)$matches[1]);
} elseif (preg_match('/^\/users\/edit\/(\d+)$/', $uri, $matches)) {
    $controller = new UserController();
    $controller->edit((int)$matches[1]); 
} elseif (preg_match('/^\/users\/delete\/(\d+)$/', $uri, $matches)) {
    $controller = new UserController();
    $controller->delete((int)$matches[1]); 
} elseif (isset($routes[$uri])) {
    [$controller, $method] = $routes[$uri];
    $controller = new $controller();
    $controller->$method();
} else {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
}

