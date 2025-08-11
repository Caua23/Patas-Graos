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
function getRequestData(): array
{
    if (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
        return json_decode(file_get_contents("php://input"), true) ?? [];
    }
    return $_POST;
}

if (preg_match('#^/api/products/delete/(\d+)$#', $route, $matches) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    require_once __DIR__ . '/../app/controllers/ProductController.php';
    $ProductController = new ProdutoController();
    $id = $matches[1];
    echo $ProductController->deleteProduct($id);
    exit;
}

if (preg_match('#^/api/products/get/(\d+)$#', $route, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../app/controllers/ProductController.php';
    $ProductController = new ProdutoController();
    $id = $matches[1];
    echo $ProductController->getProductById($id);
    exit;
}

if (preg_match('#^/api/products/update/(\d+)$#', $route, $matches) && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    require_once __DIR__ . '/../app/controllers/ProductController.php';
    $ProductController = new ProdutoController();
    $id = (int) $matches[1];
    $input = getRequestData();

    echo $ProductController->updateProduct($id, $input);
    exit;
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
        $input = getRequestData();
        echo $AuthController->login(
            $input['email'] ?? '',
            $input['password'] ?? ''
        );
        break;

    case '/api/create/user':
        $AuthController = require __DIR__ . '/../app/controllers/AuthController.php';

        $input = getRequestData();

        echo $AuthController->createUser(
            $input['name'] ?? '',
            $input['email'] ?? '',
            $input['phone'] ?? '',
            $input['password'] ?? '',
            $input['role'] ?? ''
        );
        break;
    case '/api/products/getAll':
        require_once __DIR__ . '/../app/controllers/ProductController.php';
        $ProductController = new ProdutoController();
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
        $category = isset($_GET['category']) ? $_GET['category'] : null;

        echo $ProductController->getAllProducts($limit, $category);
        break;
        
    case '/api/products/create':
        require_once __DIR__ . '/../app/controllers/ProductController.php';
        $productController = new ProdutoController();

        $input = getRequestData();
        echo $productController->createProduct(
            $input['name'],
            $input['description'],
            (float) $input['price'],
            $input['img'],
            $input['category'],
            $input['amount'],
            (int) $input['id_adm']
        );

        break;

    case '/api/carrinho/checkout':
        require_once __DIR__ . '/../app/controllers/CartController.php';
        $cartController = new CartController();
        $input = getRequestData();

        $paymentMethod = $input['payment'] ?? 'dinheiro';
        $tableNumber = random_int(1, 10);

        echo $cartController->checkout($paymentMethod, $tableNumber);
        break;

    case '/api/carrinho/add':
        require_once __DIR__ . '/../app/controllers/CartController.php';
        $cartController = new CartController();
        $input = getRequestData();
        if (isset($input['idProduto'], $input['quantidade'])) {
            $input = [$input]; 
        }
        echo $cartController->addProduct($input);
        break;
    case '/api/carrinho/get':
        require_once __DIR__ . '/../app/controllers/CartController.php';
        $cartController = new CartController();
        echo $cartController->getProductsFromCart();

        break;
    default:
        http_response_code(404);
        require __DIR__ . '/../app/views/NotFound.php';
        break;
}
