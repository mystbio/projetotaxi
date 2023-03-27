<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('location: logoff');
    }

    $vUserSel = "";
    $vTipoSel = "";

    if(isset($_POST['dateini'])) {
        $newDateini = $_POST['dateini'];
    } else {
        $dateIni = new DateTime();

        $newDateini = date_format($dateIni, "Y-m-d");
    }

    if(isset($_POST['datefim'])) {
        $newDatefim = $_POST['datefim'];
    } else {
        $dateFim = new DateTime();

        $newDatefim = date_format($dateFim, "Y-m-d");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Táxi do Jair || Relatórios</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <div class="login-rel">
            <div class="filter">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="datetimepicker">
                        <input type="date" id="dateini" value="<?php echo $newDateini; ?>" required>
                    </div>
                    <div class="datetimepicker">
                        <input type="date" id="datefim" value="<?php echo $newDatefim; ?>" required>
                    </div>
                    <select id="filteruser" style="height: 2.4em;" name="filteruser">
                        <option value="0"></option>
                    <?php
                        require_once("config.php");

                        $conn = open_database();

                        $sql = "select * from `tbUser`";

                        if($_SESSION['admin'] == "") {
                            $sql = $sql . " where c.coduser = " . $_SESSION['coduser'];
                        }

                        $result = $conn->query($sql);

                        foreach($result as $row) :

                            if(isset($_POST['filteruser'])) {
                                if($_POST['filteruser'] == $row['coduser']) {
                                    $vUserSel = 'selected';
                                } else {
                                    $vUserSel = '';
                                }
                            }
                    ?>
                        <option value="<?php echo $row['coduser']; ?>" <?php echo $vUserSel; ?>><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>

                    </select>
                    <select id="filtertype" style="height: 2.4em;" name="filtertype">
                        <option value="0"></option>
                    <?php
                        require_once("config.php");

                        $conn = open_database();

                        $sql = "select * from `tbTipoPGTO`";

                        $result = $conn->query($sql);

                        foreach($result as $row) :

                            if(isset($_POST['filtertype'])) {
                                if($_POST['filtertype'] == $row['codtipo']) {
                                    $vTipoSel = 'selected';
                                } else {
                                    $vTipoSel = '';
                                }
                            }
                    ?>
                        <option value="<?php echo $row['codtipo']; ?>" <?php echo $vTipoSel; ?>><?php echo $row['descricao']; ?></option>
                    <?php endforeach; ?>

                    </select>
                    <input type="submit" class="buttonfilter" value="Filtrar">
                </form>
            </div>
            <table>
            <caption>Relatório de Corridas</caption>
                <thead>
                    <tr>
                        <th scope="col">Usuário</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Data/Hora</th>
                        <th scope="col">Km</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Comissão</th>
                        <th scope="col">Obs.</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        require_once("config.php");

                        $conn = open_database();

                        $sql = "select u.name as nome, t.descricao as tipo, c.datahora, cast(c.kmfim - c.kmini as decimal(18,2)) as km, c.valor, cast((c.valor * 30) / 100 as decimal(18,2)) as comissao, c.descricao
                        from `tbCorridas` as c
                        inner join `tbTipoPGTO` as t on c.codtipo = t.codtipo
                        inner join `tbUser` as u on c.coduser = u.coduser";

                        $sql = $sql . "where c.datahora >= '" . $newDateini . "' and c.datahora <= '" . $newDatefim . "'";

                        if($_SESSION['admin'] == "") {
                            $sql = $sql . " and c.coduser = " . $_SESSION['coduser'];
                        } elseif(isset($_POST['filteruser'])) {
                            if($_POST['filteruser'] > 0) {
                                $sql = $sql . " and c.coduser = " . $_POST['filteruser'];
                            }
                        }

                        if(isset($_POST['filtertype'])) {
                            if($_POST['filtertype'] > 0) {
                                $sql = $sql . " and c.codtipo = " . $_POST['filtertype'];
                            }
                        }

                        $result = $conn->query($sql);

                        foreach($result as $row) :
                    ?>
                    <tr>
                        <td scope="row" data-label="Usuário"><?php echo $row['nome']; ?></td>
                        <td data-label="Tipo"><?php echo $row['tipo']; ?></td>
                        <td data-label="Data/Hora"><?php
                            $data = new DateTime($row['datahora']);

                            echo date_format($data, "d/m/Y H:i");
                        ?></td>
                        <td data-label="Km"><?php echo $row['km']; ?></td>
                        <td data-label="Valor"><?php echo "R$ " . $row['valor']; ?></td>
                        <td data-label="Comissão"><?php echo "R$ " . $row['comissao']; ?></td>
                        <td data-label="Obs."><?php echo $row['descricao']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <br>
            <a href="menu" class="cadastro" style="font-size: 20px;text-decoration: none;color: #fff;">Voltar</a>
        </div>
    </body>
</html>