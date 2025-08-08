<form action="<?php echo $basePath; ?>/api/products/create.php" method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Descrição:</label>
    <textarea name="descricao" rows="4" required></textarea>

    <label>Preço:</label>
    <input type="number" step="0.01" name="preco" required>

    <label>Quantidade:</label>
    <input type="number" name="quantidade" required>

    <label>Categoria:</label>
    <input type="text" name="categoria" required>

    <button type="submit">Cadastrar</button>
</form>
