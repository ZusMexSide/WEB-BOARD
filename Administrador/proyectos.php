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
        <link rel="stylesheet" href="../css/proyectos.css">  
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
                    <a class="nav-item nav-link active" href="proyectos.php">Proyectos<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    <a class="nav-item nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    <a class="nav-item nav-link" href="personal.php">Personal</a>
                </div>
            </div>
            <a class="salir" href=""> <i class="fas fa-sign-out-alt" ></i></a>
        </nav>
        <div class="inicio"> <h1>PROYECTOS</h1></div>
        <div class="container">
            <div class="row">

                <div class="col-sm">
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="verProyecto.php">Base De Datos</a>
                        <a class="lider" href="">Lider del proyecto: Jose Luis Perez</a>      
                        <div class="card-body">
                            <a class="proyecto" href="#">30/07/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Crear una base de datos de una tienda</p>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Matematicas</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">20/07/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Ingresar todas las actividades que se les solicitan.</p>
                        </div>
                    </div>

                </div>


                <div class="col-sm">
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Estadistica</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">18/07/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Ingresar todas las actividades que se les solicitan.</p>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Ingles</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">21/07/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Ingresar todas las actividades que se les solicitan.</p>
                        </div>
                    </div>

                </div>
                <div class="col-sm">
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Ciencias</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">10/08/2019</a>
                            <h5 class="card-title">6 Colaboradores</h5>
                            <p class="card-text">Hacer un reporte de la lectura de la semana</p>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Español</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">15/07/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Ingresar todas las actividades que se les solicitan.</p>
                        </div>
                    </div>

                </div>
                <div class="col-sm">
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Programaciòn</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">22/07/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Crear una base de datos de una tienda</p>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="#">Probabilidad</a>
                        <div class="card-body">
                            <a class="proyecto" href="#">30/08/2019</a>
                            <h5 class="card-title">5 Colaboradores</h5>
                            <p class="card-text">Ingresar todas las actividades que se les solicitan.</p>
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