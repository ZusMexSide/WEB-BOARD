<?php

session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
} else {
    if ($_SESSION['autentificado']["privilegios"] == "Empleado") {
        header('Location: ../index.php');
    }
}
$imprimir = new CUsuarios();
$proyectos = new CProyecto();
$errores = "";
$enviado = "";
if (isset($_POST['enviado'])) {
    $lider = $_POST['lider'];
    $nombre = $_POST['nombreProyecto'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    if (!empty($lider)) {
        $lider = trim($lider);
        $lider = htmlspecialchars($lider);
        $lider = stripslashes($lider);
        $lider = filter_var($lider, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " Selecciona un lider de proyecto. <br>";
    }
    if (!empty($nombre)) {
        $nombre = trim($nombre);
        $nombre = htmlspecialchars($nombre);
        $nombre = stripslashes($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " Inserta un nombre al proyecto. <br>";
    }
    if (empty($descripcion)) {
        $errores .= " Inserta una descripcion del proyecto. <br>";
    }
    if (!empty($fecha)) {
        $fecha = trim($fecha);
        $fecha = htmlspecialchars($fecha);
        $fecha = stripslashes($fecha);
        $fecha = filter_var($fecha, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " Inserta una fecha de vencimiento. <br>";
    }
    if (empty($_POST['casilla'])) {
        $errores .= " Selecciona los empleados a asignar. <br>";
    }
    if (empty($errores)) {
        $enviado = true;
    }
    if ($enviado) {
        $stmt = $proyectos->insertarProyecto($nombre, $descripcion, $fecha, $lider);
        $id = $proyectos->obtenerId();
        $acu = "";
        if ($stmt) {
            foreach ($_POST['casilla'] as $user) {
                $proyectos->asignarEmpleados($id, $user);
                $usuario = $imprimir->datosDeEmpleadoArray($user);
                $destino = $usuario['correo'];
                $asunto = 'Asignacion de proyecto';
                $contenido = 'Se te ha asignado a el proyecto ' . $nombre . ' que expira el ' . $fecha;
                mail($destino, $asunto, $contenido);
                $acu .= $usuario['nombre'] . ", ";
            }
            $usuario = $imprimir->datosDeEmpleadoArray($lider);
            $destino = $usuario['correo'];
            $asunto = 'Asignacion de privilegios';
            $contenido = 'Se te ha asignado como lider del proyecto ' . $nombre . 'con los siguientes empleados \n ' . $acu . '\n que expira el ' . $fecha;
            mail($destino, $asunto, $contenido);
            header('Location: proyectos.php');
        }
    }
}
    
