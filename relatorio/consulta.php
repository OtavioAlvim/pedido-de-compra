<?php
include('../db/conexao.php');
session_start();
$NumNota = $_POST['num_nota'];
$CodGrupo = $_POST['num_grupo'];



// remove o banco de dados caso tenha
$sqll = "DROP TABLE IF EXISTS pedido_compra";
$sqll = $conexao->prepare($sqll);
$sqll->execute();

// cria uma tabela a partir de um select
$sql = "CREATE TABLE pedido_compra
SELECT 
p.ID_PRODUTO, 
p.DESCRICAO ,
g.NOMEGRUPO,
p.UTRIB AS UnidadeMedida,
SUBSTRING((p.UNITARIO - (p.unitario * 0.05)),1,4) AS ValorUnitario,
SUM(p.QTD) AS ValorQuantidade,
substring(round((p.UNITARIO - (p.unitario * 0.05))* SUM(p.QTD),3),1,5) AS ValorTotal
FROM produtos_notasaida p
LEFT JOIN lvsaidas l ON p.PRIMARIA = l.PRIMARIA
LEFT JOIN empresas c ON l.EMPRESA = c.CODIGO_N
LEFT JOIN produto pr ON p.ID_PRODUTO = pr.CODITEM
LEFT JOIN grupo g ON pr.GRUPO = g.CODGRUPO
WHERE FIND_IN_SET(l.NOTA,:NumNota) AND 
l.EMPRESA = 1 AND pr.GRUPO =:CodGrupo GROUP BY p.ID_PRODUTO;";
$sql = $conexao->prepare($sql);
$sql->bindValue(':NumNota',$NumNota);
$sql->bindValue(':CodGrupo',$CodGrupo);
$sql->execute();




$sql = "SELECT * FROM  pedido_compra  
UNION ALL

SELECT
null AS ID_PRODUTO,
null AS DESCRICAO,
null AS NOMEGRUPO,
null AS UnidadeMedida,
'TOTAL' AS ValorUnitario,
NULL AS ValorQuantidade,
round(SUM(ValorTotal),2) AS ValorTotal
FROM pedido_compra
";
$sql = $conexao->prepare($sql);
$sql->execute();
$recupera_vendas = $sql->fetchAll(PDO::FETCH_ASSOC);
























// // CONSULTA PARA RECUPERAR OS PEDIDOS
// $sqll = "SELECT l.NOTA AS NUMNOTA, c.NOME ,p.DESCRICAO ,g.NOMEGRUPO,p.UNITARIO,
// substring(round((p.UNITARIO - (p.unitario * 0.05))* SUM(p.QTD),3),1,5) AS TOTDESC,
// SUBSTRING((p.UNITARIO - (p.unitario * 0.05)),1,4) AS DESCONTOPROCENTO,
// SUM(p.TOTALPRODUTO) AS TOTPROD,SUM(p.QTD) AS QTDSOMADO,p.* FROM produtos_notasaida p
// LEFT JOIN lvsaidas l ON p.PRIMARIA = l.PRIMARIA
// LEFT JOIN empresas c ON l.EMPRESA = c.CODIGO_N
// LEFT JOIN produto pr ON p.ID_PRODUTO = pr.CODITEM
// LEFT JOIN grupo g ON pr.GRUPO = g.CODGRUPO
// WHERE FIND_IN_SET(l.NOTA,:NumNota) AND 
// l.EMPRESA = 1 AND pr.GRUPO =:CodGrupo GROUP BY p.ID_PRODUTO;    

   
// ";
// $sqll = $conexao->prepare($sqll);
// $sqll->bindValue(':NumNota',$NumNota);
// $sqll->bindValue(':CodGrupo',$CodGrupo);
// $sqll->execute();
// $recupera_vendas = $sqll->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($recupera_vendas);
// echo "</pre>";

?>