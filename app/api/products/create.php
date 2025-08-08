<?php
require_once __DIR__ . '/../../controllers/ProductController.php';

$controller = new ProdutoController();
echo $controller->createProduct(
    $_POST['nome'] ?? '',
    $_POST['descricao'] ?? '',
    floatval($_POST['preco'] ?? 0),
    intval($_POST['quantidade'] ?? 0),
    $_POST['categoria'] ?? '',
    1 // ID do admin - depois pegar da sessão
);
