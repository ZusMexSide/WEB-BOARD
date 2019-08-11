<?php

session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
}
$error = "";
if (!empty($_GET['id_proyecto']) && !empty($_GET['id_carpeta'])) {
    $proyectos = new CProyecto();
    $proyecto = $proyectos->mostrarProyecto($_GET['id_proyecto']);
    if ($_SESSION['autentificado']['privilegios'] == 'Empleado') {
        $navegacion = ' <nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
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
        $navegacion = '<nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
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
        </nav>
       ';
    }
    $carpeta = $proyectos->mostrarDescripcionUsuario($_GET['id_carpeta']);
    $tarea = $proyectos->mostrarTareas($_GET['id_carpeta']);
    $archivo = $proyectos->mostrarArchivos($_GET['id_carpeta'], $_SESSION['autentificado']['nombre']);
    $archivos_eliminar = $proyectos->mostrarArchivosEliminar($_GET['id_carpeta'], $_SESSION['autentificado']['nombre']);
    $comentarios = $proyectos->mostrarComentarios($_GET['id_carpeta']);
    $destino = $proyectos->mostrarCorreoUsuario($_GET['id_carpeta']);
} else {
    header('Location: proyectos.php');
}
if (isset($_POST['enviado'])) {
    if (!empty($_POST['descripcion'])) {
        $proyectos->nuevaTarea($_POST['carpeta_id'], $_POST['descripcion']);
        $asunto = 'Asignacion de tarea';
        $contenido = 'El lider del proyecto ' . $proyecto['nombre'] . ' te asigno una tarea' . \n . 'en tu carpeta personal.';
        mail($destino, $asunto, $contenido);
        header('Location: descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    } else {
        $error .= "No se insertó tarea";
    }
}
if (isset($_POST['aprobar'])) {
    $proyectos->cambiarElStatus($_POST['carpeta'], $_POST['status']);
    $asunto = 'Tarea Aprobada';
    $contenido = 'El lider del proyecto ' . $proyecto['nombre'] . ' ha aprobado tu tarea';
    mail($destino, $asunto, $contenido);
    header('Location: descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
}
if (isset($_POST['desaprobar'])) {
    $proyectos->cambiarElStatus($_POST['carpeta'], $_POST['status']);
    $asunto = 'Tarea Desaprobada';
    $contenido = 'El lider del proyecto ' . $proyecto['nombre'] . ' desaprobó tu tarea e hizo la siguiente observacion: \n ' . $_POST['motivo'];
    mail($destino, $asunto, $contenido);
    header('Location: descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
}
if (isset($_POST['subir'])) {
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
        $proyectos->subirArchivo($_GET['id_carpeta'], $archivo, $_GET['id_proyecto'], $_SESSION['autentificado']['nombre']);
        header('Location: ../Administrador/descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    }
}
if (isset($_POST['editarTarea'])) {
    $proyectos->modificarTarea($_GET['id_carpeta'], $_POST['descripcion']);
    header('Location: ../Administrador/descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
}
if (isset($_POST['eliminarArchivo'])) {
    if (!empty($_POST['archivos'])) {
        foreach ($_POST['archivos'] as $archivo) {
            $proyectos->borrarArchivos($_GET['id_carpeta'], $archivo);
        }
        header('Location: ../Administrador/descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    } else {
        $error = '<script type="text/javascript">
    alert("No se seleccionaron archivos");
    </script>';
    }
}
if (isset($_POST['comentar'])) {
    if (!empty($_POST['comentario'])) {
        $comentario = filter_var(htmlspecialchars(trim($_POST['comentario'])), FILTER_SANITIZE_STRING);
        $proyectos->comentar($_SESSION['autentificado']['usuario_id'], $_GET['id_carpeta'], $comentario);
        $asunto = 'Comentario del lider de proyecto';
        $contenido = 'El lider del proyecto ' . $proyecto['nombre'] . ' ha hecho un comentario \n en tu carpeta personal.';
        mail($destino, $asunto, $contenido);
        header('Location: ../Administrador/descripcion.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '');
    } else {
        $error = '<script type="text/javascript">
    alert("El comentario no puede estar vacio");
    </script>';
    }
}