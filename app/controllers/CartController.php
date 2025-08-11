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

    public function getProductsFromCart()
    {
        $stmt = $this->db->query("SELECT id FROM carrinho LIMIT 1");
        $carrinho = $stmt->fetch(PDO::FETCH_ASSOC);
        $carrinho_id = $carrinho['id'];
        $stmt = $this->db->prepare("
        SELECT p.id, p.name, p.price, p.description, p.img, cp.amount
        FROM carrinho_produtos cp
        JOIN produtos p ON cp.id_produtos = p.id
        WHERE cp.fk_carrinho_id = :carrinho_id
    ");
        $stmt->execute([':carrinho_id' => $carrinho_id]);
        $produtosRaw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($produtosRaw as $item) {
            $result[] = [
                'produto' => [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'img' => $item['img']
                ],
                'quantidade' => (int) $item['amount']
            ];
        }

        return json_encode($result);
    }
    public function checkout(string $paymentMethod, int $tableNumber = null)
{
    try {
        $this->db->beginTransaction();

        $stmt = $this->db->query("SELECT id FROM carrinho LIMIT 1");
        $carrinho = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$carrinho) {
            throw new Exception("Carrinho vazio");
        }
        $carrinho_id = $carrinho['id'];

        $produtos = json_decode($this->getProductsFromCart(), true);
        if (empty($produtos)) {
            throw new Exception("Carrinho está vazio");
        }

        $insertPedido = $this->db->prepare("
            INSERT INTO pedido (payment, status, table_number)
            VALUES (:payment, :status, :table_number)
        ");

        $insertPedido->execute([
            ':payment' => $paymentMethod,
            ':status' => 'pendente',
            ':table_number' => $tableNumber
        ]);

        $pedido_id = $this->db->lastInsertId();

        $insertPedidoProduto = $this->db->prepare("
            INSERT INTO pedido_produto (id_produtos, amount, fk_pedido_id)
            VALUES (:id_produto, :amount, :pedido_id)
        ");
        $total = 0;
        foreach ($produtos as $p) {
            $total =+ $p['produto']['price'] * $p['quantidade'];
            $insertPedidoProduto->execute([
                ':id_produto' => $p['produto']['id'],
                ':amount' => $p['quantidade'],
                ':pedido_id' => $pedido_id
            ]);
        }

        
        $deleteCarrinhoProdutos = $this->db->prepare("DELETE FROM carrinho_produtos WHERE fk_carrinho_id = :carrinho_id");
        $deleteCarrinhoProdutos->execute([':carrinho_id' => $carrinho_id]);

        $this->db->commit();

        $redirect = $paymentMethod == 'dinheiro' ? '/pago' : '/api/qrcode/';

        http_response_code(200);
        
        return json_encode([
            'success' => true,
            'pedido_id' => $pedido_id,
            'redirect' => $redirect,
            'total' => $total
        ]);

    } catch (\Throwable $e) {
        $this->db->rollBack();
        http_response_code(500);
        return json_encode([
            'error' => 'Erro ao finalizar pedido',
            'message' => $e->getMessage()
        ]);
    }
}


    public function addProduct(array $listOfProducts)
    {
        try {
            $stmt = $this->db->query("SELECT id FROM carrinho LIMIT 1");
            $carrinho = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$carrinho) {
                $stmt = $this->db->prepare("INSERT INTO carrinho () VALUES ()");
                $stmt->execute();
                $carrinho_id = $this->db->lastInsertId();
            } else {
                $carrinho_id = $carrinho['id'];
            }

            $checkStmt = $this->db->prepare("SELECT id, amount FROM carrinho_produtos WHERE fk_carrinho_id = :carrinho_id AND id_produtos = :id_produto");
            $updateStmt = $this->db->prepare("UPDATE carrinho_produtos SET amount = amount + :amount WHERE id = :id");
            $insertStmt = $this->db->prepare("INSERT INTO carrinho_produtos (id_produtos, amount, fk_carrinho_id) VALUES (:id_produto, :amount, :carrinho_id)");

            foreach ($listOfProducts as $produto) {
                if (!isset($produto['idProduto'], $produto['quantidade']) || $produto['quantidade'] <= 0) {
                    continue;
                }

                $checkStmt->execute([
                    ':carrinho_id' => $carrinho_id,
                    ':id_produto' => $produto['idProduto']
                ]);
                $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

                if ($existing) {
                    $updateStmt->execute([
                        ':amount' => $produto['quantidade'],
                        ':id' => $existing['id']
                    ]);
                } else {
                    $insertStmt->execute([
                        ':id_produto' => $produto['idProduto'],
                        ':amount' => $produto['quantidade'],
                        ':carrinho_id' => $carrinho_id
                    ]);
                }
            }

            return json_encode(['success' => true, 'carrinho_id' => $carrinho_id]);
        } catch (\Throwable $th) {
            http_response_code(500);
            return json_encode(['error' => 'Erro ao adicionar produto ao carrinho', 'message' => $th->getMessage()]);
        }
    }



}

new CartController();