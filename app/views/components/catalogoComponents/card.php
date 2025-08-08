<style>
    .card {
        border: 2px solid #ccc;
        border-radius: 25px;
        overflow: hidden;
        margin: 16px;
        width: 280px;
        height: 400px;
        text-align: center;
        background-color:rgb(39, 0, 75);
        color: white;
        font: 600 14px 'Arial', sans-serif;
        user-select: none;
    }

    .card img {
        width: 100%;
        height: 200px;
        margin-bottom: 10px;
        object-fit: cover;
    }

    .card .content {
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        
    }
    .card .content div:first-child {
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;    
    }
    .card .content .description {
        margin-left: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: start;
        align-items: start;
    }
    .card .content .description p{
        max-width: 180px;
        text-align: justify;
    }
    .add-to-cart{
        background-color: rgba(0, 0, 0, 1);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 10px 15px;
        cursor: pointer;
        font: 500 14px 'Arial', sans-serif;
    }
</style>
<div class="card" id="<?= $product['id']; ?>">
    <img src="<?php echo $basePath; ?>/assets/img/tmp/<?= $product['image']; ?>" alt="" class="image">
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