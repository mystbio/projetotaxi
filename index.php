<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("config.php");

        $conn = open_database();

        $sql = "select * from `tbUser` where username = '" . $_POST['username'] . "'";

        $result = $conn->query($sql);

        $count = mysqli_affected_rows($conn);

        close_database($conn);

        if($count > 0) {
            foreach($result as $row) {
                if($_POST['password'] == $row['password']) {
                    $_SESSION['coduser'] = $row['coduser'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['admin'] = $row['admin'];

                    header('location: menu');
                } else {
                    $_SESSION['message'] = "Senha inválida";
                }
            }
        } else {
            $_SESSION['message'] = "Usuário não existe";
        }
    }

    if(isset($_SESSION['username'])) {
        header('location: menu');
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
        <title>Táxi do Jair</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <br>
            <form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="username">Nome:</label>
                <input type="text" id="username" name="username">
                <br>
                <br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password">
                <br>
                <br>
                <br>
                <input style="padding-left: 40px; padding-right: 40px;" type="submit" class="button" value="Entrar">
            </form>
        </div>
    </body>
</html>
