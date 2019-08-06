<?php

class MUsuarios extends BD {

    public function agregarUsuario($nombre, $nivel_estudios, $correo, $tel, $usuario, $password, $url) {

        try {
            $stmt = $this->conn->prepare("INSERT INTO usuarios(nombre,nivel_estudios,correo,tel,usuario,contrasenia,imagen)
                values(:nombre,:nivel_estudios,:correo,:tel,:usuario,:password,:imagen)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':nivel_estudios', $nivel_estudios);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':imagen', $url);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function mostrarPersonal() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    public function mostrarEmpleado($usuario_id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios where usuario_id=:id");
            $stmt->bindParam('id',$usuario_id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    public function consultarUsuariosDentroDeProyecto($proyecto_id){
        try {
            $stmt = $this->conn->prepare("select * from usuarios u inner join carpetas c on c.usuario_id=u.usuario_id where c.proyecto_id in(:id)");
            $stmt->bindParam('id',$proyecto_id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    public function eliminarPersonal($usuario_id){
        try {
            $stmt = $this->conn->prepare("DELETE from usuarios where usuario_id=:id");
            $stmt->bindParam(':id',$usuario_id);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    public function actualizarUsuario($nombre,$nivel_estudios,$correo,$tel,$usuario,$contrasenia,$imagen,$usuario_id){
        try {
            $stmt = $this->conn->prepare("UPDATE usuarios set nombre=:nombre, nivel_estudios=:nivel, correo=:correo, tel=:tel, usuario=:usuario, contrasenia=:pass, imagen=:img where usuario_id=:id");
            $stmt->bindParam(':id',$usuario_id);
            $stmt->bindParam(':nombre',$nombre);
            $stmt->bindParam(':nivel',$nivel_estudios);
            $stmt->bindParam(':correo',$correo);
            $stmt->bindParam(':tel',$tel);
            $stmt->bindParam(':usuario',$usuario);
            $stmt->bindParam(':pass',$contrasenia);
            $stmt->bindParam(':img',$imagen);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error: ".$ex->getMessage();
        } 
    }
}
