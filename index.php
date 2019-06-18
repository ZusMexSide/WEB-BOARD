<?php 

include_once './backend/BD.php';
include_once './backend/modelo/MRegistro_usuarios.php';
include_once './backend/controlador/CRegistro_usuarios.php';
include_once './backend/registro_usuarios.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>webboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link href="https://fonts.googleapis.com/css?family=Gugi|Patrick+Hand+SC|Rancho&display=swap" rel="stylesheet">
    </head>
    <body>

        <header>
            <div class="container">
                <div class="inicio">


                <div class="col-12">
                    <h1>WebBoard</h1>
                </div>
                     </div>
            </div>
        </header>
        <div class="container">
            <div class="col-4">
                <section>
                    <div class="aside">
                        <div class="nav">
                            <ul>
                                <li>
                                    <a>PROYECTOS</a>
                                </li>
                                <li>
                                    <a>GENERAR PROYECTO</a>
                                </li>
                                <li>
                                    <a>AGREGAR PERSONAL</a>
                                </li>
                                <li>
                                    <a>PERSONAL</a>
                                </li>
                                <li>
                                    <a>SALIR</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-4">
                <fieldset>
                     <div class="row">
                         <form action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="formulario">

                        <h1>Registrar Usuario</h1>
                        <div class="contenedor">

                            <div class="input-contenedor">
                                <i class="fas fa-user icon"></i>
                                <input type="text" placeholder="Nombre " name="nombre">

                            </div>
                            <div class="input-contenedor">
                                <i class="fas fa-user icon"></i>
                                <input type="text" placeholder="Nivel de estudios" name="nivel_estudios" >

                            </div>
                            <div class="input-contenedor">
                                <i class="fas fa-envelope icon"></i>
                                <input type="email" id="email" placeholder="Correo electronico" name="email">

                            </div>
                            <div class="input-contenedor">
                                <i class="fas fa-phone icon"></i>
                                <input type="text" placeholder="Numero de telefono" name="tel" >

                            </div>

                            <div class="input-contenedor">
                                <i class="fas fa-envelope icon"></i>
                                <input type="text" placeholder="Usuario" name="usuario" >

                            </div>

                            <div class="input-contenedor">
                                <i class="fas fa-key icon"></i>
                                <input type="password" placeholder="Contraseña" name="password">
                            </div>
                            <?php if(!empty($errores)): ?>
                              <div class="errores"> <?php echo $errores; ?> </div>
                            <?php elseif($enviado): ?>
                              <p>Enviado correctamente</p>
                              <?php endif; ?>
                            <input type="submit" name="submit" value="Registrate" class="button">
                        </div>
                        </form>
                     </div>
                </fieldset>
            </div>
        </div>
</body>
</html>
