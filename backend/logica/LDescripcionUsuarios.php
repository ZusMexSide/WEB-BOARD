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
    $archivo = $proyectos->mostrarArchivos($_GET['id_carpeta'], $_SESSION['autentificado']['nombre']);
    $archivos_eliminar = $proyectos->mostrarArchivosEliminar($_GET['id_carpeta'], $_SESSION['autentificado']['nombre']);
    $comentarios=$proyectos->mostrarComentarios($_GET['id_carpeta']);
    
} else {
    header('Location: proyectos_usuarios.php');
}
if (isset($_POST['enviado'])) {
    $archivo = $_FILES['archivo'];
    if ($archivo['size'] >= 15000 * 1024) {
        $error = '<script type="text/javascript">
    alert("El archivo excede el peso maximo permitido de 15 mb");
    </script>';
    }
    if (empty($error)) {
        $enviar = true;
    }
    if ($enviar) {
        $proyectos->cambiarElStatus($_POST['carpeta'], $_POST['status']);
        $proyectos->subirArchivo($_GET['id_carpeta'], $archivo, $_GET['id_proyecto'], $_SESSION['autentificado']['nombre']);
        $proyectos->nuevoMovimiento($_GET['id_proyecto'], $_GET['id_carpeta'], $_SESSION['autentificado']['nombre'], 'subió un nuevo archivo llamado ' . $archivo['name']);
        header('Location: ../Usuarios/descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    }
}
if (isset($_POST['eliminarArchivo'])) {
    if (!empty($_POST['archivos'])) {
        $acu = "";
        foreach ($_POST['archivos'] as $archivo) {
            $proyectos->borrarArchivos($_GET['id_carpeta'], $archivo);
            $acu .= pathinfo($archivo, PATHINFO_BASENAME).' ';
        }
        $proyectos->nuevoMovimiento($_GET['id_proyecto'], $_GET['id_carpeta'], $_SESSION['autentificado']['nombre'], 'eliminó el(los) archivo(s) ' . $acu . '');
        header('Location: ../Usuarios/descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    } else {
        $error = '<script type="text/javascript">
    alert("No se seleccionaron archivos");
    </script>';
    }
}
if (isset($_POST['comentar'])){
    if (!empty($_POST['comentario'])){
        $comentario=filter_var(stripslashes(htmlspecialchars(trim($_POST['comentario']))), FILTER_SANITIZE_STRING);
        $proyectos->comentar( $_SESSION['autentificado']['usuario_id'],$_GET['id_carpeta'], $comentario);
        $proyectos->nuevoMovimiento($_GET['id_proyecto'], $_GET['id_carpeta'],$_SESSION['autentificado']['nombre'],'hizo un nuevo comentario');
        header('Location: ../Usuarios/descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    }else {
        $error = '<script type="text/javascript">
    alert("El comentario no puede estar vacio");
    </script>';
    }
}
