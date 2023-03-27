<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('location: logoff');
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("config.php");

        $conn = open_database();

        $sql = "select ifnull(query.newcode, 0) + 1 as newcode from (select max(codcorrida) as newcode from `tbCorridas`) as query";

        $result = $conn->query($sql);

        foreach($result as $row) {
            $datahora = new DateTime();
            $datahora->modify('- 3 hours');

            $sql = "insert into `tbCorridas` (codcorrida, codtipo, coduser, datahora, kmini, kmfim, valor, descricao) values(".$row['newcode'].", " . $_POST['tipo-pagamento'] . ", " . $_SESSION['coduser'] . ", '" . $datahora->format("Y-m-d H:i:s") . "', " . $_POST['kmini'] . ", " . $_POST['kmfim'] . ", " . $_POST['valor-cobrado'] . ", '" . $_POST['descricao'] . "')";

            //echo '<script> console.log( "' . $sql . '" );  </script>';

            $result = $conn->query($sql);
        }

        close_database($conn);

        $_SESSION['message'] = "Lançamento efetuado!!!";

        header('location: menu');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Táxi do Jair || Corridas</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <div class="login">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="kmini">Km Inicial:</label>
                <input
                    type="number"
                    id="kmini"
                    name="kmini"
                    value=""
                    required
                >
                <br>
                <br>
                <label for="kmfim">Km Final:</label>
                <input
                    type="number"
                    id="kmfim"
                    name="kmfim"
                    value=""
                    required
                >
                <br>
                <br>
                <label for="tipo-pagamento">Tipo de pagamento:</label>
                <select id="tipo-pagamento" name="tipo-pagamento" onchange="setVisible()">

                <?php
                    require_once("config.php");

                    $conn = open_database();
            
                    $sql = "select * from `tbTipoPGTO` order by codtipo";
            
                    $result = $conn->query($sql);

                    foreach($result as $row) :
                ?>
                    <option value="<?php echo $row['codtipo']; ?>"><?php echo $row['descricao']; ?></option>
                <?php endforeach; ?>

                </select>
                <br>
                <br>
                <label id="lbdescr" for="descricao" class="hidden">Nome</label>
                <input
                    type="text"
                    class="hidden"
                    id="descricao"
                    name="descricao"
                    value=""
                >
                <br>
                <br>
                <label for="valor-cobrado">Valor cobrado:</label>
                <input
                    type="number"
                    id="valor-cobrado"
                    name="valor-cobrado"
                    value=""
                    required
                >
                <br>
                <br>
                <input type="submit" class="button" value="Salvar">
            </form>
            <br>
            <br>
            <a href="menu" class="cadastro" style="font-size: 20px;text-decoration: none;color: #fff;">Voltar</a>
        </div>
    </body>
</html>
