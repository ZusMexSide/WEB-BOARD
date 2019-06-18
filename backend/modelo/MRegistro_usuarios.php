<?php
class MRegistro_Usuarios extends BD{
    
    public function agregarUsuario($nombre,$nivel_estudios,$correo,$tel,$usuario,$password){
        
       try {
            $stmt = $this->conn->prepare("INSERT INTO usuarios(nombre,nivel_estudios,correo,tel,usuario,contrasenia) 
                values(:nombre,:nivel_estudios,:correo,:tel,:usuario,:password)");
           
           $stmt->bindParam(':nombre',$nombre);
           $stmt->bindParam(':nivel_estudios',$nivel_estudios);
           $stmt->bindParam(':correo',$correo);
           $stmt->bindParam(':tel',$tel);
           $stmt->bindParam(':usuario', $usuario);
           $stmt->bindParam(':password', $password);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
        
    }
   
}

