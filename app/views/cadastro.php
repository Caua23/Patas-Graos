<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/cadastro.css?v=<?php echo time(); ?>">
    <title>Cadastro</title>
</head>
<body>
    <main>
    <div class="loginBackgroundf"></div>
        <!--action="<?php echo $basePath; ?>/api/login"-->
        <form id="form">
            <a class="back-button" onclick="window.history.back()">
                <img src="<?php echo $basePath; ?>/assets/img/setaVoltar.png" alt="Voltar">
            </a>
            <div class="title">
                <h1>🐈Se identifique para os gatinhos</h1>
                <h3> Bem-vindo ao Patas e Grãos!</h3>
            </div>
            <div Class="inputs">
                <input type="text" name="name" class="name-box" placeholder="Insira seu nome">
                <input type="email" name="email" class="email-box" placeholder="Insira seu email">
                <input type="text" name="phone" class="phone-box" placeholder="Insira seu número de telefone">
                <input type="password" name="password" class="pass-box" placeholder="Insira sua senha">
                <input type="submit" value="Entrar">
            </div>
        </form>
      </main>  
      <script src="<?php echo $basePath; ?>/assets/js/cadastro.js?v=<?php echo time(); ?>"></script>
</body>
</html>