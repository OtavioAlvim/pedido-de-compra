<?php

session_start();
    $pdo = new PDO('sqlite:../db/BASE-TMPPEDIDOS/banco'); 
    $banco_sistema = new PDO('sqlite:../db/DB-SISTEMA/pedidos');

    $sql = $banco_sistema->prepare("UPDATE prevenda_tmp SET `STATUS` = 'F' WHERE ID = :id");
    // $sql = $conexao->prepare($sql);
    $sql->bindValue(':id', $id_venda);
    if ($sql->execute() == true) {
        $_SESSION['Venda_finalizada'] = true;
        // header('Location: compactaBase.php');
    }
          // header('Location: compactaBase.php');

?>