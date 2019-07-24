<?php
session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
}
if (!empty($_GET['id_proyecto']) && !empty($_GET['id_carpeta']) ) {
    $proyectos = new CProyecto();
    $proyecto = $proyectos->mostrarProyecto($_GET['id_proyecto']);
    $carpeta = $proyectos->mostrarDescripcionUsuario($_GET['id_carpeta']);
    $tarea=$proyectos->mostrarTareaEmpleado($_GET['id_carpeta']);
} else {
    header('Location: proyectos_usuarios.php');
}
