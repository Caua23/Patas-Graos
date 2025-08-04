<?php 
require_once __DIR__ . '/../../config/db.php';

class ProdutoController {
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getProductById($id) {
        header('Content-Type: application/json');
        try {
            if($id <= 0) {
                http_response_code(400);
                return json_encode(['error' => 'ID inválido.']);
            }

            $produtcs = $this->db->prepare('SELECT * FROM produtos WHERE id = :id');
            $produtcs->bindParam(':id', $id, PDO::PARAM_INT);
            $produtcs->execute();
            $produto = $produtcs->fetch(PDO::FETCH_ASSOC);
            
            if (!$produto) {
                http_response_code(404);
                return json_encode(['error' => 'Produto não encontrado.']);
            }
            http_response_code(200);
            return json_encode($produto);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao buscar produto.']);
        }
    }

    public function getAllProdutcs() {
        header('Content-Type: application/json');
        try {
            $produtos = $this->db->query('SELECT * FROM produtos')->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($produtos);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao buscar produtos.']);
        }  
    }

    public function createProduct(string $name, string $description, float $price, string $img, int $idAdmin) {
        header('Content-Type: application/json');
        try {
            if(empty($name) || empty($description) || $price <= 0 || empty($price) || empty($img) || $idAdmin <= 0 || !is_numeric($price)) {
                http_response_code(400);
                return json_encode(['error' => 'Dados inválidos verifique novamente.']);
            }
            $query = $this->db->prepare('INSERT INTO produtos (name, desc, price, img, id_admin) VALUES (:name, :description, :price, :img, :idAdmin)');
            
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao criar produto.']);
        }
    }
}

new ProdutoController();