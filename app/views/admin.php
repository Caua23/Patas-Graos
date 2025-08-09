<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/header.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="<?= $basePath ?>/assets/img/logo.jpeg" type="image/x-icon" />
    <title>Página de administrador</title>
</head>

<body>
    <?php require __DIR__ . '/components/header.php'; ?>
    <div class="container">
        <?php require __DIR__ . '/components/adminAside.php'; ?>
        <main>

            <?php
            $type = $_GET['type'] ?? null;
            switch ($type) {
                case 'adicionar':
                    require __DIR__ . '/components/adminComponents/adicionar.php';
                    break;
                case 'editar':
                    require __DIR__ . '/components/adminComponents/editar.php';
                    break;
                case 'pedidos':
                    require __DIR__ . '/components/adminComponents/pedidos.php';
                    break;
                default:
                    echo '<script>
                                    if (!(window.location.pathname === "' . $basePath . '/admin" && window.location.search === "?type=adicionar")) {
                                        window.location.href = "' . $basePath . '/admin?type=adicionar";
                                    }
                                </script>';
                    break;

            }
            ?>

        </main>
    </div>
    <script src="<?php echo $basePath; ?>/assets/js/admin.js?v=<?php echo time(); ?>"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>