<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados enviados pela requisição
    $descricao = $_POST["descricao"];
    $caixas = $_POST["caixas"];
    $fracao = $_POST["fracao"];
    $unitario = $_POST["unitario"];
    $resultado = $_POST["resultado"];
    $custo = $_POST["custo"];
    $unidade = $_POST["unida"];
    $codbarra = $_POST["codbarra"];
    $id_venda = $_POST["id_venda"];
    $id_produto = $_POST["id_produto"];
    $kg = ($_POST["fracao"] * $caixas = $_POST["caixas"]);
    $valorPeloQuantidade = ($_POST["unitario"] /$_POST["fracao"]);
    $pdo = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
        $sql = $pdo->prepare("INSERT INTO `produtos_prevenda_tmp` (`ID_PRODUTO`,`CODBARRA`,`CUSTO`,`UNIDADE`,`VENDA`, `DESCRICAO`, `KG`, `VALOR_KG`, `CAIXAS`, `qtdXfator`, `UNITARIO`, `TOT_ITEM`) VALUES (:ID_PRODUTO,:CODBARRA,:CUSTO,:UNIDADE,:ID_VENDA,:DESCRICAO,:KG,:VALOR_KG,:CAIXAS,:qtdXfator,:UNITARIO,:TOT_ITEM);");
        $sql->bindValue(':ID_PRODUTO', $id_produto);
        $sql->bindValue(':CODBARRA', $codbarra);
        $sql->bindValue(':CUSTO', $custo);
        $sql->bindValue(':UNIDADE', $unidade);
        $sql->bindValue(':ID_VENDA', $id_venda);
        $sql->bindValue(':DESCRICAO', $descricao);
        $sql->bindValue(':KG', $kg);
        $sql->bindValue(':VALOR_KG', $valorPeloQuantidade);
        $sql->bindValue(':CAIXAS', $caixas);
        $sql->bindValue(':qtdXfator', $fracao);
        $sql->bindValue(':UNITARIO', $unitario);
        $sql->bindValue(':TOT_ITEM', $resultado);
        $sql->execute();
        
}
?>
