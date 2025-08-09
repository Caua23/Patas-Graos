<?php
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/products/getAll";

$dadosJson = file_get_contents($url);
$products = json_decode($dadosJson, true);

?>
<style>
    .demo {
        background-image: url("<?php echo $basePath; ?>/assets/img/fundo.jpg");
    }
</style>
<div class="demo">
    <?php
    foreach ($products as $product) {
        require __DIR__ . '/cardEditar.php';
    }
    ?>
    <div>
        <div>
            <form class="product-form hidden">
                <i data-lucide="arrow-left" onclick="hiddenUpdateProduct()"
                    style="background-color: #2a9df4; border-radius: 15px; cursor: pointer; width: 50px; height: 50px;">

                </i>
                <h2>Adicionar Produto</h2>

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="price">Preço (R$):</label>
                    <input type="number" step="0.01" min="0" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <input type="text" id="category" name="category" required>
                </div>

                <div class="form-group">
                    <label for="amount">Quantidade:</label>
                    <input type="number" min="0" id="amount" name="amount" required>
                </div>

                <div class="form-group full-width">
                    <label for="description">Descrição:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group full-width">
                    <label for="img">URL da Imagem:</label>
                    <input type="url" id="img" name="img">
                </div>

                <button type="submit">Salvar Produto</button>
            </form>

        </div>

    </div>
</div>