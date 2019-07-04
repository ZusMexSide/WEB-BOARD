<?php
session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
} else {
    if ($_SESSION['autentificado']["privilegios"] == "Empleado") {
        header('Location: ../index.php');
    }
}
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/personal.css">
        <title>Usuarios</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">WebBoard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="proyectos.php">Proyectos</a>
                    <a class="nav-item nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    <a class="nav-item nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    <a class="nav-item nav-link active" href="personal.php">Personal<span class="sr-only">(current)</span></a>
                </div>
            </div>
             <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card mt-5 mr-150" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card mt-5 mr-150" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src="../imagenes/uno.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:Juan Torres </h5>
                                    <h5>Puesto:Diseñador</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 




        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>