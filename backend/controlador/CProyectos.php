<?php

class CProyecto {

    private $modelo;

    public function __construct() {
        $this->modelo = new MProyectos();
    }

    public function insertarProyecto($nombre, $descripcion, $fecha, $lider) {
        $this->modelo->nuevoProyecto($nombre, $descripcion, $fecha, $lider);
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
            $acu .= '<div class="col-sm-3">
                <div class="card text-white bg-white mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="verProyecto.php?id='.$proyecto['proyecto_id'].'">' . strtoupper(substr($proyecto['nombre'],0,12)) . '</a>
                        <a class="lider" href="">Lider del proyecto: ' . $this->modelo->mostrarLiderProyecto($proyecto['lider']) . '</a>      
                        <div class="card-body">
                            <div class="proyecto" href="#"> Fecha límite:<br>' .  date('d-m-Y',strtotime($proyecto['fecha_exp'])) . '</div>
                                <br>
                            <div class="card-title">Numero de colaboradores: ' . $this->modelo->numeroColaboradores($proyecto['proyecto_id']) . '</div>
                            <p class="card-text"> Descripcion: <br>' . substr(filter_var($proyecto['descripcion'], FILTER_SANITIZE_STRING), 0, 100) . '...</p>
                        </div>
                    </div>
                    </div>';
        }
        return $acu;
    }
    public function proyectosEmpleado($id) {
        $proyectos = $this->modelo->mostrarProyectosEmpleado($id);
        $acu = "";
        foreach ($proyectos as $proyecto) {
            $acu .= '<div class="col-sm-3">
                <div class="card text-dark bg-white mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="descripcion_usuarios.php?id='.$proyecto['proyecto_id'].'">' . strtoupper(substr($proyecto['nombre'],0,12)) . '</a>
                        <a class="lider" href="">Lider del proyecto: ' . $this->modelo->mostrarLiderProyecto($proyecto['lider']) . '</a>      
                        <div class="card-body">
                            <div class="proyecto" href="#"> Fecha límite:<br>' .  date('d-m-Y',strtotime($proyecto['fecha_exp'])) . '</div>
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
            $acu .= '<div class="col-sm-3">
                <div class="card text-dark bg-white mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="../Administrador/verProyecto.php?id='.$proyecto['proyecto_id'].'">' . strtoupper(substr($proyecto['nombre'],0,12)) . '</a>
                        <a class="lider" href="">Lider del proyecto: ' . $this->modelo->mostrarLiderProyecto($proyecto['lider']) . '</a>      
                        <div class="card-body">
                            <div class="proyecto" href="#"> Fecha límite:<br>' .  date('d-m-Y',strtotime($proyecto['fecha_exp'])) . '</div>
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
    public function mostrarCarpetas($id){
        $carpetas= $this->modelo->carpetas($id);
        $acu="";
        foreach ($carpetas as $carpeta){
            $acu.='<div class="col-sm-3">
                    <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <div class="card-header"><h2>'.$carpeta['status'].'</h2></div>
                        <div class="card-body">
                            <a class="proyecto" href="descripcion.php?id_carpeta='.$carpeta['carpeta_id'].'&id_proyecto='.$carpeta['proyecto_id'].'">'.$this->modelo->mostrarNombreUsuario($carpeta['usuario_id']).'</a>
                            <p class="card-text">Crear una base de datos de una tienda</p>
                        </div>
                    </div>
                    </div>';
        }
        return $acu;
    }
    public function mostrarDescripcionUsuario($id){
        $carpetas=$this->modelo->consultarStatus($id);
        foreach ($carpetas as $carpeta){
           $respuesta[0]=$carpeta['status'];
           $respuesta[1]=$this->modelo->mostrarNombreUsuario($carpeta['usuario_id']);
        }
        return $respuesta;
    }
    public function nuevaTarea($carpeta,$descripcion){
        $this->modelo->insertarTarea($carpeta, $descripcion);
    }
    public function mostrarTareas($id){
        $tareas=$this->modelo->consultarTarea($id);
        foreach ($tareas as $tarea){
        $devolver=$tarea['descripcion'];
    }
        if(empty($devolver)){
            return $devolver='<h3>No hay tareas asignadas</h3>
                   <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal" data-target="#exampleModal">Asignar tareas</button>
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
                                        <div class="container-fluid">
                                            <div class="row">
                                                <textarea class="ckeditor" name="descripcion"></textarea>
                            <input type="hidden" name="carpeta_id" value="'.$_GET['id_carpeta'].'">
                                            </div>
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
            return $devolver;
        }
    }
}
