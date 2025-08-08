
<?php
$basePath = str_replace('/index.php', '', $scriptName);

$url = "http://localhost" . $basePath . "/api/products/getAll";

$dadosJson = file_get_contents($url);
$produtos = json_decode($dadosJson, true);
?>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    .destaques{
        color: white;
        background-image: url('<?php echo $basePath; ?>/assets/img/tmp/wafflesDest.png');
        background-size: cover;
        background-position: center;
        height: 300px;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: start;
        padding-left: 50px;
        font: 500 20px 'Montserrat', sans-serif;
        border-radius: 30px;
    }
    .destaques p{
        font: 500 16px 'Montserrat', sans-serif;
        margin-top: 10px;
        max-width: 350px;
    }
</style>
<div class="destaques">
    <h1>Waffles da Casa</h1>
    <p>Melhores Waffles da america, feitos com os melhores ingredientes e gatinhos</p>
</div>
<div class="demo">
    <?php
    $products = [
        [
            'id' => 1,
            'name' => 'Waffle de Morango',
            'price' => 'R$ 19,90',
            'description' => 'Com calda de morango',
            'quantity' => 10,
            'image' => 'wafflesMorango.png'
        ],
        [
            'id' => 2,
            'name' => 'Waffle de Chocolate',
            'price' => 'R$ 21,90',
            'description' => 'Com cobertura de chocolate',
            'quantity' => 5,
            'image' => 'wafflesChocolate.png'
        ],
        [
            'id' => 232,
            'name' => 'Chocolate de waffle ',
            'price' => 'R$ 31,90',
            'description' => 'Com cobertura de waffles',
            'quantity' => 553,
            'image' => 'wafflesChocolate.png'
        ],
        [
            'id' => 232,
            'name' => 'Chocolate de waffle ',
            'price' => 'R$ 31,90',
            'description' => 'Com cobertura de waffles',
            'quantity' => 553,
            'image' => 'wafflesChocolate.png'
        ],
        [
            'id' => 232,
            'name' => 'Chocolate de waffle ',
            'price' => 'R$ 31,90',
            'description' => 'Com cobertura de waffles',
            'quantity' => 553,
            'image' => 'wafflesChocolate.png'
        ],
    ];

    foreach ($products as $product) {
        require __DIR__ . '/card.php';
    }
    ?>
</div>