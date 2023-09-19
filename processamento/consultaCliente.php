<?php

include('../db/conexao.php');

$descricao = $_POST['palavra'];
// consulta para recuperar configurações padroes do pedido
$sql = "SELECT i.TIPOPEDIDODEFAULT,i.TIPOPLANOPGDEFAULT,i.TIPOFORMAPGDEFAULT,i.DEFAULTRETIRADOPOR FROM indices i";
$sql = $conexao->prepare($sql);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

// print_r($result);
foreach($result as $operacoes){

}


//Pesquisar no banco de dados para recuperar o cliente 
$sql = "SELECT * FROM clientes WHERE nomecli LIKE :descricao LIMIT 10";
$sql = $conexao->prepare($sql);
$sql->bindValue(':descricao', '%' . $descricao . '%', PDO::PARAM_STR);
$sql->execute();
$r = $sql->fetchAll(PDO::FETCH_ASSOC);
// print_r($r['0']['DESCRICAO']);
// print_r($r['0']);
?>
<!-- <form action="" method="post">
    <input type="submit" value="teste">
</form> -->
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Fantasia</th>
      <th scope="col">Operacao</th>
    </tr>
  </thead>
  <tbody>
<?php

foreach($r as $resultado){ 
    // print_r($resultado);
    ?>
    <tr>
        
      <th scope="row"><p class="modal_produto"><?php echo $resultado['CODIGOCLI'] ?></p> </th>
      <td><p class="modal_produto"><?php echo $resultado['NOMECLI'] ?></p> </td>
      <td><p class="modal_produto"><?php echo $resultado['RAZAO'] ?></p> </td>
      <td>
        <form action="../processamento/insereCliente.php" method="post">
            <input type="hidden" name="id" value="<?php echo $resultado['CODIGOCLI'] ?>">
            <input type="hidden" name="nome" value="<?php echo $resultado['NOMECLI'] ?>">
            <input type="hidden" name="razao" value="<?php echo $resultado['RAZAO'] ?>">
            <input type="hidden" name="TIPOPEDIDODEFAULT" value="<?php echo $operacoes['TIPOPEDIDODEFAULT'] ?>">
            <input type="hidden" name="TIPOPLANOPGDEFAULT" value="<?php echo $operacoes['TIPOPLANOPGDEFAULT'] ?>">
            <input type="hidden" name="TIPOFORMAPGDEFAULT" value="<?php echo $operacoes['TIPOFORMAPGDEFAULT'] ?>">
        <input type="submit" class="btn btn-primary btn-sm" value="selecionar">
        </form>

    
    </td>
    </tr>

<?php
}
?>
  </tbody>
</table>