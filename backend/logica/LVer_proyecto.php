<?php
session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
}
if (!empty($_GET['id'])) {
    $error="";
    $proyectos = new CProyecto();
    $usuarios= new CUsuarios();
    $proyecto = $proyectos->mostrarProyecto($_GET['id']);
    $carpeta = $proyectos->mostrarCarpetas($_GET['id']);
    $imprimir=$usuarios->mostrarPersonalQueNoEstaEnElProyecto($_GET['id'],$proyectos,$proyecto['lider']);
    $eliminar_empleados=$proyectos->mostrarEmpleadosParaELiminarDentroDeProyecto($_GET['id']);
    if (empty($imprimir)){
        $imprimir='<h2>No hay mas empleados disponibles</h2>';
    }
    if ($_SESSION['autentificado']['privilegios'] == 'Empleado') {
        $navegacion=' <nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar">
                    <a class="nav-link p-0" href="#">
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-5.jpg" class="rounded-circle z-depth-0"
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
                   
                    <li class="nav-item active">
                        <a class="nav-link" href="proyectos.php"> Ver Proyectos</a>
                    </li>
               </ul>
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item avatar">
                        <a  class="nav-item avatar" href="../backend/logica/cerrar_sesion.php"> Salir <i class="fas fa-sign-in-alt" ></i></a>
                    </li>
                </ul>

            </div>
        </nav>';
        if ($_SESSION['autentificado']['usuario_id'] <> $proyecto['lider']) {
            header('Location: ../index.php');
        }
    } else {
        $navegacion='<nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item avatar">
                    <a class="nav-link p-0" href="#">
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-5.jpg" class="rounded-circle z-depth-0"
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
                    <li class="nav-item active">
                        <a class="nav-link" href="proyectos.php">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    </li>
                    <li class="nav-item">
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
        </nav>';
    }
} else {
    header('Location: proyectos.php');
}
if (isset($_POST['eliminar'])){
    $proyectos->eliminarUnProyecto($_GET['id']);
    header('Location: proyectos.php');
}
if (isset($_POST['agregar'])){
    if (!empty($_POST['casilla'])){
    foreach ($_POST['casilla'] as $user){
            $proyectos->asignarEmpleados($_GET['id'], $user);
        }
    header('Location: verProyecto.php?id='.$_GET['id'].'');
    }else{
        $error='<script type="text/javascript">
    alert("No se selecciono ningun empleado.");
    </script>';
    }
}
if (isset($_POST['eliminarEmpleados'])){
    if (!empty($_POST['empleados'])){
        foreach ($_POST['empleados'] as $empleado){
            $proyectos->eliminarEmpleadosDelProyecto($_GET['id'], $empleado);
             header('Location: verProyecto.php?id='.$_GET['id'].'');
        }
    } else {
       $error='<script type="text/javascript">
    alert("No se selecciono ningun empleado.");
    </script>'; 
    }
}
if (isset($_POST['editarProyecto'])){
    if (!empty($_POST['fecha']) && !empty($_POST['descripcion'] )){
        $proyectos->modificarProyecto($_GET['id'], $_POST['fecha'], $_POST['descripcion']);
         header('Location: verProyecto.php?id='.$_GET['id'].'');
    } else {
         $error='<script type="text/javascript">
    alert("No se insertaron datos a modificar del proyecto.");
    </script>'; 
    }
}