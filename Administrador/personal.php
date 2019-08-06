<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MUsuarios.php';
include_once '../backend/controlador/CUsuarios.php';
session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
} else {
    if ($_SESSION['autentificado']["privilegios"] == "Empleado") {
        header('Location: ../index.php');
    }
}
$personal = new CUsuarios();
if (isset($_POST['eliminarEmpleados'])) {
    if (!empty($_POST['empleados'])) {
        $personal->borrarEmpleados($_POST['empleados']);
        header('Location: personal.php');
    } else {
        $error = '<script type="text/javascript">
    alert("No se seleccionaron archivos");
    </script>';
    }
}
if (isset($_POST['editarEmpleados'])) {
    header('Location: agregarPersonal.php?id=' . $_POST['empleado'] . '');
}
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.css">  
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="../css/full.css">

        <title>Usuarios</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="proyectos.php">WebBoard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="proyectos.php">Proyectos</a>
                    <a class="nav-item nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    <a class="nav-item nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    <a class="nav-item nav-link active" href="personal.php">Personal<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="notificaciones.php">Notificaciones</a>
                </div>
                <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
            </div>
        </nav>
        <header>
            <br>
            <ul class="menu">
                <li> <button type="button" class="btn btn-primaryp"  data-toggle="modal" data-target="#modalEditarEmpleados">Editar empleado</button> </li>
                <li> <a href="agregarPersonal.php" class="btn btn-primaryp ">Agregar mas empleados</a></li>
                <li> <button type="button" class="btn btn-primaryp"  data-toggle="modal" data-target="#modalEliminarEmpleados">Eliminar empleados</button></li>
            </ul>

        </header>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--Modal eliminar empleados-->
                    <div class="modal fade" id="modalEliminarEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Selecciona los empleados que desea eliminar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo $personal->inputEliminarEmpleados() ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="eliminarEmpleados" class="btn btn-primary">Eliminar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal editar empleados-->
                    <div class="modal fade" id="modalEditarEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Selecciona el empleado que desea editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <select name="empleado" id="">
                                            <?php echo $personal->inputLiderProyecto() ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="editarEmpleados" class="btn btn-primary">Editar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php echo $personal->personalCompleto() ?>
            </div>
        </div> 




        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>