<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MUsuarios.php';
include_once '../backend/controlador/CUsuarios.php';
include_once '../backend/logica/registro_usuarios.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/agregarPersonal.css">
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
     <title>Usuarios</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="proyectos.php">WebBoard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="proyectos.php">Proyectos</a>
                    <a class="nav-item nav-link" href="generarProyecto.php">Generar Proyecto</a>
                    <a class="nav-item nav-link active" href="agregarPersonal.php">Agregar Personal<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="personal.php">Personal</a>

                </div>
            </div>
            <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
        </nav>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-5">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="form-container">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                <i class="fas fa-user" ></i>
                                Nombre
                            </label>
                            <input  name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                <i class="fas fa-school" ></i>
                                Nivel de estudios</label>
                         <input name="nivel_estudios" type="text" class="form-control" id="puesto" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                               <i class="fas fa-envelope" ></i> 
                                Correo Electronico</label>
                            <input name="email" type="email" class="form-control" id="correo" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                            <i class="fas fa-phone" ></i>    
                                Numero De Telefono</label>
                            <input name="tel" type="tel" class="form-control" id="telefono" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                <i class="fas fa-user" ></i>
                                Usuario</label>
                            <input type="text" name="usuario" class="form-control" id="usuario" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                <i class="fas fa-key" ></i>
                                Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                        </div>
                        <div class="form-div">
                         <label for="foto" class="input-label">
                           <i class="fas fa-upload" ></i>
                           <span id="label_span">Ingresar foto del usuario</span>
                            </label>
                            <input name="foto" multiple="true" type="file" accept="images/*" id="foto" >
                        </div>

                        <?php if (!empty($errores)): ?>
                            <div class="errores"> <?php echo $errores; ?> </div>
                        <?php elseif ($enviado): ?>
                            <div class="exitoso">Enviado correctamente</div>
                        <?php endif; ?>
                        <button name="submit" type="submit" class="btn btn-primary btn-block ">Ingresar</button>
                    </form>

                </div>
            </div>
        </div>
        <script src="../js/agregarImagen.js"> </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
