<?php
session_start();
    $pdo = new PDO('sqlite:../db/BASE-TMPPEDIDOS/banco'); 
    $banco_sistema = new PDO('sqlite:../db/DB-SISTEMA/pedidos');

// var_dump($_POST);

// echo "teste";
$_SESSION['id_vendedor'];
$id_pedido = $_POST['id_venda'];
// $valor_final = $_POST['valor_final'];
$data = date('Y-m-d');
///////////////////limpa a base antes da inserçao de dados////////////////////////////////////
$limpa_base_capa = "DELETE FROM TMPPEDIDOS";
$pdo->exec($limpa_base_capa);
$limpa_base_item = "DELETE FROM TMPITENS_PEDIDO";
$pdo->exec($limpa_base_item);
///////////////// somo o valor de todos os pedidos e gera um update na capa para colocar o valor///////////
$sql = $banco_sistema->prepare("select coalesce(sum(TOT_ITEM),0) as total from produtos_prevenda_tmp where VENDA =:id_pedido");
$sql->bindValue(':id_pedido', $id_pedido);
$sql->execute();
$total_ped = $sql->fetchAll(PDO::FETCH_ASSOC);
var_dump($total_ped);
if($total_ped[0]['total'] == 0):
    $_SESSION['produtoZerado'] = true;
    header('Location: ../pedidos/index.php');
else:
    // echo "tem algo ";
$sql = $banco_sistema->prepare("UPDATE prevenda_tmp SET VLRTOTAL = :valor WHERE ID = :id");
// $sql = $conexao->prepare($sql);
$sql->bindValue(':valor', $total_ped[0]['total']);
$sql->bindValue(':id', $id_pedido);
$sql->execute();
$r = $sql->fetchAll(PDO::FETCH_ASSOC);

/////////////////////// faz um select na capa com o mesmo id retornado pela finalizadora///////////////////
$sql = $banco_sistema->prepare("select * from prevenda_tmp where ID_VENDEDOR =:ID_VENDEDOR and id =:id_pedido");
$sql->bindValue(':ID_VENDEDOR', $_SESSION['id_vendedor']);
$sql->bindValue(':id_pedido', $id_pedido);
$sql->execute();
$capa_pedido = $sql->fetchAll(PDO::FETCH_ASSOC);
// var_dump($capa_pedido);
foreach($capa_pedido as $capa_pedido){

}

// inserindo registros no banco de dados
$inserindo_capa = "INSERT INTO TMPPEDIDOS 
(ID_PEDIDO,
ID_VENDEDOR, 
ID_CLIENTE, 
ID_TIPOPEDIDO, 
ID_PLANOPGTO, 
ID_FORMAPGTO, 
DATA, 
TOTAL, 
TRANSMITIDO, 
JATRANSMITIDO, 
RAZAO, 
ID_EMPRESA, 
FRETE, 
ACRESCIMO, 
OUTRO_DESC, 
ENDERECO, 
BAIRRO, 
CIDADE, 
ESTADO, 
CEP, 
TELEFONE, 
ID_ROTA, 
NUMERO, 
COMPLEMENTO, 
ENTREGAR, 
NOVOENDERECO, 
ID_CIDADE, 
DESPESAS_BOLETO
) 
VALUES ({$capa_pedido['ID']},
{$capa_pedido['ID_VENDEDOR']},
{$capa_pedido['CODIGOCLI']}, 
{$capa_pedido['TIPO_PEDIDO']}, 
{$capa_pedido['PLANO_PAGAMENTO']}, 
{$capa_pedido['FORMA_PAGAMENTO']}, 
'{$data}', 
'{$capa_pedido['VLRTOTAL']}',
'N',
'N', 
'TESTE', 
'1',
'0', 
'0', 
'0.0',  
'', 
'', 
'', 
'', 
'', 
'', 
'0',
'',
'',
'N',
'N',
'0',
'0'
)
";
$pdo->exec($inserindo_capa);

///////////////insere produtos/////////////////////

$sql = $banco_sistema->prepare("select * from produtos_prevenda_tmp where VENDA =:venda");
$sql->bindValue(':venda', $id_pedido);
$sql->execute();
$itens_pedido = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach($itens_pedido as $itens_pedido){
    $sql_item = "INSERT INTO TMPITENS_PEDIDO (
        ID, 
        ID_PEDIDO, 
        ID_EMPRESA, 
        ID_PRODUTO, 
        QTD, 
        UNITARIO, 
        DESCONTO, 
        TOTAL, 
        DADOADICIONAL,
        DESCRICAO, 
        PRECOINICIAL, 
        ID_TONALIDADE, 
        UNITARIOBASE, 
        EMPROMOCAO, 
        DESPESAS_BOLETO)
        VALUES (
        {$itens_pedido['ID']}, 
        {$itens_pedido['VENDA']}, 
        '1', 
        {$itens_pedido['ID_PRODUTO']}, 
        {$itens_pedido['KG']}, 
        {$itens_pedido['VALOR_KG']}, 
        '0', 
        {$itens_pedido['TOT_ITEM']}, 
        '', 
        '{$itens_pedido['DESCRICAO']}', 
        {$itens_pedido['VALOR_KG']}, 
        '0', 
        {$itens_pedido['VALOR_KG']}, 
        'N',
        '0')";
$pdo->exec($sql_item);

}

$sql = $banco_sistema->prepare("UPDATE prevenda_tmp SET `STATUS` = 'F' WHERE ID = :id");
$sql->bindValue(':id', $id_pedido);
if ($sql->execute() == true) {
    header('Location: compactaBase.php');
};
endif;