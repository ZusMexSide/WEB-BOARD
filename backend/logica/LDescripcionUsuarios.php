<?php

session_start();
$error = "";
$enviar = "";
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
}
if (!empty($_GET['id_proyecto']) && !empty($_GET['id_carpeta'])) {
    $proyectos = new CProyecto();
    $proyecto = $proyectos->mostrarProyecto($_GET['id_proyecto']);
    $carpeta = $proyectos->mostrarDescripcionUsuario($_GET['id_carpeta']);
    $tarea = $proyectos->mostrarTareaEmpleado($_GET['id_carpeta']);
    $archivo=$proyectos->mostrarArchivos($_GET['id_carpeta']);
    $archivos_eliminar = $proyectos->mostrarArchivosEliminar($_GET['id_carpeta']);
} else {
    header('Location: proyectos_usuarios.php');
}
if (isset($_POST['aprobar'])) {
    $proyectos->cambiarElStatus($_POST['carpeta'], $_POST['status']);
    header('Location: ../Usuarios/descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
}
if (isset($_POST['enviado'])) {
    $archivo = $_FILES['archivo'];
    if ($archivo['size'] >= 15000 * 1024) {
        $error='<script type="text/javascript">
    alert("El archivo excede el peso maximo permitido de 15 mb");
    </script>';
    }
    if (empty($error)) {
        $enviar = true;
    }
    if ($enviar) {
        $proyectos->subirArchivo($_GET['id_carpeta'], $archivo, $_GET['id_proyecto']);
        header('Location: ../Usuarios/descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    }
}
if (isset($_POST['eliminarArchivo'])) {
    if (!empty($_POST['archivos'])) {
        foreach ($_POST['archivos'] as $archivo) {
            $proyectos->borrarArchivos($_GET['id_carpeta'], $archivo);
        }
         header('Location: ../Usuarios/descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
        } else {
        $error = '<script type="text/javascript">
    alert("No se seleccionaron archivos");
    </script>';
    }
}
