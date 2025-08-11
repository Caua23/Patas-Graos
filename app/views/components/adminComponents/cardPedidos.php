<?php 
 $products = [
    [
        "nome" => "Café",
        "preco" => 10.25,
        "quantidade" => 2
    ],
    [
        "nome" => "Croissant",
        "preco" => 7.99,
        "quantidade" => 2
    ],
    [
        "nome" => "Água",
        "preco" => 5.99,
        "quantidade" => 3
    ],
];

    $total = 0;
    foreach ($products as $item){
        $total += $item['preco']*$item['quantidade'];
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
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['nome']; ?></td>
                            <td><?= number_format($product['preco'], 2, ',', '.'); ?></td>
                            <td><?= $product['quantidade']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="total">
            <h1>Preço total: <?= $total;?> </h1>
        </div>
    </div>
</div>