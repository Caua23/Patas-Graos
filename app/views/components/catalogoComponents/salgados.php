<?php
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/products/getAll?category=SALGADOS";

$dadosJson = file_get_contents($url);
$products = json_decode($dadosJson, true);


?>

<div class="demo">
    <?php
    
    foreach ($products as $product) {
        require __DIR__ . '/card.php';
    }
    ?>
</div>