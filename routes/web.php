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

    case '/admin':
        require __DIR__ . '/../app/controllers/AdminController.php';
        break;
    
    case '/api/login':
        $AuthController = require __DIR__ . '/../app/controllers/AuthController.php';
        echo $AuthController->login(
            $_POST['email'] ?? '',
            $_POST['password'] ?? ''
        );
        break;

    case '/api/create/user':
        $AuthController = require __DIR__ . '/../app/controllers/AuthController.php';
        echo $AuthController->createUser(
            $_POST['name'] ?? '',
            $_POST['email'] ?? '',
            $_POST['phone'] ?? '',
            $_POST['password'] ?? '',
            $_POST['role'] ?? ''
        );
        break;

    case '/api/products/getAll':
        require_once __DIR__ . '/../app/controllers/ProductController.php';
        $ProductController = new ProdutoController();
        echo $ProductController->getAllProdutcs();
        break;
    
    case '/api/products/get/{id}':
        require_once __DIR__ . '/../app/controllers/ProductController.php';
        $ProductController = new ProdutoController();
        $id = $_GET['id'] ?? null;
        echo $ProductController->getProductById($id);
        break;

    case '/api/products/create':
        require_once __DIR__ . '/../app/controllers/ProductController.php';
        $ProductController = new ProdutoController();
        echo $ProductController->createProduct(
            $_POST['name'] ?? '',
            $_POST['description'] ?? '',
            (float) ($_POST['price'] ?? 0),
            $_POST['img'] ?? '',
            $_POST['category'] ?? '',
            $_POST['amount'] ?? '',
            (int) ($_POST['idAdmin'] ?? 0),

        );
        break;

    default:
        require __DIR__ . '/../app/views/NotFound.php';
        break;
}
