<?php
// Exemplo de array de produtos no carrinho
$carrinho = [
    ['nome' => 'Produto A', 'quantidade' => 2, 'valor' => 49.90],
    ['nome' => 'Produto B', 'quantidade' => 1, 'valor' => 79.90],
    ['nome' => 'Produto C', 'quantidade' => 3, 'valor' => 19.90],
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/header.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/carrinho.css?v=<?= time() ?>" />
    <link rel="shortcut icon" href="<?= $basePath ?>/assets/img/logo.jpeg" type="image/x-icon" />
    <title>Carrinho</title>
</head>

<body>
    <?php require __DIR__ . '/components/header.php'; ?>

    <main>
        <section aria-label="Resumo do carrinho" class="resumo">
            <div class="valor-a-pagar">
                <p>Valor a pagar:</p>
                <p><strong>
                    R$ <?= number_format(array_sum(array_map(fn($item) => $item['quantidade'] * $item['valor'], $carrinho)), 2, ',', '.') ?>
                </strong></p>
            </div>

            <div class="line" ></div>

            <table>
                <thead>
                    <tr>
                        <th scope="col">Qtd</th>
                        <th scope="col">Item</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrinho as $item): ?>
                        <tr>
                            <td><?= (int) $item['quantidade'] ?></td>
                            <td><?= htmlspecialchars($item['nome']) ?></td>
                            <td>R$ <?= number_format($item['quantidade'] * $item['valor'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="line" ></div>
        </section>

        <section aria-label="Método de pagamento" class="pagamento">
            <h2>Escolha o método de pagamento</h2>
            <form method="POST">
                <fieldset>
                    <legend>Método de pagamento</legend>

                    <div class="payment-method">
                        <label for="pagamento-pix">
                            <input type="radio" name="metodo_pagamento" id="pagamento-pix" value="pix" required />
                            <div>
                                <img src="" alt="">
                                Pix
                            </div>
                        </label>
                    </div>

                    <div class="payment-method">
                        <label for="pagamento-cartao">
                            <input type="radio" name="metodo_pagamento" id="pagamento-cartao" value="cartao" />
                            <div>
                                <img src="" alt="">
                                Cartão
                            </div>
                        </label>
                    </div>

                    <div class="payment-method">
                        <label for="pagamento-dinheiro">
                            <input type="radio" name="metodo_pagamento" id="pagamento-dinheiro" value="dinheiro" />
                            <div>
                                <img src="" alt="">
                                Dinheiro
                            </div>
                        </label>
                    </div>

                    <button type="submit">Finalizar Compra</button>
                </fieldset>
            </form>
        </section>
    </main>

    <script src="<?= $basePath ?>/assets/js/carrinho.js?v=<?= time() ?>"></script>
</body>

</html>
