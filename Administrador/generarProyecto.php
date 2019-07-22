<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MUsuarios.php';
include_once '../backend/controlador/CUsuarios.php';
include_once '../backend/modelo/MProyectos.php';
include_once '../backend/controlador/CProyectos.php';
include_once '../backend/logica/LProyecto.php';
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
        <link rel="stylesheet" href="../css/generarProyecto.css">  
        <link rel="stylesheet" href="../css/personal.css">
        <script src="../ckeditor/ckeditor.js"></script>
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
                    <a class="nav-item nav-link " href="proyectos.php">Proyectos</a>
                    <a class="nav-item nav-link active" href="generarProyecto.php"> Generar Proyecto</a>
                    <a class="nav-item nav-link" href="agregarPersonal.php">Agregar Personal</a>
                    <a class="nav-item nav-link" href="personal.php">Personal</a>

                </div>
            </div>
            <a class="salir" href="../backend/logica/cerrar_sesion.php"> <i class="fas fa-sign-out-alt" ></i></a>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6-auto">
                    <form class="form-container"  method="post" > 
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lider"> <p>Lider del proyecto</p></label>
                                        <select class="form-control" id="lider" name="lider">
                                            <?php echo $imprimir->liderProyecto(); ?>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nombreProyecto"> <p>Nombre Del Proyecto</p></label>
                                        <input type="text" class="form-control" id="nombreProyecto" name="nombreProyecto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                <div class="form-group">
                                    <label for="expiracion"><p>Fecha de expiración</p></label>
                            <input type="Date" row=10 class="form-control" id="correo" name="fecha">
                        </div>       
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <strong class="modal-title text-dark"> Selecione usuarios para el proyecto </strong> 
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <?php echo $imprimir->agregarPersonal() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#exampleModalLong">
                                        Ingresar descripcion
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#exampleModal">Agregar personal</button>
                                </div>
                            </div>
                        </div>


                        <button type="submit" name="enviado" class="btn btn-primary btn-block ">Guardar Proyecto</button>
                         <?php if (!empty($errores)): ?>
                            <div class="error"> <?php echo $errores; ?> </div>
                        <?php elseif ($enviado): ?>
                            <div class="error">Enviado correctamente</div>
                        <?php endif; ?>
                        <!--                        segundo modal-->
                        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <strong class="modal-title text-dark"> Descripción del proyecto </strong> 
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="Descripcion">Descripcion:</label>
                                            <textarea  class="ckeditor" name="descripcion" id="descripcion"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar Descripcion</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>