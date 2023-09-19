<?php
session_start();

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <style>
        /* Estilize para centralizar verticalmente */
        .vh-100 {
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>


    <body>
        <div class="vh-100">
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center">

                        <form method="post" action="./processamento/validaUsuario.php">
                            <div class="mb-3 text-center">
                                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3 text-center">
                                <label for="exampleInputPassword1" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha">
                            </div><br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">entrar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>



        <?php
        if (isset($_SESSION['error'])) :
        ?>

            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ERRO...',
                    text: 'Usuario não cadastrado ou vazio!',
                    //   footer: '<a href="">Why do I have this issue?</a>'
                })
            </script>
        <?php
        endif;
        unset($_SESSION['error']);
        ?>
    </body>

</html>