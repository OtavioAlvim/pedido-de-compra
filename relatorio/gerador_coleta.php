<?php
include('../db/conexao.php');
$numNota = $_POST['notas'];
$numGrupo = $_POST['grupo'];

// Incluir a biblioteca PHPExcel
require '../relatorio/FPDF/fpdf.php';

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
$sql->bindValue(':NumNota', $numNota);
$sql->bindValue(':CodGrupo', $numGrupo);
$sql->execute();

$sqlll = "SELECT * FROM  pedido_compra  
UNION ALL

SELECT
null AS ID_PRODUTO,
null AS DESCRICAO,
null AS NOMEGRUPO,
null AS UnidadeMedida,
'TOTAL' AS ValorUnitario,
null AS ValorQuantidade,
round(SUM(ValorTotal),2) AS ValorTotal
FROM pedido_compra
";
$sqlll = $conexao->prepare($sqlll);
$sqlll->execute();
$rowDados = $sqlll->fetchAll(PDO::FETCH_ASSOC);
// Criar o objeto FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Definir fonte e tamanho
$pdf->SetFont('Arial', '', 8);

// Títulos das colunas

$pdf->Cell(20, 10, 'ID_PRODUTO', 1);
$pdf->Cell(50, 10, 'DESCRICAO', 1);
$pdf->Cell(30, 10, 'UnidadeMedida', 1);
$pdf->Cell(20, 10, 'ValorUnitario', 1);
$pdf->Cell(30, 10, 'ValorQuantidade', 1);
$pdf->Cell(30, 10, 'ValorTotal', 1);
$pdf->Ln();

// Preencher os dados do banco de dados no arquivo PDF

foreach ($rowDados as $rowDados) {
    $pdf->Cell(20, 6, $rowDados['ID_PRODUTO'], 1);
    $pdf->Cell(50, 6, $rowDados['DESCRICAO'], 1);
    $pdf->Cell(30, 6, $rowDados['UnidadeMedida'], 1);
    $pdf->Cell(20, 6, $rowDados['ValorUnitario'], 1);
    $pdf->Cell(30, 6, $rowDados['ValorQuantidade'], 1);
    $pdf->Cell(30, 6, 'R$ : ' . $rowDados['ValorTotal'], 1);
    $pdf->Ln();
}
// Definir o nome do arquivo
$nomeArquivo = 'pedido de compra.pdf';

// Salvar o arquivo no servidor
$pdf->Output($nomeArquivo, 'D');
