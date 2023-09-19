<?php
require_once './consulta.php';
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Controle de Pordutos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="bg-dark-subtle">
<br>
  <div class="container">
    <h1 class="text-center">RELATORIO DE CONTROLE DE PRODUTOS - NOTA</h1>
    <hr>
    <!-- <a class="btn btn-outline-primary m-2" href="../index.php" role="button">Voltar</a> -->

    <div class="container">
      <div class="row">
        <div class="position-relative">
          <div class="position-absolute top-0 start-0">
            <h3>CLIENTE: SACOLÃO MS - <?php echo $recupera_vendas[0]['NOMEGRUPO'] ?> </h3>
          </div>
          <div class="position-absolute top-0 end-0 d-flex ">
            <!-- <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#excluirPedido">Cancelar</button> -->
            <form action="./gerador_coleta.php" method="post">
                <input type="hidden" name="notas" value="<?php echo $NumNota ?>">
                <input type="hidden" name="grupo" value="<?php echo $CodGrupo ?>">
            <button type="submit" class="btn btn-outline-primary btn-sm m-2">Gerar Relatorio</button>

            </form>
            
            <a class="btn btn-outline-danger btn-sm m-2" href="../inicio/index.php" role="button">Voltar</a>
            <!-- <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#finalizar">Aprovar</button> -->
          </div>
        </div>
        
        <br>
      </div><br><br>
    </div>
    <br>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Descrição</th>
          <th scope="col">Unidade</th>
          <th scope="col">Qtd</th>
          <th scope="col">Vlr</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($recupera_vendas as $recupera_vendas) { ?>
          <tr>
            <th scope="row"><?php echo $recupera_vendas['ID_PRODUTO'] ?></th>
            <td><?php echo $recupera_vendas['DESCRICAO'] ?></td>
            <td><?php echo $recupera_vendas['UnidadeMedida'] ?></td>
            <td><?php echo $recupera_vendas['ValorQuantidade'] ?></td>
            <td><?php echo $recupera_vendas['ValorUnitario'] ?></td>
            <td><?php echo "R$ " . $recupera_vendas['ValorTotal'] ?></td>
          </tr>
        <?php }
        ?>
      </tbody>
    </table>
  </div>
  <!-- <a href="../coleta/gerador_coleta.php">coleta</a> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>