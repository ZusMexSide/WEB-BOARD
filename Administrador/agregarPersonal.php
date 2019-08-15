<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MUsuarios.php';
include_once '../backend/controlador/CUsuarios.php';
include_once '../backend/logica/registro_usuarios.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Pragati+Narrow&display=swap" rel="stylesheet">        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/agregarPersonal.css">
        <link rel="stylesheet" href="../css/full.css">


        <!--        <link rel="stylesheet" href="../css/full.css"> -->

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <title>Agregar Personal</title>
        <link rel="shortcut icon" href="../img/logo-webBoard.png"/>
    </head>
    <body>
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar">
                    <a class="nav-link p-0" href="#">
                        <img src="<?php echo '../' . $_SESSION['autentificado']['imagen'] ?>" class="rounded-circle z-depth-0"
                             alt="avatar image" height="35">
                    </a>
                </li>

            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="notificaciones.php">Notificaciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="proyectos.php">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="personal.php">Personal
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item avatar">
                        <a  class="nav-item avatar" href="../backend/logica/cerrar_sesion.php"> Salir <i class="fas fa-sign-in-alt" ></i></a>
                    </li>
                </ul>

            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6-auto">
                    <form method="post" enctype="multipart/form-data" class="form-container">
                        <?php echo $formulario ?>
                        <?php echo $boton ?>
                        <?php if (!empty($errores)): ?>
                            <div class="error"> <?php echo $errores; ?> </div>
                        <?php elseif ($enviado): ?>
                            <div class="error">Enviado correctamente</div>
                        <?php endif; ?>

                    </form>

                </div>
            </div>
        </div>
        <script src="../js/agregarImagen.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
