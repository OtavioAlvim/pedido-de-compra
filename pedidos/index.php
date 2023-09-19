<?php
session_start();
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
//$pdo = new PDO('sqlite:../db/sia');

//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
$sql = $pdo->prepare("SELECT * FROM prevenda_tmp  WHERE `STATUS` = 'A' and ID_VENDEDOR = :ID_VENDEDOR");
$sql->bindValue('ID_VENDEDOR', $_SESSION['id_vendedor']);
$sql->execute();
$cliente = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach ($cliente as $cliente) {
    // print_r($cliente);
}
if (empty($cliente)) {
    $cliente_id_venda = 0;
} else {
    $cliente_id_venda = $cliente['ID'];
}
////////////////recupera o total de pedido
$sth = $pdo->prepare("select sum(TOT_ITEM) as total from produtos_prevenda_tmp where VENDA =:venda");
$sth->bindValue(':venda', $cliente_id_venda);
$sth->execute();
$total = $sth->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GERAR PEDIDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/sweetalert2.js"></script>
</head>

<body class="bg-dark-subtle">
    <div class="container">


        <h1 class="text-center">PEDIDO DE COMPRA</h1>
        <hr>
        <div class="col">
            <div class="row">
                <div class="position-relative">
                    <div class="position-absolute top-0 start-0">
                        <h3>CLIENTE: <?php if ($cliente_id_venda == 0) : echo "CLIENTE NÃO IDENTIFICADO";
                                        else : echo $cliente['NOMECLI'];
                                        endif ?></h3>
                    </div>
                    <div class="position-absolute top-0 end-0">
                        <a class="btn btn-outline-primary btn-sm" href="../inicio/index.php" role="button">Voltar</a>
                        <?php if ($cliente_id_venda == 0) :
                        else : ?>
                            <a class="btn btn-outline-danger btn-sm" href="./index.php" role="button" data-bs-toggle="modal" data-bs-target="#excluirPedido">Cancelar pedido</a>
                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#finalizar">Aprovar</button>
                        <?php endif; ?>

                    </div>
                </div>
                <br>
            </div>

            <br>

            <div class="row">
                <div class="col">
                    <?php if ($cliente_id_venda == 0) : ?>
                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#pesquisar_clientes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                    <?php endif ?>


                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#config"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                        </svg></button>
                </div>
            </div>

            <?php if ($cliente_id_venda == 0) : else : ?>

                <div class="row ">
                    <div class="col-5 text-center"><br>
                        <form method="POST" id="form-pesquisa" action="">
                            <div class="form-group">

                                <input class="form-control me-2" name="descricao" type="search" placeholder="Pesquiar produto" aria-label="Search" id="pesquisa" autofocus>
                            </div>
                        </form>
                    </div>

                </div>

                <br>

                <table class="table">
                    <div class="row ">
                        <div class="col-5 text-center">
                            <p> <strong>Descrição</strong></p>
                        </div>

                        <div class="col-1 text-center">
                            <p><strong> Caixas</strong></p>
                        </div>

                        <div class="col-2 text-center">
                            <p><strong>Fração</strong></p>
                        </div>

                        <div class="col-2 text-center">
                            <p><strong>Unitario</strong></p>
                        </div>

                        <div class="col-1 text-center">
                            <p><strong>Total</strong></p>
                        </div>

                        <div class="col-1 text-center">
                            <p><strong>Operação</strong></p>
                        </div>
                    </div>
                </table>



                <div class="row">
                    <div class="col-5"><input type="text" class="form-control" id="descricao" disabled>
                    </div>

                    <div class="col-1"><input type="number" class="form-control" step="0.01" name="caixas" id="caixas" required>
                    </div>

                    <div class="col-2"><input type="number" class="form-control" id="fracao" required>
                    </div>

                    <div class="col-2"><input type="number" class="form-control" name="unitario" step="0.01" id="unitario" required>
                    </div>

                    <div class="col-1"><input type="number" class="form-control" step="0.01" name="total" id="resultado" readonly disabled>
                    </div>

                    <div class="col-1">

                        <input type="hidden" name="custo" id="custo">
                        <input type="hidden" name="unidade" id="unida">
                        <input type="hidden" name="codbarra" id="codbarra">
                        <input type="hidden" name="id_venda" value="<?php echo $cliente_id_venda ?>" id="id_venda">
                        <input type="hidden" name="id_produto" id="id_produto">
                        <button type="" class="btn btn-outline-success" id="salvarDados">Inserir</button>
                    </div>
                </div>

                <hr>
                <div id="tabelaProdutos"></div>
        </div>
    <?php endif; ?>


    <!-- ///////////////////////////////////modals////////////////////////////////////////// -->





    <!-- Modal clientes-->
    <div class="modal fade" id="pesquisar_clientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">PESQUISAR CLIENTES </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex" role="search" action="" method="POST">
                        <input class="form-control me-2" name="descricao" type="search" placeholder="Pesquiar Cliente" aria-label="Search" id="pesquisaCliente">
                    </form>

                    <div class="resultadoCliente">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>







    <!-- Modal -->
    <div class="modal fade" id="excluirPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">EXCLUSÃO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    DESEJA FINALIZAR O PEDIDO DO(A) <?php echo $cliente['NOMECLI'] ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    <form action="../processamento/cancelaPedido.php" method="post">
                        <input type="hidden" name="id_venda" value="<?php echo $cliente['ID'] ?>">
                        <button type="submit" class="btn btn-primary">Cancelar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="config" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Configuração do pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Configuração do pedido


                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelectGrid">
                                    <option selected>tipo de pedido</option>
                                    <?php
                                    foreach ($tipo_pedido as $tipo_pedido) { ?>
                                        <option value="<?php echo $tipo_pedido['ID_TIPOPEDIDO'] ?>"><?php echo $tipo_pedido['DESCRICAO'] ?></option>
                                    <?php }
                                    ?>

                                </select>
                                <!-- <label for="floatingSelectGrid">Works with selects</label> -->
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelectGrid">
                                    <option selected>Plano de pagamento</option>

                                    <?php
                                    foreach ($plano_pagamento as $plano_pagamento) { ?>
                                        <option value="<?php echo $plano_pagamento['ID'] ?>"><?php echo $plano_pagamento['DESCRICAO'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <!-- <label for="floatingSelectGrid">Works with selects</label> -->
                            </div>
                        </div>
                    </div><br>


                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelectGrid">
                                    <option selected>forma de pagamento</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <!-- <label for="floatingSelectGrid">Works with selects</label> -->
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    <button type="button" class="btn btn-primary">ATUALIZAR</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal de produtos-->
    <div class="modal fade" id="finalizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">PESQUISAR PRODUTO </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    DESEJA FINALIZAR O PEDIDO DO(A) <?php echo $cliente['NOMECLI'] ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="../exporta_pedido/exporta.php" method="post">
                        <input type="hidden" name="valor_final" value="<?php echo $total[0]['total'] ?>">
                        <input type="hidden" name="id_venda" value="<?php echo $cliente['ID'] ?>">
                        <input type="hidden" name="CODIGOCLI" value="<?php echo $cliente['CODIGOCLI'] ?>">
                        <input type="hidden" name="FORMA_PAGAMENTO" value="<?php echo $cliente['FORMA_PAGAMENTO'] ?>">
                        <input type="hidden" name="PLANO_PAGAMENTO" value="<?php echo $cliente['PLANO_PAGAMENTO'] ?>">
                        <input type="hidden" name="TIPO_PEDIDO" value="<?php echo $cliente['TIPO_PEDIDO'] ?>">
                        <button type="submit" class="btn btn-primary">Finalizar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- pedido realizado com sucesso-->

    <?php
    if (isset($_SESSION['Venda_finalizada'])) :
    ?>

        <script>
            Swal.fire({
                title: 'Pedido Realizado com Sucesso',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        </script>
    <?php
    endif;
    unset($_SESSION['Venda_finalizada']);
    ?>




    <!-- pedido realizado com sucesso-->

    <?php
    if (isset($_SESSION['produto_cancelado'])) :
    ?>

        <script>
            Swal.fire({
                title: 'Produto Excluido com sucesso',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        </script>
    <?php
    endif;
    unset($_SESSION['produto_cancelado']);
    ?>



    <!-- Cliente inserido com sucesso-->

    <?php
    if (isset($_SESSION['cliente-inserido'])) :
    ?>

        <script>
            Swal.fire({
                title: 'Cliente inserido com sucesso',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        </script>
    <?php
    endif;
    unset($_SESSION['cliente-inserido']);
    ?>



    <?php
    if (isset($_SESSION['error'])) :
    ?>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'ERRO...',
                text: 'Usuario não cadastrado ou vazio!',
                //   footer: '<a href="">Why do I have this issue?</a>'
            })
        </script>
    <?php
    endif;
    unset($_SESSION['error']);
    ?>



    <?php
    if (isset($_SESSION['produtoZerado'])) :
    ?>

        <script>
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Produtos zerados, ou pedido sem itens',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    <?php
    endif;
    unset($_SESSION['produtoZerado']);
    ?>
    <!-- /////////////////////////////////////modals///////////////////////////////////// -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/recupera_produto.js"></script>
    <script src="../js/contulta_produto.js"></script>
    <script src="../js/atualizaCampo.js"></script>
    <script src="../js/salvarBanco.js"></script>
    <script src="../js/consultaCliente.js"></script>


</body>

</html>