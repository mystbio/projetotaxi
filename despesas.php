<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('location: logoff');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Táxi do Jair || Despesas</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <div class="login">
            <h1>Despesas</h1>
            <br>
            <form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="gnv">GNV:</label>
                <input type="number" id="gnv" name="gnv">
                <br>
                <br>
                <label for="pedagio">Pedágio:</label>
                <input type="number" id="pedagio" name="pedagio">
                <br>
                <br>
                <br>
                <input style="padding-left: 40px; padding-right: 40px;" type="submit" class="button" value="Salvar">
            </form>
        </div>
    </body>
</html>
