<?php

class CUsuarios {

    private $modeloRegistro_usuarios;

    public function __construct() {
        $this->modeloRegistro_usuarios = new MUsuarios();
    }

    public function insertarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url) {
        $this->modeloRegistro_usuarios->agregarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url);
    }

    public function personalCompleto() {
        $personal = $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu="";
        foreach ($personal as $persona) {
            $acu .='<div class="col-sm-3">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src=../'.$persona["imagen"]. ' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:'. $persona["nombre"] .'</h5>
                                    <h5>Puesto:'. $persona["nivel_estudios"] .'</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>';
        }
        return $acu;
    }
    public function agregarPersonal(){
        $personal = $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu="";
        foreach ($personal as $persona) {
            $acu .='<div class="col-sm-3">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <img src=../'.$persona["imagen"]. ' class="card-img-top" alt="...">
                            <div class="card-body">
                                <input type="checkbox" name="casilla[]" value="'.$persona['usuario_id'].'">
                                <h3 class="card-title">Informacion:</h3>
                                <div class="informacion">
                                    <h5>Nombre:'. $persona["nombre"] .'</h5>
                                    <h5>Puesto:'. $persona["nivel_estudios"] .'</h5>
                                    <h5>Tareas:Proyectos </h5>
                                </div>
                            </div>
                        </div>
                    </div>  </div>';
               
        }
        return $acu;
    }

    public function liderProyecto(){
        $lideres= $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu="";
        foreach ($lideres as $lider){
            $acu.= "<option value='".$lider['usuario_id']."'>".$lider['nombre']."</option> ";
        }
        return $acu;
    }

}
