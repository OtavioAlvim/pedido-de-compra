<?php
session_start();
// include('../db/conexao.php');
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
// C:\server\Apache24\htdocs\web\db\DB-SISTEMA\pedidos
var_dump($_POST);

$id = $_POST['id_venda'];


$sql = $pdo->prepare("UPDATE prevenda_tmp SET `STATUS` = 'C' WHERE ID = :id");
// $sql = $conexao->prepare($sql);
$sql->bindValue(':id',$id);
if($sql->execute() == true){
    $_SESSION['pedido_cancelado'] = true;
    header('location:../pedidos/');
}
?>