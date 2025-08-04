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
        require_once __DIR__ . '/../app/controllers/CartController.php';
        $cartController = new CartController();
        $cartController->showCart();
        break;

    case '/login':
        require __DIR__ . '/../app/controllers/LoginController.php';
        break;
    case '/api/login':
        $AuthController = require __DIR__ . '/../app/controllers/AuthController.php';
        $AuthController->login(
            $_POST['email'] ?? '',
            $_POST['password'] ?? ''
        );
        break;
    case '/api/products/getAll':
        $ProductController = require __DIR__ . '/../app/controllers/ProductController.php';
        return $ProductController->getAllProdutcs();
    case '/api/products/get/{id}':
        $ProductController = require __DIR__ . '/../app/controllers/ProductController.php';
        $id = $_GET['id'] ?? null;
        return $ProductController->getProductById($id);
    case '/api/products/create':
        $ProductController = require __DIR__ . '/../app/controllers/ProductController.php';
        $ProductController->createProduct(
            $_POST['name'] ?? '',
            $_POST['description'] ?? '',
            (float) ($_POST['price'] ?? 0),
            $_POST['img'] ?? '',
            (int) ($_POST['idAdmin'] ?? 0),
        );//string $name, string $description, float $price, string $image, int $idAdmin
        break;

    default:
        require __DIR__ . '/../app/views/NotFound.php';
        break;
}
