<?php
include '../backend/modelo/BD.php';
include_once '../backend/modelo/MUsuarios.php';
include_once '../backend/controlador/CUsuarios.php';
include '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
include '../backend/logica/LVer_proyecto.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.css">  
        <link rel="stylesheet" href="../css/full.css"> 
        <script src="../ckeditor/ckeditor.js"></script>
        <title>Usuarios</title>
    </head>
    <body>
        <?php
        echo $navegacion;
        echo $error;
        ?>
        <div class="section-title-wr  style-2 base base-al">
            <br>
            <h3 class="section-title left"> <span> <?php echo $proyecto['nombre'] ?> </span></h3>
        </div>

        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-3">
                    <div class="secund">
                    <table class="table">
                        <thead>
                            <tr> <th> Descripcion:</th></tr>
                        </thead>
                        <tr>
                            <th>Inicio:</th>
                            <th><?php echo date('d-m-Y', strtotime($proyecto['fecha'])) ?></th>
                        </tr>
                        <tr>
                            <th>Expiracion:</th>
                            <th><?php echo date('d-m-Y', strtotime($proyecto['fecha_exp'])) ?></th>
                        </tr>
                        <tr>
                            <th>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEditarProyecto"onclick="SetContents();">Editar el proyecto</a>
                                        <a class="dropdown-item" href="#"data-toggle="modal" data-target="#modalAgregar">Agregar mas empleados</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEliminar">Eliminar proyecto</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEliminarEmpleados">Eliminar empleados del proyecto</a>

                                    </div>
                                </div>
                            </th>
                        </tr>
                    </table> 
                    </div>
                </div>
                <div class="col-md-auto">
                    <div class="cardver">
                        <div class="card-headerver">
                            <span>Descripción del proyecto</span>     
                        </div>
                        <div class="card-bodyver">
                            <blockquote class="blockquote mb-0">
                                <?php echo $proyecto['descripcion'] ?>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="container">
            <div class="row">
                <?php echo $carpeta ?>
            </div>
        </div>
        <!-- Modal editar el proyecto -->
        <div class="modal fade" id="modalEditarProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form method="post" >
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Ingrese los datos para modificar el proyecto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="fecha">Fecha de expiracion:</label><br>
                                <input type="date" name="fecha" value="<?php echo $proyecto['fecha_exp'] ?>" >
                            </div>
                            <div class="form-group">
                                <label for="Descripcion">Descripcion:</label>
                                <textarea  class="ckeditor" name="descripcion"><?php echo $proyecto['descripcion'] ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="editarProyecto" class="btn btn-primary">Modificar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal agregar personal -->
        <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header ">
                            <strong class="modal-title text-dark"> Selecione usuarios para el proyecto </strong>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php echo $imprimir ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="agregar" class="btn btn-primary">agregar</button>
                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark">¿Desea eliminar el proyecto?</p>
                    </div>
                    <div class="modal-footer">
                        <form method="post">
                            <input type="hidden" value="<?php echo $_GET['id'] ?>" name="carpeta">
                            <button type="submit" name="eliminar" class="btn btn-primary">Eliminar</button>
                        </form>   
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Eliminar empleados -->
        <div class="modal fade" id="modalEliminarEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Selecciona los empleados que desea eliminar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php echo $eliminar_empleados ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="eliminarEmpleados" class="btn btn-primary">Eliminar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
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