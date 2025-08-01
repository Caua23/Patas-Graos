
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patas&Grãos</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/header.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="<?php echo $basePath; ?>/assets/img/logo.jpeg" type="image/x-icon">
</head>
<body>
    <?php require __DIR__ . '/components/header.php'; ?>
    <main>
        <div class="backgroundF"></div>
        <div class="main-text">
            <div>
                <h1>Bem-vindo ao Patas&Grãos</h1>
                <p>Um lugar para desacelerar com café e gatos.</p>
            </div>
            <div>
                <button onclick="window.location.href = '<?php echo $basePath; ?>/sobre'">Saiba Mais Sobre nós</button>
                <button onclick="window.location.href = '<?php echo $basePath; ?>/catalogo'">Catálogo</button>
            </div>
        </div>
    </main>
</body>
</html>