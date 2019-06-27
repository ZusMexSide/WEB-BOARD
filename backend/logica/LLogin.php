<?php
$consulta= new CLogin();
if (isset($_POST['ingresar'])) {
$usuario= $_POST['usuario'];
$pass=$_POST['password'];
$error="";
if (!empty($usuario)) {
  $usuario=stripslashes(htmlspecialchars(trim($usuario)));
  $usuario=filter_var($usuario,FILTER_SANITIZE_STRING);
}else {
  $error.="<h3>Inserta un nombre de usuario</h3><br>";
}
if(!empty($pass)){
  $pass=stripslashes(htmlspecialchars(trim($pass)));
  $pass=filter_var($pass,FILTER_SANITIZE_STRING);
}else {
$error.="<h3>Inserta una contraseña</h3><br>";
}
if (empty($error)) {
$respuesta=$consulta->validarUsuario($usuario, $pass);
if (isset($respuesta)) {
  $_SESSION['autentificado']=$respuesta;  
  if ($_SESSION['autentificado']['privilegios']=="Empleado") {
      header('Location: /usuarios/proyectos_usuarios.php');
  }else{
  header('Location: /Administrador/proyectos.php');
  }
}else{
    $error.= "<h3>El usuario no existe</h3>";
}
}
}
 ?>
