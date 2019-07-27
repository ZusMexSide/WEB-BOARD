<?php

class CUsuarios {

    private $modeloRegistro_usuarios;
    private $modelo_proyectos;

    public function __construct() {
        $this->modeloRegistro_usuarios = new MUsuarios();
    }

    public function insertarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url) {
        $this->modeloRegistro_usuarios->agregarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url);
    }

    public function mostrarPersonalQueNoEstaEnElProyecto($proyecto_id, $objeto, $lider_proyecto) {
        $personas = $this->modeloRegistro_usuarios->mostrarPersonal();
        $participantes = $this->modeloRegistro_usuarios->consultarUsuariosDentroDeProyecto($proyecto_id);
        $lider = $objeto->mostrarElLiderDelProyecto($lider_proyecto);
        $acu = "";
        $cancelar = false;
        foreach ($personas as $persona) {
            if ($persona['privilegios'] == 'Gerente' || $persona['nombre'] == $lider) {
                continue;
            }
            foreach ($participantes as $participante) {
                if ($persona['usuario_id'] == $participante['usuario_id']) {
                    $cancelar = true;
                    break;
                }
            }
            if ($cancelar == false) {
                $acu .= '<div class="col-sm col-sm col-lg">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <div class="card-body">
                             <img src=../' . $persona["imagen"] . ' class="img-fluid rounded-circle w-60 sm-3" alt="...">
                              <div class="card-title"> <strong>información</strong>
                              <br>
                               <p>' . $persona["nombre"] . '</p>
                                    <p>Puesto:' . $persona["nivel_estudios"] . '</p>
                                     <input type="checkbox" name="casilla[]" value="' . $persona['usuario_id'] . '"> Añadir <br>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center">
                                    <div class="p-4">
                                    <a>
                                 <i class="fab fa-twitter"></i>
                                    </a href="#">
                                    </div>
                                    <div class="p-4">
                                    <a>
                                    <i class="fab fa-facebook-f"></i>
                                    </a href="#">
                                    </div>
                                    <div class="p-4">
                                    <a>
                                   <i class="fab fa-whatsapp"></i>
                                    </a href="#">
                                    </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                </div>';
            } else {
                $cancelar = false;
            }
        }
        return $acu;
    }

    public function personalCompleto() {
        $personal = $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu = "";
        foreach ($personal as $persona) {
            $acu .= '<div class="col-sm col-sm col-lg">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <div class="card-body">
                             <img src=../' . $persona["imagen"] . ' class="img-fluid rounded-circle w-60 sm-3" alt="...">
                              <div class="card-title"> <strong>información</strong>
                              <br>
                               <p>' . $persona["nombre"] . '</p>
                                    <p>Puesto:' . $persona["nivel_estudios"] . '</p>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center">
                                    <div class="p-4">
                                    <a>
                                 <i class="fab fa-twitter"></i>
                                    </a href="#">
                                    </div>
                                    <div class="p-4">
                                    <a>
                                    <i class="fab fa-facebook-f"></i>
                                    </a href="#">
                                    </div>
                                    <div class="p-4">
                                    <a>
                                   <i class="fab fa-whatsapp"></i>
                                    </a href="#">
                                    </div>
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
            if ($persona['privilegios'] == 'Gerente') {
                continue;
            }
            $acu .= '<div class="col-sm col-sm col-lg">
                    <div class="card mt-5" style="width: 15rem;">
                        <div class="uno"> 
                            <div class="card-body">
                             <img src=../' . $persona["imagen"] . ' class="img-fluid rounded-circle w-60 sm-3" alt="...">
                              <div class="card-title"> <strong>información</strong>
                              <br>
                               <p>' . $persona["nombre"] . '</p>
                                    <p>Puesto:' . $persona["nivel_estudios"] . '</p>
                                     <input type="checkbox" name="casilla[]" value="' . $persona['usuario_id'] . '"> Añadir <br>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center">
                                    <div class="p-4">
                                    <a>
                                 <i class="fab fa-twitter"></i>
                                    </a href="#">
                                    </div>
                                    <div class="p-4">
                                    <a>
                                    <i class="fab fa-facebook-f"></i>
                                    </a href="#">
                                    </div>
                                    <div class="p-4">
                                    <a>
                                   <i class="fab fa-whatsapp"></i>
                                    </a href="#">
                                    </div>
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
