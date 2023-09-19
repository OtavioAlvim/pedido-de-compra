<?php
session_start();
var_dump($_POST);
$nome = $_POST['usuario'];
$senha = $_POST['senha'];
$pdo = new PDO('sqlite:../db/DB-SIA/sia');
// C:\server\Apache24\htdocs\web\db\DB-SIA\sia

$sql = $pdo->prepare("select * from VENDEDORES where ID_VENDEDOR =:usuario and SENHA = :senha");

$sql->bindValue(':usuario',$nome);
$sql->bindValue(':senha',$senha);
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
print_r($resultado[0]['NOME']);


if(empty($resultado)):
    $_SESSION['error'] = true;
    header('location: ../index.php');
else:
    $_SESSION['nome'] = $resultado[0]['NOME'];
    $_SESSION['id_vendedor'] = $resultado[0]['ID_VENDEDOR'];
    header('location: ../inicio/index.php');
    // header('location: ../bola.php');

endif;
?>