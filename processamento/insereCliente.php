<?php
session_start();
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
$_SESSION['id_vendedor'];

$id_cliente = $_POST['id'];
$nome_cli = $_POST['nome'];
$formaPag = $_POST['TIPOFORMAPGDEFAULT'];
$planoPag = $_POST['TIPOPLANOPGDEFAULT'];
$tipoPedido = $_POST['TIPOPEDIDODEFAULT'];


$sql = $pdo->prepare("INSERT INTO `prevenda_tmp` (CODIGOCLI,ID_VENDEDOR,NOMECLI,FORMA_PAGAMENTO,PLANO_PAGAMENTO,TIPO_PEDIDO) VALUES (:id_cliente,:id_vendedor,:nome_cli,:formaPag,:planoPag,:tipoPedido)");

$sql->bindValue(':id_cliente',$id_cliente);
$sql->bindValue(':id_vendedor',$_SESSION['id_vendedor']);
$sql->bindValue(':nome_cli',$nome_cli);
$sql->bindValue(':formaPag',$formaPag);
$sql->bindValue(':planoPag',$planoPag);
$sql->bindValue(':tipoPedido',$tipoPedido);


if($sql->execute() == true){
    $_SESSION['cliente-inserido'] = true;
    header('location:../pedidos/index.php');
}

?>