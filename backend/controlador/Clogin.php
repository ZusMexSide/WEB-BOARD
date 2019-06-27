<?php
class CLogin{
  private $modelo;
  public function __construct(){
    $this->modelo= new Mlogin();
  }
  public function validarUsuario($usuario, $pass){
      $password=$pass;
    $users=$this->modelo->consultarUsuario($usuario);
            foreach($users as $user){
            $hash= $user['contrasenia'];
        }
        
    return  password_verify($password,$hash);
  }
  
}
 ?>
