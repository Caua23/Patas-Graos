
<div class="card" id="<?= $product['id']; ?>">
    <?php
        if ($product['image']) {
            $isExternal = preg_match('/^https?:\/\//', $product['image']);
            $imgSrc = $isExternal 
                ? $product['image'] 
                : $basePath . '/assets/img/tmp/' . $product['image'];
        } else {
            $imgSrc = $basePath . '/assets/img/tmp/default.jpg';
        }
    ?>
    <img src="<?= $imgSrc; ?>" alt="" class="image">
    <div class="content">
        <div>
            <h2><?= $product['name']; ?></h2>
            <p><?= $product['price']; ?></p>
        </div>
        <div class="description">
            <p><?= $product['description']; ?></p>
            <span><?= $product['quantity']; ?></span>
        </div>
        <div class="actions">
            <button class="add-to-cart">Adicionar ao Carrinho</button>
        </div>
    </div>
</div>
