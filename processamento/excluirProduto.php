<?php
session_start();
// include('../db/conexao.php');
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
var_dump($_POST);

$id = $_POST['id_produto'];


$sql = $pdo->prepare("DELETE FROM produtos_prevenda_tmp WHERE ID = :id");
// $sql = $conexao->prepare($sql);
$sql->bindValue(':id',$id);
if($sql->execute() == true){
    $_SESSION['produto_cancelado'] = true;
    header('location:../pedidos/');
}

?>