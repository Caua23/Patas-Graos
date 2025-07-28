<?php
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
?>
<header>
    <div>
        <img src="<?php echo $basePath; ?>/assets/img/logoSemFundo.png" alt="">
    </div>
    <div class="menu">
        <ul>
            <li>
                <a href="<?php echo $basePath; ?>/">Home</a>
            </li>
            <li>
                <a href="<?php echo $basePath; ?>/sobre">Sobre Nos</a>
            </li>
            <li>
                <a href="<?php echo $basePath; ?>/catalogo">Catalogo</a>
            </li>
            <li>
                <a href="<?php echo $basePath; ?>/carrinho">Carrinho</a>
            </li>
            <li>
                <a href="<?php echo $basePath; ?>/login">Fazer login</a>
            </li>
        </ul>
    </div>
</header>