<?php
session_start();
if (isset($_SESSION['autentificado'])) {
    if ($_SESSION['autentificado']["privilegios"] == "Empleado") {
        header('Location: Usuarios/proyectos_usuarios.php');
    } else {
        header('Location: Administrador/proyectos.php');
    }
}
$consulta = new CLogin();
if (isset($_POST['ingresar'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['password'];
    $error = "";
    if (!empty($usuario)) {
        $usuario = filter_var(stripslashes(htmlspecialchars(trim($usuario))), FILTER_SANITIZE_STRING);
    } else {
        $error .= "<h3>Inserta un nombre de usuario</h3><br>";
    }
    if (!empty($pass)) {
        $pass = filter_var(stripslashes(htmlspecialchars(trim($pass))), FILTER_SANITIZE_STRING);
    } else {
        $error .= "<h3>Inserta una contraseña</h3><br>";
    }
    if (empty($error)) {
        $respuesta = $consulta->validarUsuario($usuario);

        if (empty($respuesta)) {
            $error = "<h3>El usuario no existe";
        } else {
            $hash = $respuesta['contrasenia'];
            if (password_verify($pass, $hash)) {
                session_start();
                $_SESSION['autentificado'] = $respuesta;
                if ($_SESSION['autentificado']["privilegios"] == "Empleado") {
                    header('Location: Usuarios/proyectos_usuarios.php');
                } else {
                    header('Location: Administrador/proyectos.php');
                }
            } else {
                $error = "<h3>Contraseña incorrecta";
            }
        }
    }
}
?>
