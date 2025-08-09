
<?php
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/products/getAll";

$dadosJson = file_get_contents($url);
$products = json_decode($dadosJson, true);
?>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    .destaques{
        color: white;
        background-image: url('<?php echo $basePath; ?>/assets/img/tmp/wafflesDest.png');
        background-size: cover;
        background-position: center;
        height: 300px;
        width: 110%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: start;
        padding-left: 50px;
        font: 500 20px 'Montserrat', sans-serif;
        border-radius: 0px;
    }
    .destaques p{
        font: 500 16px 'Montserrat', sans-serif;
        margin-top: 10px;
        max-width: 350px;
    }

    .demo{
        background-image: url('<?php echo $basePath; ?>/assets/img/fundo.jpg');
        background-repeat: none;
        border-radius: 0px;
    }
    
</style>
<div class="destaques">
    <h1>Waffles da Casa</h1>
    <p>Melhores Waffles da america, feitos com os melhores ingredientes e gatinhos</p>
</div>
<div class="demo">
    <?php
    
    foreach ($products as $product) {
        require __DIR__ . '/card.php';
    }
    ?>
</div>