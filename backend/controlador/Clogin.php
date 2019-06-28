<?php

class CLogin {

    private $modelo;

    public function __construct() {
        $this->modelo = new Mlogin();
    }

    public function validarUsuario($usuario) {
        $users = $this->modelo->consultarUsuario($usuario);
        if (empty($users)){
            return false;
        }else{
        foreach ($users as $user) {
            return $user;
        }
        }
    }

}

?>
