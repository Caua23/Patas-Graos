<?php
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/carrinho/get";

$dadosJson = file_get_contents($url);
$carrinho = json_decode($dadosJson, true) ?? [];

// Cálculo do valor total
$total = array_sum(array_map(fn($item) => $item['quantidade'] * $item['produto']['price'], $carrinho));
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
                    R$ <?= number_format($total, 2, ',', '.') ?>
                </strong></p>
            </div>

            <div class="line"></div>

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
                            <td><?= htmlspecialchars($item['produto']['name']) ?></td>
                            <td>R$ <?= number_format($item['quantidade'] * $item['produto']['price'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="line"></div>
        </section>

        <section aria-label="Método de pagamento" class="pagamento">
            <h2>Escolha o método de pagamento</h2>
            <form id="form">
                <fieldset>
                    <legend>Método de pagamento</legend>

                    <div class="payment-method">
                        <label for="pagamento-pix">
                            <input type="radio" name="payment" id="pagamento-pix" value="pix" required />
                            <div>
                                Pix
                            </div>
                        </label>
                    </div>

                    <div class="payment-method">
                        <label for="pagamento-cartao">
                            <input type="radio" name="payment" id="pagamento-cartao" value="cartao" />
                            <div>
                                
                                Cartão
                            </div>
                        </label>
                    </div>

                    <div class="payment-method">
                        <label for="pagamento-dinheiro">
                            <input type="radio" name="payment" id="pagamento-dinheiro" value="dinheiro" />
                            <div>
                                
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
