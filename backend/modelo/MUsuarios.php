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

}
