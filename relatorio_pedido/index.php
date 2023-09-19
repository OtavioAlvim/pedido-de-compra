<?php

require_once './consultas.php';

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="../js/sweetalert2.js"></script>
</head>

<body class="bg-dark-subtle">
    <br>
    <div class="container">
        <h1 class="text-center">PEDIDOS REALIZADOS</h1>
        <hr>
        <a class="btn btn-outline-primary m-2" href="../inicio/index.php" role="button">Voltar</a>

        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID_PEDIDO</th>
                    <th scope="col">DESCRICAO</th>
                    <th scope="col">VALOR</th>
                    <th scope="col">ITENS</th>
                    <th scope="col">OPERACAO</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($recupera_pedidos as $recupera_pedidos) {?>
                
                    <tr>
                        <th scope="row"><?php echo $recupera_pedidos['ID'] ?></th>
                        <td><?php echo $recupera_pedidos['NOMECLI'] ?></td>
                        <td>R$: <?php echo number_format($recupera_pedidos['VLRTOTAL'], 2, ',', ' ')  ?></td>
                        <td>
                            <form action="./resultado_consulta.php" method="post">
                                <input type="hidden" name="id_venda" value="<?php echo $recupera_pedidos['ID'] ?>">
                                <button type="submit" class="btn btn-outline-primary btn-sm" role="button">itens</button>
                            </form>
                        </td>
                        <td>
                            <form action="../exporta/exporta.php" method="post">
                                <input type="hidden" name="id_venda" value="<?php echo $recupera_pedidos['ID'] ?>">
                                <input type="hidden" name="id_vendedor" value="<?php echo $recupera_pedidos['ID_VENDEDOR'] ?>">
                                <button type="submit" class="btn btn-outline-primary btn-sm" role="button">exportar</button>
                            </form>
                        </td>


                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>


    <?php
        if (isset($_SESSION['produto_sem_itens'])) :
        ?>

            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ERRO...',
                    text: 'Esse pedido não possui itens!',
                    //   footer: '<a href="">Why do I have this issue?</a>'
                })
            </script>
        <?php
        endif;
        unset($_SESSION['produto_sem_itens']);
        ?>


<?php
        if (isset($_SESSION['pedido_exportado_com sucesso'])) :
        ?>

            <script>
                Swal.fire({
                    icon: 'success',
                    // title: 'ERRO...',
                    text: 'Pedido expotado com sucesso!',
                    //   footer: '<a href="">Why do I have this issue?</a>'
                })
            </script>
        <?php
        endif;
        unset($_SESSION['pedido_exportado_com sucesso']);
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>