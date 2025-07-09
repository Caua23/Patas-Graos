<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/catalogo.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/header.css">
    <link rel="shortcut icon" href="<?php echo $basePath; ?>/assets/img/logo.jpeg" type="image/x-icon">
</head>

<body>
    <?php require __DIR__ . '/components/header.php'; ?>

    <div class="container">
        <?php require __DIR__ . '/components/Anside.php'; ?>
        <main>
            <div class="catalog-content">
                <?php
                $type = $_GET['type'] ?? null;
                switch ($type) {
                    case 'destaques':
                        echo '<h1>Destaques</h1>';
                        break;
                    case 'bebidas':
                        echo '<h1>Bebidas</h1>';
                        break;
                    case 'salgados':
                        echo '<h1>Salgados</h1>';
                        break;
                    case 'doces':
                        echo '<h1>Doces</h1>';
                        break;
                    case 'jardim_felino':
                        echo '<h1>Jardim Felino</h1>';
                        break;
                    default:
                        echo '<script>
                            if (!(window.location.pathname === "' . $basePath . '/catalogo" && window.location.search === "?type=destaques")) {
                                window.location.href = "' . $basePath . '/catalogo?type=destaques";
                            }
                        </script>';
                        break;

                }
                ?>
            </div>
        </main>
    </div>

    <script src="<?php echo $basePath; ?>/assets/catalogo.js"></script>
</body>

</html>