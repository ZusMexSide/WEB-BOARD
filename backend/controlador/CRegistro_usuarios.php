<?php
class CRegistro_usuarios{
    private $modeloRegistro_usuarios;
    public function __construct(){
       $this->modeloRegistro_usuarios= new MRegistro_Usuarios();
}
    public function insertarUsuario($nombre,$nivel_estudios,$correo,$tel,$usuario,$password){
        $this->modeloRegistro_usuarios->agregarUsuario($nombre,$nivel_estudios,$correo,$tel,$usuario,$password);
        
    }
}

