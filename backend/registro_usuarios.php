<?php

$CRegistro_usuarios= new CRegistro_usuarios();
$errores = "";
$enviado = "";
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $nivel_estudios = $_POST['nivel_estudios'];
    $correo = $_POST['email'];
    $tel = $_POST['tel'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    if (!empty($nombre)) {
        $nombre = trim($nombre);
        $nombre = htmlspecialchars($nombre);
        $nombre = stripslashes($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un nombre <br>";
    }
    if (!empty($nivel_estudios)) {
        $nivel_estudios = trim($nivel_estudios);
        $nivel_estudios = htmlspecialchars($nivel_estudios);
        $nivel_estudios = stripslashes($nivel_estudios);
        $nivel_estudios = filter_var($nivel_estudios, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta el nivel de estudios <br>";
    }
    if (!empty($correo)) {
        $correo = trim($correo);
        $correo = htmlspecialchars($correo);
        $correo = stripslashes($correo);
        $correo = filter_var($correo, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un correo electronico <br>";
    }
    if (!empty($tel)) {
        $tel = trim($tel);
        $tel = htmlspecialchars($tel);
        $tel = stripslashes($tel);
        $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un numero de telefono <br>";
    }
    if (!empty($usuario)) {
        $usuario = trim($usuario);
        $usuario = htmlspecialchars($usuario);
        $usuario = stripslashes($usuario);
        $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un numero de usuario <br>";
    }
    if (!empty($password)) {
        $password = trim($password);
        $password = htmlspecialchars($password);
        $password = stripslashes($password);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta tu contraseña <br>";
    }
    if (!$errores) {
        $enviado = true;
    }
    if($enviado){
        $CRegistro_usuarios->insertarUsuario( $nombre, $nivel_estudios, $correo, $tel, $usuario, $password);
    }
}




