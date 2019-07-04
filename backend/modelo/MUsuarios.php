<?php
class MUsuarios extends BD{

    public function agregarUsuario($nombre,$nivel_estudios,$correo,$tel,$usuario,$password,$url){

       try {
            $stmt = $this->conn->prepare("INSERT INTO usuarios(nombre,nivel_estudios,correo,tel,usuario,contrasenia,imagen)
                values(:nombre,:nivel_estudios,:correo,:tel,:usuario,:password,:imagen)");

           $stmt->bindParam(':nombre',$nombre);
           $stmt->bindParam(':nivel_estudios',$nivel_estudios);
           $stmt->bindParam(':correo',$correo);
           $stmt->bindParam(':tel',$tel);
           $stmt->bindParam(':usuario', $usuario);
           $stmt->bindParam(':password', $password);
           $stmt->bindParam(':imagen',$url);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
        public function mostrarPersonal(){
            try {
                $stmt = $this->conn->prepare("SELECT * FROM usuarios");
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (PDOException $ex) {
                echo "Error: " . $ex->getMessage();
            }
    }

    }


