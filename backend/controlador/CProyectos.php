<?php

class CProyecto {

    private $modelo;

    public function __construct() {
        $this->modelo = new MProyectos();
    }

    public function insertarProyecto($nombre, $descripcion, $fecha, $lider) {
       return $this->modelo->nuevoProyecto($nombre, $descripcion, $fecha, $lider);
    }

    public function obtenerId() {
        $id = $this->modelo->consultarUltimoProyecto();
        foreach ($id as $array) {
            return $array['proyecto_id'];
        }
    }

    public function asignarEmpleados($id_proyecto, $id_usuario) {
        $this->modelo->asignarProyecto($id_proyecto, $id_usuario);
    }

    public function proyectosAdmin() {
        $proyectos = $this->modelo->mostrarProyectosAdmin();
        $acu = "";
        foreach ($proyectos as $proyecto) {
            $acu .= '<div class="col-md-auto">
                <div class="tarjetas">
                <div class="card text-white bg-white mt-5" style="max-width: 18rem;">
                        <a class="card-header">' . strtoupper(substr($proyecto['nombre'],0,12)) . '</a>
                            <br>
                        <span class="lider" href="">Lider del proyecto: ' . $this->modelo->mostrarLiderProyecto($proyecto['lider']) . '</span>
                        <div class="card-body">
                            <div class="proyecto" href="#"> Fecha límite:<br>' .  date('d-m-Y',strtotime($proyecto['fecha_exp'])) . '</div>
                                <br>
                            <div class="card-title">Numero de colaboradores: ' . $this->modelo->numeroColaboradores($proyecto['proyecto_id']) . '</div>
                            <p class="card-text"> Descripcion: <br>' . substr(filter_var($proyecto['descripcion'], FILTER_SANITIZE_STRING), 0, 100) . '...</p>
                      </div>
                   <div class="vermas">  <a href="verProyecto.php?id='.$proyecto['proyecto_id'].'"> Ver Proyecto</a> </div>
                     <br>
                     </div>
                     <br>
                     </div>
                    </div>';
        }
        return $acu;
    }

    public function proyectosEmpleado($usuario_id) {
        $proyectos = $this->modelo->mostrarProyectosEmpleado($usuario_id);
        $acu = "";
        foreach ($proyectos as $proyecto) {
            $acu .= '<div class="col-md-auto">
                <div class="card text-dark bg-white mt-5" style="max-width: 18rem;">
                        <a class="card-header" href="descripcion_usuarios.php?id_carpeta=' . $this->modelo->consultarIdCarpeta($usuario_id, $proyecto['proyecto_id']) . '&id_proyecto=' . $proyecto['proyecto_id'] . '">' . strtoupper(substr($proyecto['nombre'], 0, 12)) . '</a>
                     <br>   
<a class="lider" href="">Lider del proyecto: ' . $this->modelo->mostrarLiderProyecto($proyecto['lider']) . '</a>
                        <div class="card-body">
                            <div class="proyecto" href="#"> Fecha límite:<br>' . date('d-m-Y', strtotime($proyecto['fecha_exp'])) . '</div>
                                <br>
                            <div class="card-title">Numero de colaboradores: ' . $this->modelo->numeroColaboradores($proyecto['proyecto_id']) . '</div>
                            <p class="card-text"> Descripcion: <br>' . substr(filter_var($proyecto['descripcion'], FILTER_SANITIZE_STRING), 0, 100) . '...</p>
                        </div>
                    </div>
                    </div>';
        }
        return $acu;
    }

    public function proyectosEmpleadoDondeEsLider($id) {
        $proyectos = $this->modelo->consultarProyectoDondeEsLider($id);
        $acu = "";
        foreach ($proyectos as $proyecto) {
            $acu .= '<div class="col-md-auto">
                <div class="card text-dark bg-white mt-5" style="max-width: 18rem;">
                        <a class="card-header" href="../Administrador/verProyecto.php?id=' . $proyecto['proyecto_id'] . '">' . strtoupper(substr($proyecto['nombre'], 0, 12)) . '</a>
                       <br>
<a class="lider" href="">Lider del proyecto: ' . $this->modelo->mostrarLiderProyecto($proyecto['lider']) . '</a>
                        <div class="card-body">
                            <div class="proyecto" href="#"> Fecha límite:<br>' . date('d-m-Y', strtotime($proyecto['fecha_exp'])) . '</div>
                                <br>
                            <div class="card-title">Numero de colaboradores: ' . $this->modelo->numeroColaboradores($proyecto['proyecto_id']) . '</div>
                            <p class="card-text"> Descripcion: <br>' . substr(filter_var($proyecto['descripcion'], FILTER_SANITIZE_STRING), 0, 100) . '...</p>
                        </div>
                    </div>
                    </div>';
        }
        return $acu;
    }

    public function mostrarProyecto($id) {
        return $this->modelo->consultarProyecto($id);
    }

    public function eliminarUnProyecto($proyecto_id) {
        $carpetas = $this->modelo->carpetas($proyecto_id);
        foreach ($carpetas as $carpeta) {
            $archivos = $this->modelo->consultarArchivos($carpeta['carpeta_id']);
            foreach ($archivos as $archivo) {
                unlink($archivo['url']);
            }
            rmdir('../archivos/' . $proyecto_id . '/' . $carpeta['carpeta_id']);
        }
        rmdir('../archivos/' . $proyecto_id);
        $this->modelo->eliminarProyecto($proyecto_id);
    }

    public function mostrarElLiderDelProyecto($usuario_id) {
        return $this->modelo->mostrarLiderProyecto($usuario_id);
    }

    public function mostrarEmpleadosParaELiminarDentroDeProyecto($proyecto_id) {
        $carpetas = $this->modelo->carpetas($proyecto_id);
        $acu = "";
        foreach ($carpetas as $carpeta) {
            $acu .= '<input type="checkbox" name="empleados[]" value="' . $carpeta['usuario_id'] . '">' . $this->modelo->mostrarNombreUsuario($carpeta['usuario_id']) . '<br>';
        }
        return $acu;
    }

    public function modificarProyecto($proyecto_id, $fecha_exp, $descripcion) {
        $this->modelo->actualizarProyecto($proyecto_id, $fecha_exp, $descripcion);
    }

//    CARPETAS--------------------------------------------------------------------------------------------
    public function mostrarCarpetas($id) {
        $carpetas = $this->modelo->carpetas($id);
        $acu = "";
        foreach ($carpetas as $carpeta) {
            $tareas = $this->modelo->consultarTarea($carpeta['carpeta_id']);
            if (!empty($tareas)) {
                $acu .= '<div class="col-md-auto">
                    <div class="cardv text-white bg-white mt-5" style="max-width: 18rem;">
                        <div class="card-header"><h2>' . $carpeta['status'] . '</h2></div>
                        <div class="card-body">
                         <a class="proyecto" href="descripcion.php?id_carpeta=' . $carpeta['carpeta_id'] . '&id_proyecto=' . $carpeta['proyecto_id'] . '">' . $this->modelo->mostrarNombreUsuario($carpeta['usuario_id']) . '</a>
                            <p class="card-text">' . substr(filter_var($tareas[0]["descripcion"], FILTER_SANITIZE_STRING), 0, 100) . '...</p>
                        </div>
                    </div>
                    </div>';
            } else {
                $acu .= '<div class="col-md-auto">
                    <div class="cardv text-white bg-white mt-5" style="max-width: 18rem;">
                        <div class="card-header"><h2>' . $carpeta['status'] . '</h2></div>
                        <div class="card-body">
                         <a class="proyecto" href="descripcion.php?id_carpeta=' . $carpeta['carpeta_id'] . '&id_proyecto=' . $carpeta['proyecto_id'] . '">' . $this->modelo->mostrarNombreUsuario($carpeta['usuario_id']) . '</a>
                            <p class="card-text">No hay tareas asignadas</p>
                        </div>
                    </div>
                    </div>';
            }
        }
        return $acu;
    }

    public function mostrarDescripcionUsuario($id) {
        $carpetas = $this->modelo->consultarStatus($id);
        foreach ($carpetas as $carpeta) {
            $respuesta[0] = $carpeta['status'];
            $respuesta[1] = $this->modelo->mostrarNombreUsuario($carpeta['usuario_id']);
        }
        return $respuesta;
    }
public function mostrarCorreoUsuario($carpeta_id) {
        $carpetas = $this->modelo->consultarStatus($carpeta_id);
        foreach ($carpetas as $carpeta) {
            $respuesta = $this->modelo->consultarUsuario($carpeta['usuario_id']);
        }
        return $respuesta['correo'];
    }
    public function cambiarElStatus($carpeta_id, $status) {
        $this->modelo->actualizarStatus($carpeta_id, $status);
    }

    public function eliminarEmpleadosDelProyecto($proyecto_id, $usuario_id) {
        $carpetas = $this->modelo->carpetas($proyecto_id);
        foreach ($carpetas as $carpeta) {
            $archivos = $this->modelo->consultarArchivos($carpeta['carpeta_id']);
            foreach ($archivos as $archivo) {
                unlink($archivo['url']);
            }
            rmdir('../archivos/' . $proyecto_id . '/' . $carpeta['carpeta_id']);
        }
        $this->modelo->eliminarCarpetasDeUnProyecto($proyecto_id, $usuario_id);
    }

//  TAREAS---------------------------------------------------------------------------------------------
    public function nuevaTarea($carpeta, $descripcion) {
        $this->modelo->insertarTarea($carpeta, $descripcion);
    }

    public function mostrarTareaEmpleado($id) {
        $tareas = $this->modelo->consultarTarea($id);
        foreach ($tareas as $tarea) {
            $devolver = $tarea['descripcion'];
        } if (empty($devolver)) {
            return $devolver = "<h3>No hay tareas asignadas</h3>";
        } else {
            return $devolver;
        }
    }

    public function mostrarTareas($id) {
        $tareas = $this->modelo->consultarTarea($id);
        $devolver = array();
        foreach ($tareas as $tarea) {
            $devolver['tarea'] = $tarea['descripcion'];
        }
        if (empty($devolver['tarea'])) {
            $devolver['tarea'] = '<h3>No hay tareas asignadas</h3>
                   <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">Asignar tareas</button>
                  <form method="post">
                   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <strong class="modal-title text-dark"> Ingresa la tarea a asignar </strong>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                           <textarea class="ckeditor" name="descripcion"></textarea>
                            <input type="hidden" name="carpeta_id" value="' . $_GET['id_carpeta'] . '">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" name="enviado">Asignar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>';
        } else {
            $devolver['item'] = '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEditarTarea"onclick="SetContents();">Editar tarea</a>';
        }
        return $devolver;
    }

    public function modificarTarea($carpeta_id, $tarea) {
        $this->modelo->actulizarTarea($carpeta_id, $tarea);
    }

//    ARCHIVOS
    public function subirArchivo($carpeta_id, $archivo, $proyecto_id, $propietario) {
        $ruta = '../archivos/' . $proyecto_id . '/' . $carpeta_id;
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }
        copy($archivo['tmp_name'], $ruta . '/' . $archivo['name']);
        $this->modelo->insertarArchivo($carpeta_id, $ruta . '/' . $archivo['name'], $propietario);
    }

    public function mostrarArchivos($carpeta_id, $nombre) {
        $arrays = $this->modelo->consultarArchivos($carpeta_id);
        $acu = array('propios' => "", 'no_propietario' => "");
        if (!empty($arrays)) {
            foreach ($arrays as $archivo) {
                if ($archivo['propietario'] == $nombre) {
                    $acu['propios'] .= '<div class="col-2">
                            <a  href="' . $archivo['url'] . '"><i class="fa fa-file" aria-hidden="true">' . pathinfo($archivo["url"], PATHINFO_BASENAME) . '</i></a>
                        </div>';
                } else {
                    $acu['no_propietario'] .= '<div class="col-2">
                            <a  href="' . $archivo['url'] . '"><i class="fa fa-file" aria-hidden="true">' . pathinfo($archivo["url"], PATHINFO_BASENAME) . '</i></a>
                        </div>';
                }
            }
        } else {
            $acu['propios'] = "";
            $acu['no_propietario'] = "";
        }
        return $acu;
    }

    public function mostrarArchivosEliminar($carpeta_id, $nombre) {
        $arrays = $this->modelo->consultarArchivos($carpeta_id);
        $acu = "";
        if (!empty($arrays)) {
            foreach ($arrays as $archivo) {
                if ($archivo['propietario'] == $nombre) {
                    $acu .= '<input type="checkbox" name="archivos[]" value="' . $archivo['url'] . '"><i class="fa fa-file" aria-hidden="true">' . pathinfo($archivo["url"], PATHINFO_BASENAME) . '</i><br>';
                }
            }
        } else {
            $acu = '<div class="col-12"><h3>No hay archivos existentes</h1></div>';
        }
        return $acu;
    }

    public function borrarArchivos($carpeta_id, $url) {
        unlink($url);
        $this->modelo->eliminarArchivos($carpeta_id, $url);
    }

//    COMENTARIOS
    public function comentar($usuario_id, $carpeta_id, $contenido) {
        $this->modelo->insertarComentario($usuario_id, $carpeta_id, $contenido);
    }

    public function mostrarComentarios($carpeta_id) {
        $comentarios = $this->modelo->consultarComentario($carpeta_id);
        $acu = "";
        foreach ($comentarios as $comentario) {
            $fecha = date('d-m-Y', strtotime($comentario['fecha']));
            $hora = date('H:i', strtotime($comentario['fecha']));
            $usuario = $this->modelo->consultarUsuario($comentario['usuario_id']);
            $acu .= '<div class="comments-container">
         <ul id="comments-list" class="comments-list">
                <li>
                    <div class="comment-main-level">
                      <div class="comment-avatar"><img src="../' . $usuario['imagen'] . '"alt="USUARIO"></div>
                          <div class="comment-box">
                            <div class="comment-head">
                                <h6 class=""><a href="http://creaticode.com/blog">' . $usuario['nombre'] . '</a></h6>
                                <span><small class="text-muted">Comentado el ' . $fecha . ' a las ' . $hora . '</small</span>
                                
                            </div>
                            <div class="comment-content">
                            <p>' . $comentario['contenido'] . ' </p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>';
        }
        return $acu;
    }

    public function mostrarDatosUsuario($usuario_id) {
        return $this->modelo->consultarUsuario($usuario_id);
    }

// MOVIMIENTOS
    public function nuevoMovimiento($proyecto_id, $carpeta_id, $nombre, $descripcion) {
        $this->modelo->insertarMovimiento($proyecto_id, $carpeta_id, $nombre, $descripcion);
    }
public function imprimirDashboard(){
    $eventos= $this->modelo->mostrarUltimosMovimientos();
    $acu="";
foreach ($eventos as $evento) {
  $proyecto=$this->modelo->consultarProyecto($evento['proyecto_id']);
  $acu.='<div class="comments-container">
         <ul  class="comments-list">
                <div class="comment-box">
                            <div class="comment-head">
                                <span><small class="text-muted">'.
                                  date('d-m-Y',strtotime($evento['fecha'])).' a las '.$evento['hora'].'</small</span>
                                 </div>
                            <div class="comment-content">
                         <h5 class="card-title">'.$proyecto['nombre'].'</h5>
                            <p>'.$evento['nombre'].' '.$evento['descripcion'].'</p>
                                 <a href="descripcion.php?id_carpeta='.$evento['carpeta_id'].'&id_proyecto='.$evento['proyecto_id'].'" class="btn btn-primary">Revisar</a>
                            </div>
                      
                    </div>
            </ul>
        </div>';
    }
return $acu;
  }
}
