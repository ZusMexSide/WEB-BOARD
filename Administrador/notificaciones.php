<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
include '../backend/modelo/MUsuarios.php';
include '../backend/controlador/CUsuarios.php';
$controlador= new CProyecto();
$tarea=$controlador->imprimirDashboard();
print_r($tarea);
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.css">  
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
                    <a class="nav-item nav-link" href="proyectos.php">Proyectos<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    <a class="nav-item nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    <a class="nav-item nav-link" href="personal.php">Personal</a>
                    <a class="nav-item nav-link active" href="notificaciones.php">Notificaciones</a>
                </div>
                <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
            </div>
        </nav>
        <br>
        <br>
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Proyecto</th>
      <th scope="col">Carpeta</th>
      <th scope="col">Descripcion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <th> </th>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    
  </tbody>
</table>


    </body>
</html>