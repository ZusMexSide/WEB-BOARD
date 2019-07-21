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
    if(empty($descripcion)){
        $errores.= " Inserta una descripcion del proyecto. <br>";
    }
    if (!empty($fecha)) {
        $fecha = trim($fecha);
        $fecha = htmlspecialchars($fecha);
        $fecha = stripslashes($fecha);
        $fecha = filter_var($fecha, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " Inserta una fecha de vencimiento. <br>";
    }
    if(empty($_POST['casilla'])){
        $errores .= " Selecciona los empleados a asignar. <br>";
    }
    if (empty($errores)){
        $enviado=true;
    }
    if ($enviado){
        $proyectos->insertarProyecto($nombre, $descripcion, $fecha, $lider);
       $id= $proyectos->obtenerId();
        foreach ($_POST['casilla'] as $user){
            $proyectos->asignarEmpleados($id, $user);
        }
    }
}
    
