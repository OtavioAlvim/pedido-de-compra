<?php
include('../db/conexao.php');
$pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
session_start();
// CONSULTA PARA RECUPERAR OS PEDIDOS
$sqll = "SELECT * FROM prevenda_tmp P WHERE P.`STATUS` = 'F'";
$sqll = $pdo->prepare($sqll);
$sqll->execute();
$recupera_pedidos = $sqll->fetchAll(PDO::FETCH_ASSOC);

// recupera dados do pedido


?>