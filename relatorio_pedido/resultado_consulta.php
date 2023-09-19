<?php
include('../db/conexao.php');
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');

$id_venda = $_POST['id_venda'];
$sqll = "SELECT * FROM produtos_prevenda_tmp p WHERE p.VENDA = :id_venda";
$sqll = $pdo->prepare($sqll);
$sqll->bindValue(':id_venda', $id_venda);
$sqll->execute();
$produtos_ped = $sqll->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Detalhes Pedido</title>
</head>

<body class="bg-dark-subtle">
    <br>
    <div class="container">
        <div class="container">
        <div class="row">
            <div class="position-relative">
                <div class="position-absolute top-0 start-0">
                    <h3>PRODUTOS LANÇADOS  </h3>
                </div>
                <div class="position-absolute top-0 end-0">
                <a class="btn btn-outline-danger btn-sm" href="../relatorio_pedido/index.php" role="button">Voltar</a>
            </div>

            <br>
            </div></div>
        </div>
<hr>

        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID_PRODUTO</th>
                    <th scope="col">DESCRICAO</th>
                    <th scope="col">UNIDADE</th>
                    <th scope="col">UNITARIO</th>
                    <th scope="col">TOT_ITEM</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($produtos_ped as $produtos_ped) { ?>
                    <tr>
                        <th scope="row"><?php echo $produtos_ped['ID_PRODUTO'] ?></th>
                        <td><?php echo $produtos_ped['DESCRICAO'] ?></td>
                        <td><?php echo $produtos_ped['UNIDADE']  ?></td>
                        <td><?php echo $produtos_ped['UNITARIO']  ?></td>
                        <td><?php echo $produtos_ped['TOT_ITEM']  ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>