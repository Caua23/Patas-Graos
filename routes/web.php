<?php

$basePath = dirname($_SERVER['SCRIPT_NAME']);
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (strpos($route, $basePath) === 0) {
    $route = substr($route, strlen($basePath));
}
if ($route == '' || $route == false) {
    $route = '/';
}

switch ($route) {
    case '/':
        require __DIR__ . '/../app/controllers/HomeController.php';
        break;
    case '/sobre':
        require __DIR__ . '/../app/controllers/AboutController.php';
        break;
    case '/catalogo':
        require __DIR__ . '/../app/controllers/CatalogController.php';
        break;
    case '/carrinho':
        require __DIR__ . '/../app/controllers/CartController.php';
        break;
    default:
        require __DIR__ . '/../app/views/NotFound.php';
        break;
}