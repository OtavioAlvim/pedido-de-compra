<?php
session_start();
echo $_SESSION['nome'];
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PAGINA INICIAL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="bg-dark-subtle">
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SACOLAO MS - <?php echo $_SESSION['nome'] ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pedidos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../pedidos/">Novo Pedido</a></li>
                <li><a class="dropdown-item" href="../relatorio_pedido/">Pedido realizado</a></li>
              </ul>

            </li>
            <!-- <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../pedidos/">Novo pedido</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Gerar Relatorio</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Produtos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>

            </li> -->

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Configurações
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#troca_base">Trocar base</a></li>
                <li><a class="dropdown-item" href="../configuracoes/index.php">Configurações internas</a></li>
                <li><a class="dropdown-item" href="../exporta_pedido/importabancosia.php">Importar carga</a></li>
                <!-- <li><a class="dropdown-item" href="#">Configurações internas</a></li> -->
              </ul>

            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../login/logout.php">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>


  <!-- Modal gerador de relatorio-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../relatorio/index.php" method="post">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">gerar coleta de compra</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Numero das Notas</label>
              <input type="text" name="num_nota" class="form-control" required>
              <div class="form-text">valor aceito (1,2,3,4)</div>
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Numero do Grupo</label>
              <input type="number" name="num_grupo" class="form-control" required>
              <div class="form-text">valor aceito 1 ou 2 ou 3.. </div>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#troca_base">
  Launch static backdrop modal
</button> -->

<!-- Modal troca de base de dados -->
<div class="modal fade" id="troca_base" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Atenção!!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>A troca de base de dados, zera as configuraçoes criadas, necessario reconfigurar!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="../configuracoes/troca_base_dados.php" method="post">
        <button type="submit" class="btn btn-primary">proseguir</button>
        </form>
      </div>
    </div>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/sweetalert2.js"></script>
  <?php
        if (isset($_SESSION['importacao-concluida'])) :
        ?>

            <script>
            Swal.fire({
                title: 'carga importada com sucesso',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        </script>
        <?php
        endif;
        unset($_SESSION['importacao-concluida']);
        ?>
</body>

</html>