<?php
declare(strict_types=1);
require $_SERVER['DOCUMENT_ROOT'] . '/../src/autoloader.php';
Autoloader::register();
session_start();
$routes = require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/routes.php';
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
date_default_timezone_set("Europe/Paris");

if (isset($routes[$url])) {
    $controllerClass = $routes[$url]['controller'];
    $action = $routes[$url]['action'];
    $methods = $routes[$url]['methods'];
    $redirectRelPath = isset($routes[$url]['redirect']) ? $routes[$url]['redirect'] : "/";
    $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $redirect = $protocol . "://" . $_SERVER['HTTP_HOST'] . $redirect;

    if (!in_array($_SERVER['REQUEST_METHOD'], $methods)) {
        http_response_code(405);
        header("Location: " . $redirect);
        exit();
    }

    $controller = new $controllerClass($redirect);
    $controller->$action();
} else {
    http_response_code(404);
    echo "Page non trouvée.";
}
