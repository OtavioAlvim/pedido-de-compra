<?php
// include('./login/verifica_login.php');
$zip = new ZipArchive();
$nomeArquivoCompactado = 'siadown.zip';
$diretorio = __DIR__;

$caminho = substr($diretorio, 0, -14);

$diretorioBancoCompactado = $caminho . "db". DIRECTORY_SEPARATOR ."FTP\DB-IMPORTACAO". DIRECTORY_SEPARATOR .$nomeArquivoCompactado;

$diretorioBancoDescompactado = $caminho . "db". DIRECTORY_SEPARATOR ."DB-SIA" .DIRECTORY_SEPARATOR. "sia";
print_r($diretorioBancoDescompactado);



if(file_exists($diretorioBancoCompactado)){
    unlink($diretorioBancoDescompactado);
    if($zip->open($diretorioBancoCompactado)){
        $zip->extractTo('../DB/DB-SIA');
        $zip->close();
        unlink($diretorioBancoCompactado);
        if(file_exists($diretorioBancoDescompactado)){
            $_SESSION['importacao-concluida'] = true;
            header('location: ../inicio/index.php');
            exit();
            
        }
        // "Arquivo extraido com sucesso!";
    }else{
        // "Esse arquivo não existe na pasta";
    };
    // "Encontramos um arquivo!";
}else{
    $_SESSION['erro-ao-sustituir-base'] = true;
    header('location: ../inicio/index.php');
    exit();
    // "ERRO! Não existe um arquivo neste caminho!";
}
?>