<?php
session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
}
$error="";
if (!empty($_GET['id_proyecto']) && !empty($_GET['id_carpeta']) ) {
    $proyectos = new CProyecto();
    $proyecto = $proyectos->mostrarProyecto($_GET['id_proyecto']);
    if ($_SESSION['autentificado']['privilegios'] == 'Empleado') {
        $navegacion=' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="proyectos.php">WebBoard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="proyectos.php">Proyectos</a>
                    </div>
            </div>
             <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
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
                </div>
            </div>
             <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
        </nav>';
    }
    $carpeta = $proyectos->mostrarDescripcionUsuario($_GET['id_carpeta']);
    $tarea=$proyectos->mostrarTareas($_GET['id_carpeta']);
} else {
    header('Location: proyectos.php');

}
if (isset($_POST['enviado'])){
if (!empty($_POST['descripcion'])){
    $proyectos->nuevaTarea($_POST['carpeta_id'],$_POST['descripcion']);
    header('Location: descripcion.php?id_carpeta='.$_GET['id_carpeta'].'&id_proyecto='.$_GET['id_proyecto'].'');
}else{
   $error.="No se insertó tarea";
}
}
