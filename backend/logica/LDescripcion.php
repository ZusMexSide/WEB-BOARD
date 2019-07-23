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
        if ($_SESSION['autentificado']['usuario_id'] <> $proyecto['lider']) {
            header('Location: ../index.php');
        }
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
