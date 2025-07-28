<?php

$scriptName = $_SERVER['SCRIPT_NAME'];
$requestUri = $_SERVER['REQUEST_URI'];


$basePath = str_replace('/index.php', '', $scriptName);
$path = parse_url($requestUri, PHP_URL_PATH);


if (strpos(strtolower($path), strtolower($basePath)) === 0) {
    $route = substr($path, strlen($basePath));
} else {
    $route = $path;
}

$route = rtrim($route, '/');
if ($route === '') {
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
        require __DIR__ . '/../app/controllers/CatalogoController.php';
        break;
    case '/carrinho':
        require __DIR__ . '/../app/controllers/CartController.php';
        break;
    case '/login':
        require __DIR__ . '/../app/controllers/LoginController.php';
        break;
    default:
        require __DIR__ . '/../app/views/NotFound.php';
        break;
}
