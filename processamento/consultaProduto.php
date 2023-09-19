<?php
$descricao = $_POST['palavra'];


$pdo = new PDO('sqlite:../db/DB-SIA/sia');

$sth = $pdo->prepare("SELECT * from produtos where DESCRICAO like '{$descricao}%' limit 1");
$sth->execute();
$r = $sth->fetchAll(PDO::FETCH_ASSOC);
// print_r($r);
echo json_encode($r);