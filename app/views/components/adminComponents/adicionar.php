<?php

?>

<h1 id="titulo">Adicionar Item</h1>
<div class="add">
    <div class="buttonContainer">
        <button class="addProductButton" onclick="showProduct()">
            <i data-lucide="square-plus"></i>
        </button>
    </div>
    <div>
        <form class="addProduct-form hidden">
            <i data-lucide="arrow-left" onclick="hiddenProduct()"
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
                <select id="category" name="category" required>
                    <option value="DESTAQUES">DESTAQUES</option>
                    <option value="BEBIDAS">BEBIDAS</option>
                    <option value="SALGADOS">SALGADOS</option>
                    <option value="DOCES">DOCES</option>
                    <option value="JARDIMFELINO">JARDIM FELINO</option>
                </select>
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