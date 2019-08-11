<?php

session_start();
if (!isset($_SESSION['autentificado'])) {
    header('Location: ../index.php');
} else {
    if ($_SESSION['autentificado']["privilegios"] == "Empleado") {
        header('Location: ../index.php');
    }
}
$CRegistro_usuarios = new CUsuarios();
$errores = "";
$enviado = "";
$formulario = "";
$boton = "";
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $nivel_estudios = $_POST['nivel_estudios'];
    $correo = $_POST['email'];
    $tel = $_POST['tel'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (!empty($nombre)) {
        $nombre = filter_var(stripslashes(htmlspecialchars(trim($nombre))), FILTER_SANITIZE_STRING);
    } else {
        $errores .= "inserta un nombre <br> ";
    }
    if (!empty($nivel_estudios)) {
        $nivel_estudios = filter_var(stripslashes(htmlspecialchars(trim($nivel_estudios))), FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta el nivel de estudios <br>";
    }
    if (!empty($correo)) {
        $correo = filter_var(stripslashes(htmlspecialchars(trim($correo))), FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un correo electronico <br>";
    }
    if (!empty($tel)) {
        $tel = filter_var(stripslashes(htmlspecialchars(trim($tel))), FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un numero de telefono <br>";
    }
    if (!empty($usuario)) {
        $usuario = filter_var(stripslashes(htmlspecialchars(trim($usuario))), FILTER_SANITIZE_STRING);
    } else {
        $errores .= " inserta un numero de usuario <br>";
    }
    if (!empty($password)) {
        $password =filter_var(stripslashes(htmlspecialchars(trim($password))), FILTER_SANITIZE_STRING);
        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    } else {
        $errores .= " inserta tu contraseña <br>";
    }
    if (!empty($_FILES['foto']['tmp_name'])) {
        copy($_FILES['foto']['tmp_name'], "../imagenes/" . $_FILES['foto']['name']);
        $url = "imagenes/" . $_FILES['foto']['name'];
    } else {
        $errores .= "selecciona una foto <br>";
    }
    if (!$errores) {
        $enviado = true;
    }
    if ($enviado) {
        $CRegistro_usuarios->insertarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url);
    }
}
if (isset($_GET['id'])) {
    $formulario = $CRegistro_usuarios->datosDeEmpleado($_GET['id']);
    $array_empleado = $CRegistro_usuarios->datosDeEmpleadoArray($_GET['id']);
    $boton = '<button name="modificar" type="submit" class="btn btn-primary btn-block ">Modificar</button>';
} else {
    $formulario = '<div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingresa su nombre completo">
                                        <label for="exampleInputEmail1">
                                            <i class="fas fa-user" ></i>
                                            Nombre
                                        </label>
                                        </span>
                                        <input  name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="form-group">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingresa un correo valido">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-envelope" ></i>
                                            Correo Electronico</label>
                                            </span>
                                        <input name="email" type="email" class="form-control" id="correo" placeholder="">
                                    </div>
                                    <div class="form-group">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingresa tu usuario con menos de 10 caracteres">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-user" ></i>
                                            Usuario</label>
                                            </span>
                                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingresa el nivel de estudios del usuario">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-school" ></i>
                                            Nivel de estudios</label>
                                        <input name="nivel_estudios"  type="text" class="form-control" id="puesto" placeholder="">
                                    </div>
                                    <div class="form-group">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ingresar solo los 10 digitos de su telefono">
                                          <label for="exampleInputPassword1">
                                            <i class="fas fa-phone" ></i>
                                            Numero De Telefono</label>
                                            </span>
                                        <input name="tel" pattern="[0-9]{10}" type="tel" class="form-control" id="telefono" placeholder="">
                                    </div>
                                    <div class="form-group">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Verifica tu password">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-key" ></i>
                                            Password</label>
                                            </span>
                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                    </div>
                                </div>
                             </div>
                        </div>
                         <div class="form-div">
                                    <label for="foto" class="input-label" class="fotito">
                                        <i class="fas fa-upload" ></i>
                                        <span id="label_span">Ingresar foto del usuario</span>
                                    </label>
                                    <input name="foto" pattern="[a-z]{0,12}" multiple="true" type="file" accept="images/*"  id="foto" >
                                </div>';
    $boton = '<button name="submit" type="submit" class="btn btn-primary btn-block ">Añadir</button>';
}
 if (isset($_POST['modificar'])) {
        $nombre = $_POST['nombre'];
        $nivel_estudios = $_POST['nivel_estudios'];
        $correo = $_POST['email'];
        $tel = $_POST['tel'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $usuario_id=$_GET['id'];

        if (!empty($nombre)) {
            $nombre =filter_var(stripslashes(htmlspecialchars(trim($nombre))), FILTER_SANITIZE_STRING);
        } else {
            $nombre = $array_empleado['nombre'];
        }
        if (!empty($nivel_estudios)) {
            filter_var(stripslashes(htmlspecialchars(trim($nivel_estudios))), FILTER_SANITIZE_STRING);
        } else {
            $nivel_estudios = $array_empleado['nivel_estudios'];
        }
        if (!empty($correo)) {
            filter_var(stripslashes(htmlspecialchars(trim($correo))), FILTER_SANITIZE_STRING);
        } else {
            $correo = $array_empleado['correo'];
        }
        if (!empty($tel)) {
            filter_var(stripslashes(htmlspecialchars(trim($tel))), FILTER_SANITIZE_STRING);
        } else {
            $tel = $array_empleado['tel'];
        }
        if (!empty($usuario)) {
            filter_var(stripslashes(htmlspecialchars(trim($usuario))), FILTER_SANITIZE_STRING);
        } else {
            $usuario = $array_empleado['usuario'];
        }
        if (empty($password)) {
            $password = $array_empleado['contrasenia'];
        } else {
            filter_var(stripslashes(htmlspecialchars(trim($password))), FILTER_SANITIZE_STRING);
            $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
        }
        if (empty($_FILES['foto']['tmp_name'])) {
            $url = $array_empleado['imagen'];
        } else {
             unlink('../' . $array_empleado['imagen']);
            copy($_FILES['foto']['tmp_name'], "../imagenes/" . $_FILES['foto']['name']);
            $url = "imagenes/" . $_FILES['foto']['name'];
        }
        $CRegistro_usuarios->modificarEmpleado($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url, $usuario_id);
       header('Location: personal.php');
        }
