
<div class="card" id="<?= $product['id']; ?>">
    <?php
        if ($product['img']) {
            $isExternal = preg_match('/^https?:\/\//', $product['img']);
            $imgSrc = $isExternal 
                ? $product['img'] 
                : $basePath . '/assets/img/tmp/' . $product['img'];
        } else {
            $imgSrc = $basePath . '/assets/img/tmp/default.jpg';
        }
    ?>
    <img src="<?= $imgSrc; ?>" alt="" class="image">
    <div class="content">
        <div>
            <h2><?= $product['name']; ?></h2>
            <p>R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>

        </div>
        <div class="description">
            <p><?= $product['description']; ?></p>
            <span><?= $product['amount']; ?></span>
        </div>
        <div class="actions" onclick="comprar( <?= $product['id']; ?> )">
            <button class="add-to-cart">Adicionar ao Carrinho</button>
        </div>
    </div>
</div>
