


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça login</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/login.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="shortcut icon" href="<?php echo $basePath; ?>/assets/img/logo.jpeg" type="image/x-icon">
</head>

<body>
    <main>

        <div class="loginBackgroundf"></div>
        <form action="<?php echo $basePath; ?>/api/login" method="POST">
            
            <div class="title">
                
                <button class="back-button" onclick="window.history.back()">
                    <img src="<?php echo $basePath; ?>/assets/img/setaVoltar.png" alt="Voltar">
                </button>
        
                <h1>🐾Se identifique para os gatinhos🐾</h1>
                <h3> Bem-vindo ao Patas e Grãos!</h3>
            </div>
            <div Class="inputs">
                <input type="email" name="email" class="email-box" placeholder="Insira seu email">
                <input type="password" name="password" class="pass-box" placeholder="Insira sua senha">
                <input type="submit" value="Entrar">
            </div>
        </form>
    </main>

</body>

</html>