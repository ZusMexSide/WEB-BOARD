<?php

class CUsuarios {

    private $modeloRegistro_usuarios;

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
                $acu .= '<div class="col-sm-auto">
                    <div class="card mt-5" style="width: 15rem;">
                    <div class="imgp">
                    <img src=../' . $persona["imagen"] . ' class="card-img-top"  w-60 sm-auto" alt="...">
                        </div>
                        <div class="uno"> 
                            <div class="card-bodie">
                            <span>INFORMACIÓN</span>
                              <div class="card-titulo"> 
                             <p>' . $persona["nombre"] . '</p>
                                <p>Nivel de estudios: ' . $persona["nivel_estudios"] . '</p>
                                        <input type="checkbox" name="casilla[]" value="' . $persona['usuario_id'] . '"> Añadir <br>
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
            $acu .= '<div class="col-sm-auto">
                    <div class="card mt-5" style="width: 15rem;">
                    <div class="imgp">
                    <img src=../' . $persona["imagen"] . ' class="card-img-top"  w-60 sm-auto" alt="...">
                        </div>
                        <div class="uno"> 
                            <div class="card-bodie">
                            <span>INFORMACIÓN</span>
                              <div class="card-titulo"> 
                             <p>' . $persona["nombre"] . '</p>
                                 <p>Nivel de estudios: ' . $persona["nivel_estudios"] . '</p>
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
            $acu .= '<div id="f'.$persona['usuario_id'].'" class="col-sm-auto">
                    <div  class="card mt-5" style="width: 15rem;">
                    <div class="imgp">
                    <img src=../' . $persona["imagen"] . ' class="card-img-top"  w-60 sm-auto" alt="...">
                        </div>
                        <div class="uno"> 
                            <div class="card-bodie">
                            <span>INFORMACIÓN</span>
                              <div class="card-titulo"> 
                             <p>' . $persona["nombre"] . '</p>
                                <p>Nivel de estudios: ' . $persona["nivel_estudios"] . '</p>
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
            $acu .= "<option id=".$lider['usuario_id']." value='" . $lider['usuario_id'] . "'>" . " " . $lider['nombre'] . "</option> ";
        }
        return $acu;
    }

    public function inputEliminarEmpleados() {
        $empleados = $this->modeloRegistro_usuarios->mostrarPersonal();
        $acu = "";
        foreach ($empleados as $empleado) {
            $acu .= '<input class="" type="checkbox" name="empleados[]" value="' . $empleado['usuario_id'] . '">' . " " . $empleado['nombre'] . '<br>';
        }
        return $acu;
    }

    public function borrarEmpleados($array) {
        foreach ($array as $usuario_id) {
            $datos = $this->modeloRegistro_usuarios->mostrarEmpleado($usuario_id);
            foreach ($datos as $dato) {
                unlink('../' . $dato['imagen']);
            }
            $this->modeloRegistro_usuarios->eliminarPersonal($usuario_id);
        }
    }

    public function datosDeEmpleado($usuario_id) {
        $empleados = $this->modeloRegistro_usuarios->mostrarEmpleado($usuario_id);
        foreach ($empleados as $empleado) {
            return $acu = '<div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <i class="fas fa-user" ></i>
                                            Nombre
                                        </label>
                                        <input  name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="' . $empleado['nombre'] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-envelope" ></i> 
                                            Correo Electronico</label>
                                        <input name="email" type="email" class="form-control" id="correo"value="' . $empleado['correo'] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-user" ></i>
                                            Usuario</label>
                                        <input type="text" name="usuario" class="form-control" id="usuario"  value="' . $empleado['usuario'] . '">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-school" ></i>
                                            Nivel de estudios</label>
                                        <input name="nivel_estudios" type="text" class="form-control" id="puesto" value="' . $empleado['nivel_estudios'] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-phone" ></i>    
                                            Numero De Telefono</label>
                                        <input name="tel" type="tel" class="form-control" id="telefono" value="' . $empleado['tel'] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <i class="fas fa-key" ></i>
                                            Password</label>
                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                    </div>
                                </div>
                             </div>
                        </div><div class="container">
                      <div class="row">
                     <div class="col-sm">
                     <div class="form-div">
                                    <label for="foto" class="input-label" class="fotito">
                                        <i class="fas fa-upload" ></i>
                                        <span id="label_span">Ingresar foto del usuario</span>
                                    </label>
                                    <input name="foto" multiple="true" type="file" accept="images/*" id="foto" >
                                </div>
                      </div>
                    <div class="col-sm">
                    <img class="img-fluid" src="../' . $empleado['imagen'] . '">
                    </div>
                            </div>
                                 </div>';
        }
    }

    public function datosDeEmpleadoArray($usuario_id) {
        $empleados = $this->modeloRegistro_usuarios->mostrarEmpleado($usuario_id);
        foreach ($empleados as $empleado) {
            return $empleado;
        }
    }

    public function modificarEmpleado($nombre, $nivel_estudios, $correo, $tel, $usuario, $contrasenia, $imagen, $usuario_id) {
        $this->modeloRegistro_usuarios->actualizarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $contrasenia, $imagen, $usuario_id);
    }

}
