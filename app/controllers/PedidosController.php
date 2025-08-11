<?php
require_once __DIR__ . '/../../config/db.php';

class PedidosController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getPedidos()
    {
        header('Content-Type: application/json');
        try {

            $stmtPedidos = $this->db->prepare("SELECT id, payment, status, table_number FROM pedido ORDER BY id DESC");
            $stmtPedidos->execute();
            $pedidos = $stmtPedidos->fetchAll(PDO::FETCH_ASSOC);

            if (!$pedidos) {
                http_response_code(404);
                echo json_encode(['error' => 'Nenhum pedido encontrado.']);
                return;
            }

            // Pega os ids dos pedidos para usar no IN()
            $pedidoIds = array_column($pedidos, 'id');
            $inQuery = implode(',', array_fill(0, count($pedidoIds), '?'));

            // Busca os produtos dos pedidos juntando com produtos para pegar o nome
            $stmtProdutos = $this->db->prepare("
    SELECT pp.fk_pedido_id, p.name, p.price, pp.amount 
    FROM pedido_produto pp
    JOIN produtos p ON pp.id_produtos = p.id
    WHERE pp.fk_pedido_id IN ($inQuery)
");

            $stmtProdutos->execute($pedidoIds);
            $produtosRaw = $stmtProdutos->fetchAll(PDO::FETCH_ASSOC);

            // Agrupa os produtos por pedido_id
            $produtosPorPedido = [];
            foreach ($produtosRaw as $p) {
                $produtosPorPedido[$p['fk_pedido_id']][] = [
                    'name' => $p['name'],
                    'quantidade' => (int) $p['amount'],
                    'price' => (float) $p['price']
                ];
            }

            // Monta o resultado final
            $result = [];
            foreach ($pedidos as $pedido) {
                $result[] = [
                    'pedido_id' => (int) $pedido['id'],
                    'payment' => $pedido['payment'],
                    'status' => $pedido['status'],
                    'table_number' => $pedido['table_number'],
                    'produtos' => $produtosPorPedido[$pedido['id']] ?? []
                ];
            }

            echo json_encode($result);

        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao buscar pedidos', 'message' => $e->getMessage()]);
        }
    }


}