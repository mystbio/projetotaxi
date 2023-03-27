<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('location: logoff');
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("config.php");

        $conn = open_database();

        $sql = "select * from `tbUser` where username = '" . $_POST['username'] . "'";

        $result = $conn->query($sql);

        $count = mysqli_affected_rows($conn);

        if($count > 0) {
            close_database($conn);

            $_SESSION['message'] = "Usuário já cadastrado!!!";

            header('location: menu');
        }

        $sql = "select ifnull(query.newcode, 0) + 1 as newcode from (select max(coduser) as newcode from `tbUser`) as query";

        $result = $conn->query($sql);

        foreach($result as $row) {
            $sql = "insert into `tbUser` (coduser, name, username, password, admin) values(".$row['newcode'].", '".$_POST['name']."', '".$_POST['username']."', '".$_POST['password']."', '')";

            $result = $conn->query($sql);
        }

        close_database($conn);

        $_SESSION['message'] = "Usuário cadastrado com sucesso!!!";

        header('location: menu');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Táxi do Jair || Cadastro</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <div class="login">
            <h1>Cadastro</h1>
            <br>
            <br>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="username">Nome:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <br>
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <br>
                <input type="submit" class="button" value="Cadastrar">
            </form>
            <br>
            <br>
            <a href="menu" class="cadastro" style="font-size: 20px;text-decoration: none;color: #fff;">Voltar</a>
        </div>
    </body>
</html>
