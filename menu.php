<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('location: logoff');
    }
    
    if(isset($_SESSION['message'])) {
        echo "<script> alert('" . $_SESSION['message'] . "'); </script>";

        unset($_SESSION['message']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Táxi do Jair || Menu</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <div class="login">
            <div>Bem-vindo(a), <?php echo $_SESSION['name']; ?>!</div>
            <br>
            <br>
            <input type="submit" class="button" value="Corridas" onclick="goPage('corridas')">
            <br>
            <br>
            <input type="submit" class="button" value="Relatórios" onclick="goPage('relatorios')">
            <br>
            <br>
            <input type="submit" class="button" value="Despesas" onclick="goPage('despesas')">
            <br>
            <br>
            <?php if($_SESSION['admin'] == 'x') : ?>
                <input type="submit" class="button" value="Cadastro" onclick="goPage('cadastro')">
            <?php endif; ?>
            <br>
            <br>
            <input type="submit" class="buttondesc" value="Desconectar" onclick="goPage('logoff')">
        </div>
    </body>
