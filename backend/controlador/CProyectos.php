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
        $proyectos=$this->modelo->mostrarProyectosAdmin();
        $acu="";
        foreach ($proyectos as $proyecto){
            $acu.= '<div class="col-sm-3">
                <div class="card text-white bg-dark mt-5" style="max-width: 18rem;"> 
                        <a class="card-header" href="verProyecto.php">'.$proyecto['nombre'].'</a>
                        <a class="lider" href="">Lider del proyecto: '.$this->modelo->mostrarLiderProyecto($proyecto['lider']).'</a>      
                        <div class="card-body">
                            <a class="proyecto" href="#">'.$proyecto['fecha_exp'].'</a>
                            <h5 class="card-title">Numero de colaboradores: '.$this->modelo->numeroColaboradores($proyecto['proyecto_id']).'</h5>
                            <p class="card-text">'.substr(filter_var($proyecto['descripcion'], FILTER_SANITIZE_STRING),0,100).'...</p>
                        </div>
                    </div>
                    </div>';
        }
        return $acu ;
    }
    public function contar($id){
       return $this->modelo->numeroColaboradores($id);
    }

}
