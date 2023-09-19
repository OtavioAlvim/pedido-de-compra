<?php
session_start();
$pdo = new PDO('sqlite:../db/BASE-TMPPEDIDOS/banco'); 
$banco_sistema = new PDO('sqlite:../db/DB-SISTEMA/pedidos');
date_default_timezone_set("America/Sao_Paulo");
$zip = new ZipArchive();

//nome do arquivo que sera gerado
// $nome_arquivo = 'orderpack1.';
$Minha_data_hora = getdate(date("U"));
$minha_hora = "$Minha_data_hora[mday]"."$Minha_data_hora[mon]"."$Minha_data_hora[year]"."$Minha_data_hora[hours]"."$Minha_data_hora[minutes]"."$Minha_data_hora[seconds]";

$nome_arquivo = "orderpack".$_SESSION['id_vendedor']."." . $minha_hora . ".zip";

// echo $nome_arquivo;
$Spath = __DIR__;

$caminho = substr($Spath, 0, -7);
var_dump($caminho);
$diretorio_completo = $caminho . "db" .DIRECTORY_SEPARATOR. "FTP\DB-EXPORTACAO" .DIRECTORY_SEPARATOR. $nome_arquivo;
var_dump($diretorio_completo);
if($zip->open($diretorio_completo, ZipArchive::CREATE)){
    // $cami = $caminho . 'db\BASE-TMPPEDIDOS\banco';
    // var_dump($cami);
    $zip->addFile(
        $caminho . '/db/BASE-TMPPEDIDOS/banco', 'tmppedidos'
    );
    $zip->close();
}
if(file_exists($diretorio_completo)){
    $_SESSION['pedido_exportado_com sucesso'] = true;
    header('Location: ../relatorio_pedido/index.php');
    exit;
}else{
    echo "Arquivo não foi criado";
}


?>