<?php
// $host = 'localhost';
// $banco = 'bdsia';
// $usuario = 'inoveh';
// $senha = 'AxR256396dd';

// try {
//   $conexao = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);
//   $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   // echo 'Conexão bem-sucedida!';
// } catch(PDOException $e) {
//   echo 'Erro na conexão: ' . $e->getMessage();
// }

$host = 'localhost';
$port = '3306'; // Change this to the desired port number
$banco = 'bdsia';
$usuario = 'inoveh';
$senha = 'AxR256396dd';

try {
  $conexao = new PDO("mysql:host=$host;port=$port;dbname=$banco;charset=utf8mb4", $usuario, $senha);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo 'Conexão bem-sucedida!';
} catch(PDOException $e) {
  echo 'Erro na conexão: ' . $e->getMessage();
}



