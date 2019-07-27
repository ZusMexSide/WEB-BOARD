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
        $acu = "";
        foreach ($personal as $persona) {
            $acu .= '<div class="col-sm-auto">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <div class="card-body">
                             <img src=../' . $persona["imagen"] . ' class="img-fluid  w-60 sm-3" alt="...">
                              <div class="card-title"> <strong>información</strong>
                              <br>
                               <p>' . $persona["nombre"] . '</p>
                                    <p>Puesto:' . $persona["nivel_estudios"] . '</p>
                                    <p>Tareas:Proyectos </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>';
        }
        return $acu;
    }

    public function agregarPersonal() {
        $personal = $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu = "";
        foreach ($personal as $persona) {
            $acu .= '<div class="col-sm-auto">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <div class="card-body">
                             <img src=../' . $persona["imagen"] . ' class="img-fluid  w-60 sm-auto" alt="...">
                              <div class="card-title"> <strong>información</strong>
                              <br>
                               <p>' . $persona["nombre"] . '</p>
                                    <p>Puesto:' . $persona["nivel_estudios"] . '</p>
                                    <p>Tareas:Proyectos </p>
                                     <input type="checkbox" name="casilla[]" value="' . $persona['usuario_id'] . '"> Añadir <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>';
        }
        return $acu;
    }

    public function inputLiderProyecto() {
        $lideres = $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu = "";
        foreach ($lideres as $lider) {
            $acu .= "<option value='" . $lider['usuario_id'] . "'>" . $lider['nombre'] . "</option> ";
        }
        return $acu;
    }

}
