<?php
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/products/getAll";

$dadosJson = file_get_contents($url);
$produtos = json_decode($dadosJson, true);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/catalogo.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/header.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="<?php echo $basePath; ?>/assets/img/logo.jpeg" type="image/x-icon">
</head>

<body>
    <?php require __DIR__ . '/components/header.php'; ?>

    <div class="container">
        <?php require __DIR__ . '/components/aside.php'; ?>
        <main>
            <div class="catalog-content">
                <?php
                $type = $_GET['type'] ?? null;
                switch ($type) {
                    case 'destaques':
                        require __DIR__ . '/components/catalogoComponents/destaques.php';
                        break;
                    case 'bebidas':
                        require __DIR__ . '/components/catalogoComponents/bebidas.php';
                        break;
                    case 'salgados':
                        require __DIR__ . '/components/catalogoComponents/salgados.php';
                        break;
                    case 'doces':
                        require __DIR__ . '/components/catalogoComponents/doces.php';
                        break;
                    case 'jardim_felino':
                        require __DIR__ . '/components/catalogoComponents/jardim.php';
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

    <script src="<?php echo $basePath; ?>/assets/js/catalogo.js?v=<?php echo time(); ?>"></script>
</body>

</html>