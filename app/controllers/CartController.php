<?php
require_once __DIR__ . '/../../config/db.php';
class CartController
{
    private PDO $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }
    public function showCart()
    {
        include __DIR__ . '/../views/carrinho.php';

    }
    public function getAll($id)
    {
        header('Content-Type: application/json');
        try {
            $query = $this->db->query('SELECT * FROM carrinho WHERE id_ = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $cart = $query->fetchAll(PDO::FETCH_ASSOC);
            if (!$cart) {
                http_response_code(404);
                return json_encode(['error' => 'Carrinho vazio ou não encontrado.']);
            }
            
            http_response_code(200);
            echo json_encode($cart);

        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao buscar carrinho.']);
        }
    }
}