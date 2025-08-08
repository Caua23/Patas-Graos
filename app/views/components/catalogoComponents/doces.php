<?php
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/products/getAll";

$dadosJson = file_get_contents($url);
$produtos = json_decode($dadosJson, true);
?>
