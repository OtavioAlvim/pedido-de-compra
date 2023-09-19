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
</head>

<body class="bg-dark-subtle">

    <div class="container mt-5">
        <p>Configurações</p>
        <div class="d-flex ">
            <a class="btn btn-primary" href="#" role="button">Voltar</a>
            <form action="" method="post">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div><br>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Ultimo pedido gerado
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ultimo Pedido vendedor</label>
                            <input type="email" class="form-control" placeholder="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Valores Padrões
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <label for="exampleFormControlInput1" class="form-label">Ultimo Pedido vendedor</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Plano de pagamento</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>

                        <label for="exampleFormControlInput1" class="form-label">Ultimo Pedido vendedor</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Forma de pagamento</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>

                        <label for="exampleFormControlInput1" class="form-label">Ultimo Pedido vendedor</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Tipo pedido</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Cadastros
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
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