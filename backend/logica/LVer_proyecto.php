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
        $navegacion=' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="proyectos.php">WebBoard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="proyectos.php">Proyectos</a>
                <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
                     </div>
                     </div>
        </nav>';
        if ($_SESSION['autentificado']['usuario_id'] <> $proyecto['lider']) {
            header('Location: ../index.php');
        }
    } else {
        $navegacion=' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="proyectos.php">WebBoard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="proyectos.php">Proyectos</a>
                    <a class="nav-item nav-link" href="generarProyecto.php"> Generar Proyecto</a>
                    <a class="nav-item nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    <a class="nav-item nav-link" href="personal.php">Personal</a>
                    <a class="nav-item nav-link" href="notificaciones.php">Notificaciones</a>
                </div>
                <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
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