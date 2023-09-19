<?php

$descricao = $_POST['palavra'];


$pdo = new PDO('sqlite:../db/DB-SIA/sia');

$sth = $pdo->prepare("SELECT * from produtos where DESCRICAO like '%{$descricao}%' limit 1");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($r);

