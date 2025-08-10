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

    public function getAllProducts(int $limit, ?string $category)
    {
        header('Content-Type: application/json');

        try {
            if (!empty($category)) {
                $sql = "SELECT * FROM produtos WHERE category = :category LIMIT $limit";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':category', $category, PDO::PARAM_STR);
            } else {
                $sql = "SELECT * FROM produtos LIMIT $limit";
                $stmt = $this->db->prepare($sql);
            }
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($produtos);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao buscar produtos.']);
        }
    }

    public function createProduct(string $name, string $description, float $price, string $img, string $category, string $amount, int $idAdmin)
    {
        header('Content-Type: application/json');
        try {
            if (empty($name) || empty($description) || $price <= 0 || empty($price) || empty($amount) || empty($category) || empty($img) || $idAdmin <= 0 || !is_numeric($price)) {
                http_response_code(400);
                return json_encode(['error' => 'Dados inválidos verifique novamente.']);
            }
            $adminCheck = $this->db->prepare('SELECT * FROM admin WHERE id = :id');
            $adminCheck->bindParam(':id', $idAdmin, PDO::PARAM_INT);
            $adminCheck->execute();
            if (!$adminCheck->fetch(PDO::FETCH_ASSOC)) {
                http_response_code(404);
                return json_encode(['error' => 'Administrador não encontrado.']);
            }
            $query = $this->db->prepare('INSERT INTO produtos (name, description, price, img, amount, category, id_adm) VALUES (:name, :description, :price, :img, :amount, :category,  :id_adm)');
            $query->execute([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'img' => $img,
                'amount' => $amount,
                'category' => $category,
                'id_adm' => $idAdmin
            ]);
            http_response_code(201);
            return json_encode([
                'success' => 'Produto criado com sucesso.',
                'code' => 201,
                'product' => [
                    'id' => $this->db->lastInsertId(),
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'img' => $img,
                    'amount' => $amount,
                    'category' => $category,
                    'idAdmin' => $idAdmin
                ]
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao criar produto.', 'message' => $e->getMessage()]);
        }
    }

    public function deleteProduct(int $id)
    {
        header('Content-Type: application/json');
        try {
            if ($id <= 0) {
                http_response_code(400);
                return json_encode(['error' => 'ID inválido.']);
            }

            $query = $this->db->prepare('DELETE FROM produtos WHERE id = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            if ($query->execute()) {
                http_response_code(200);
                return json_encode(['success' => 'Produto deletado com sucesso.']);
            } else {
                http_response_code(404);
                return json_encode(['error' => 'Produto não encontrado.']);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao deletar produto.', 'message' => $e->getMessage()]);
        }
    }
    public function updateProduct(int $id, array $data)
    {
        header('Content-Type: application/json');

        try {
            if ($id <= 0) {
                http_response_code(400);
                return json_encode(['error' => 'ID inválido.']);
            }

            $stmt = $this->db->prepare('SELECT * FROM produtos WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $products = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$products) {
                http_response_code(404);
                return json_encode(['error' => 'Produto não encontrado.']);
            }

            $name = isset($data['name']) && trim($data['name']) !== '' ? $data['name'] : $products['name'];
            $description = isset($data['description']) && trim($data['description']) !== '' ? $data['description'] : $products['description'];
            $price = isset($data['price']) && $data['price'] > 0 ? (float) $data['price'] : (float) $products['price'];
            $img = isset($data['img']) && trim($data['img']) !== '' ? $data['img'] : $products['img'];
            $category = isset($data['category']) && trim($data['category']) !== '' ? $data['category'] : $products['category'];
            $amount = isset($data['amount']) && trim($data['amount']) !== '' ? (int) $data['amount'] : (int) $products['amount'];

            $updateStmt = $this->db->prepare(
                'UPDATE produtos SET name = :name, description = :description, price = :price, img = :img, category = :category, amount = :amount WHERE id = :id'
            );

            $updateStmt->bindValue(':id', $id, PDO::PARAM_INT);
            $updateStmt->bindValue(':name', $name, PDO::PARAM_STR);
            $updateStmt->bindValue(':description', $description, PDO::PARAM_STR);
            $updateStmt->bindValue(':price', $price);
            $updateStmt->bindValue(':img', $img, PDO::PARAM_STR);
            $updateStmt->bindValue(':category', $category, PDO::PARAM_STR);
            $updateStmt->bindValue(':amount', $amount, PDO::PARAM_INT);
            $updateStmt->execute();

            http_response_code(200);
            return json_encode(['success' => 'Produto atualizado com sucesso.']);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode([
                'error' => 'Erro ao atualizar produto.',
                'message' => $e->getMessage()
            ]);
        }
    }


}

new ProdutoController();