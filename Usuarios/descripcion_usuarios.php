<?php
include '../backend/modelo/BD.php';
include '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
include '../backend/logica/LDescripcionUsuarios.php';
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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Pragati+Narrow&display=swap" rel="stylesheet">        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/full.css">  
         <title>Proyectos</title>
        <link rel="shortcut icon" href="../img/logo-webBoard.png"/>
    </head>
    <body>
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
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
                        <a class="nav-link" href="proyectos_usuarios.php">Proyectos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item avatar">
                        <a  class="nav-item avatar" href="../backend/logica/cerrar_sesion.php"> Salir <i class="fas fa-sign-in-alt" ></i></a>
                    </li>
                </ul>

            </div>
        </nav>
        <div class="section-title-wr  style-2 base base-al">
            <br>
            <h4 class="section-title left"> <span><?php echo $carpeta[1] ?></span> Inicio:<?php echo date('d-m-Y', strtotime($proyecto['fecha'])) ?> Expiración:<?php echo date('d-m-Y', strtotime($proyecto['fecha_exp'])) ?></h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                  <h3>Tareas Asignadas</h3>     
                     <p><?php echo $tarea ?></p>
                     </div>
            
                <div class="col-sm">
                    <div class="cardverd">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Status:</th>
                                    <th><?php echo ($carpeta[0] == "Revisar") ? 'En revision' : $carpeta[0] ?></th>
                                </tr>
                                <tr>
                                    <th>Proyecto:</th>
                                    <th><?php echo $proyecto['nombre'] ?></th>
                                </tr>
                            </thead>
                            <tr>
                                <th>Contenido Compartido</th>
                                <th>  <?php echo!empty($archivo['no_propietario']) ? $archivo['no_propietario'] : '<p>No se compartieron archivos<p>'; ?></th>
                            </tr>
                            <tr>
                                <th>Mis Archivos</th>
                                <th> <?php echo!empty($archivo['propios']) ? $archivo['propios'] : '<p>No tienes archivos<p>'; ?> </th>
                            </tr>

                            <tr>
                                <th>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Opciones
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEliminarArchivos">Eliminar archivos</a>
                                        </div>
                                    </div> 
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <button type="button" class="btn btn-primaryv" data-toggle="modal" data-target="#exampleModalCenter">
                                        Subir Archivo
                                    </button>
                                </th>
                            </tr>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal eliminar archivos-->
        <div class="modal fade" id="modalEliminarArchivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" >
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Seleccione los archivos a eliminar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?php echo $archivos_eliminar ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="eliminarArchivo" class="btn btn-primary">Eliminar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row mt-5">
                <div class="col-12 mt-5">
                    <div class="botones1">
                        <?php echo $error; ?>
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Subir nuevo archivo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" value="<?php echo $_GET['id_carpeta'] ?>" name="carpeta">
                                            <input type="hidden" value="3" name="status">
                                            <input required type="file" name="archivo">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="enviado" class="btn btn-primary">Subir</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <form action="<?php echo 'descripcion_usuarios.php?id_carpeta=' . $_GET['id_carpeta'] . '&id_proyecto=' . $_GET['id_proyecto'] . '' ?>" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Comentar</label>
                            <textarea name="comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <input type="submit" name="comentar" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php echo $comentarios ?>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>