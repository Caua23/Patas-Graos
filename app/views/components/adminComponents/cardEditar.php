
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
    <picture class="picture-container">
        <img src="<?= $imgSrc; ?>" alt="" class="image">
        <button onclick="showUpdateProduct(<?= $product['id']; ?>)"><i data-lucide="pen"></i></button>
        <button onclick="deleteProduct(<?= $product['id']; ?>)" style="right: 50px; "><i data-lucide="trash"></i></button>
        
    </picture>

    <div class="content">
        <div>
            <h2><?= $product['name']; ?></h2>
            <p>R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>

        </div>
        <div class="description">
            <p><?= $product['description']; ?></p>
            <span><?= $product['amount']; ?></span>
        </div>
        <!-- <div class="actions">
            <button class="add-to-cart">Adicionar ao Carrinho</button>
        </div> -->
    </div>
</div>