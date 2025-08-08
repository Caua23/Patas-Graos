<?php
require_once __DIR__ . '/../../config/db.php';

class ProdutoController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getProductById($id)
    {
        header('Content-Type: application/json');
        try {
            if ($id <= 0) {
                http_response_code(400);
                return json_encode(['error' => 'ID inválido.']);
            }

            $stmt = $this->db->prepare('SELECT * FROM produtos WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

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

    public function getAllProducts()
    {
        header('Content-Type: application/json');
        try {
            $produtos = $this->db->query('SELECT * FROM produtos')->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($produtos);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao buscar produtos.']);
        }
    }

    public function createProduct(string $name, string $description, float $price, int $amount, string $category, int $idAdmin)
    {
        header('Content-Type: application/json');
        try {
            if (empty($name) || empty($description) || $price <= 0 || $amount < 0 || empty($category) || $idAdmin <= 0) {
                http_response_code(400);
                return json_encode(['error' => 'Dados inválidos, verifique novamente.']);
            }

            $query = $this->db->prepare(
                'INSERT INTO produtos (name, descricao, price, amount, category, id_adm) 
             VALUES (:name, :descricao, :price, :amount, :category, :id_adm)'
            );

            $query->bindParam(':name', $name);
            $query->bindParam(':descricao', $description);
            $query->bindParam(':price', $price);
            $query->bindParam(':amount', $amount);
            $query->bindParam(':category', $category);
            $query->bindParam(':id_adm', $idAdmin);

            $query->execute();

            http_response_code(201);
            return json_encode(['success' => 'Produto criado com sucesso.']);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao criar produto.', 'details' => $e->getMessage()]);
        }
    }
}
