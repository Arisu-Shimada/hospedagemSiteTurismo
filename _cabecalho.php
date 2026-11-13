<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <title>Sistema de Turismo</title>
</head>

<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema de Turismo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ConsultaController.php">Visitante</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="PontosController.php">Administrador</a>
                            </li>

                    </ul>


                        Usuário: <?= AutController::getUsuarioLogado() ?? '' ?> <a href="AutController.php?acao=logout">(Sair)</a>


                </div>
                
            </div>
        </nav>