<?php 
$total = 0;
foreach ($pedido['produtos'] as $item) {
    $total += $item['quantidade'] * ($item['price'] ?? 0);
}
?>

<div class="card">
    <div class="pedido-content">
        <div class="table-products">
            <table cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Valor (R$)</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedido['produtos'] as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']); ?></td>
                            <td>
                                <?= isset($product['price']) 
                                    ? number_format($product['price'], 2, ',', '.') 
                                    : 'N/A'; ?>
                            </td>
                            <td><?= (int)$product['quantidade']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="total">
            <h1>Preço total: R$ <?= number_format($total, 2, ',', '.'); ?></h1>
        </div>
    </div>
</div>
