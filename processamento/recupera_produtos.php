<?php
session_start();
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');

///////////////recupera o id venda com base no id vendedor////////////////////////////////
$sql = $pdo->prepare("SELECT * FROM prevenda_tmp  WHERE `STATUS` = 'A' and ID_VENDEDOR = :ID_VENDEDOR");
$sql->bindValue('ID_VENDEDOR', $_SESSION['id_vendedor']);
$sql->execute();
$cliente = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach ($cliente as $cliente) {
}
if (empty($cliente)) {
    $cliente_id_venda = 0;
} else {
    $cliente_id_venda = $cliente['ID'];
}
/////////////////////recipupera os produtos/////////////////////////////
$sth = $pdo->prepare("select * from produtos_prevenda_tmp where venda =:venda  ORDER by id desc");
$sth->bindValue(':venda', $cliente_id_venda);
$sth->execute();
$r = $sth->fetchAll(PDO::FETCH_ASSOC);
////////////////recupera o total de pedido
$sth = $pdo->prepare("select sum(TOT_ITEM) as total from produtos_prevenda_tmp where VENDA =:venda");
$sth->bindValue(':venda', $cliente_id_venda);
$sth->execute();
$total = $sth->fetchAll(PDO::FETCH_ASSOC);
// Montar a tabela HTML com os dados dos produtos
?>
<table class="table table-hover">
    <tbody>
        <thead>
            <tr class=" text-center">
                <th scope="col">ID</th>
                <th scope="col">Descrição</th>
                <th scope="col">Caixas</th>
                <th scope="col">Kg/Un</th>
                <th scope="col">Total</th>
                <th scope="col">Operacão</th>
            </tr>
            <!-- <tr> -->

            <?php
            foreach ($r as $produto) { ?>
                <tr>
                    <td class="col-1 text-center"><?php echo $produto['ID_PRODUTO'] ?></td>
                    <td class="col-6 text-center"><?php echo $produto['DESCRICAO'] ?></td>
                    <td class="col-1 text-center"><?php echo $produto['CAIXAS'] ?></td>
                    <td class="col-1 text-center"><?php echo $produto['KG'] ?></td>
                    <td class="col-1 text-center"><?php echo number_format($produto['TOT_ITEM'], 2, ',', ' ') ?></td>
                    <td class="col-2 text-center">
                        <form action="../processamento/excluirProduto.php" method="post">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['ID'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                </svg></button>
                        </form>

                    </td>
                </tr>
            <?php }
            echo '</tbody></table>';
            ?>
            <hr>
            <h4 class="text-center">TOTAL R$ <?php

                                                if (empty($total[0]['total'])) {
                                                    echo "0,00";
                                                } else {
                                                    echo number_format($total[0]['total'], 2, ',', ' ');
                                                };
                                                ?></h4>