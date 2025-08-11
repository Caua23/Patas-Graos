<?php

$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/pedidos/get";

$dadosJson = file_get_contents($url);
$pedidos = json_decode($dadosJson, true);

?>

<div class="demo">
    <?php
    foreach($pedidos as $pedido){
        require __DIR__  . "/cardPedidos.php";
    }
    ?>
</div>