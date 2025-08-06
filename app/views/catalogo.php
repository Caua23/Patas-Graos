
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/catalogo.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/header.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="<?php echo $basePath; ?>/assets/img/logo.jpeg" type="image/x-icon">
    <style>
    .card {
        overflow: hidden;
        margin: 16px;
        width: 350px;
        height: 400px;
        text-align: center;
        background-color:#341d08;
        color: white;
        font: 600 14px 'Arial', sans-serf;
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
        border-radius: 0px;
        padding: 20px 25px;
        cursor: pointer;
        font: 500 14px 'Arial', sans-serif;
    }



    
</style>    
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