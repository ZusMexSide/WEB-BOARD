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
                            <div class="proyecto" href="#"> Fecha:<br>' .  date('d-m-Y',strtotime($proyecto['fecha_exp'])) . '</div>
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
                            <a class="proyecto" href="descripcion.php">'.$this->modelo->mostrarNombreUsuario($carpeta['usuario_id']).'</a>
                            <p class="card-text">Crear una base de datos de una tienda</p>
                        </div>
                    </div>
                    </div>';
        }
        return $acu;
    }
}
