<?php
include '../backend/modelo/BD.php';
include '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
include '../backend/logica/LDescripcion.php';
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
        <link rel="stylesheet" href="../css/descripcion.css">  
        <script src="../ckeditor/ckeditor.js"></script>
        <title>    Administrador</title>
    </head>
    <body>
        <div id = "fb-root" > </div> <script async defer crossorigin = "anonymous" src = "https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3" ></script> 
        <?php echo $navegacion ?>
        <div class="container">
            <div class="row">
                <div class="col-12"><h1><?php echo $carpeta[1] ?></h1></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col"> 
                    <div class="tabla"> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Status:</th>
                                    <th><?php echo $carpeta[0] ?></th>
                                </tr>
                                <tr>
                                    <th>Proyecto:</th>
                                    <th><?php echo $proyecto['nombre'] ?></th>
                                </tr>
                            </thead>
                            <tr>
                                <th>Inicio:</th>
                                <th><?php echo date('d-m-Y', strtotime($proyecto['fecha'])) ?></th>
                            </tr>
                            <tr>
                                <th>Expiracion:</th>
                                <th><?php echo date('d-m-Y', strtotime($proyecto['fecha_exp'])) ?></th>
                            </tr>   
                        </table>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"data-toggle="modal" data-target="#aprobar">Aprobar</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#desaprobar">Desaprobar</a>
                                <?php echo !empty($tarea['item'])? $tarea['item'] : "";?>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEliminarArchivos">Eliminar archivos</a>
                            </div>
                        </div>
                        <div class=" botones "> 
                            <!-- Modal Aprobar-->
                            <div class="modal fade" id="aprobar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Confirmar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-dark">Desea aprobar la tarea asignada</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $_GET['id_carpeta'] ?>" name="carpeta">
                                                <input type="hidden" value="2" name="status">
                                                <button type="submit" name="aprobar" class="btn btn-primary">Aprobar</button>
                                            </form>   
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal desaprobar -->
                            <div class="modal fade" id="desaprobar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Confirmar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-dark">Desea desaprobar la tarea asignada</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $_GET['id_carpeta'] ?>" name="carpeta">
                                                <input type="hidden" value="1" name="status">
                                                <button type="submit" name="desaprobar" class="btn btn-primary">Desaprobar</button>
                                            </form>   
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal editar tarea -->
                                <div class="modal fade" id="modalEditarTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <form method="post" >
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="exampleModalLabel">Ingrese los cambios en la tarea</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Descripcion">Descripcion:</label>
                                                    <textarea  class="ckeditor" name="descripcion"> <?php echo !empty($tarea['item'])? $tarea['tarea'] : "";?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="editarTarea" class="btn btn-primary">Modificar</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="col-sm">
                    <div class="texto"> 
                        <p><?php echo $tarea['tarea'] ?></p>
                        <h6><?php echo $error ?></h6> 
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="row">
                        <?php echo $archivo ?>
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
                                                    <?php echo $archivos_eliminar?>
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
                    </div>
                </div>
                <div class="col-12">
                    <div class="botones1">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Subir Archivo
                        </button>
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
                                            <input required type="file" name="archivo">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="subir" class="btn btn-primary">Subir</button>
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
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10" style="background-color:#212529;">
                    <div class="fb-comments" data-href="http://web-board.test:81/Usuarios/descripcion_usuarios.php?id_carpeta=<?php echo $_GET['id_carpeta'] ?>&amp;id_proyecto=<?php echo $_GET['id_proyecto'] ?>" data-width="100%" data-numposts="5" data-order-by="reverse_time" data-colorscheme="dark"></div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
        <script>
        function SetContents() {
      var editor = CKEDITOR;
      var value = document.getElementById('htmlArea').value;
      editor.setData(value);
    }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>