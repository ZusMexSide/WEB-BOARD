<?php
class Mlogin extends BD{
  public function consultarUsuario($usuario){
    try {
      $stmt=$this->conn->prepare("SELECT usuario,contrasenia from usuarios where usuario=:usuario");
      $stmt->bindParam(':usaurio',$usuario);
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: ". $e->getMessage();
    }
  }

}
 ?>
