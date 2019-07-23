<?php

class MProyectos extends BD {

    public function consultarProyecto($id){
         try {
            $stmt = $this->conn->prepare("select * from proyectos where proyecto_id=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
           $proyectos= $stmt->fetchAll();
            foreach ($proyectos as $proyecto){
                $devolver=$proyecto;
            }
            return $devolver;
        } catch (PDOException $ex) {
          echo "Error: ".$ex->getMessage();  
        }
    }
    public function consultarProyectoDondeEsLider($id){
        try {
            $stmt = $this->conn->prepare("select * from proyectos where lider=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
           return $proyectos= $stmt->fetchAll();
            
        } catch (PDOException $ex) {
          echo "Error: ".$ex->getMessage();  
        }
    }
    public function numeroColaboradores($id){
        try {
            $stmt = $this->conn->prepare("select count(proyecto_id) from proyectos_usuarios where proyecto_id=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
           $totales= $stmt->fetchAll();
            foreach ($totales as $total){
                $numero=$total;
            }
            return $numero[0];
        } catch (PDOException $ex) {
          echo "Error: ".$ex->getMessage();  
        }
    }
    public function mostrarLiderProyecto($id){
        try {
            $stmt = $this->conn->prepare("select u.nombre from proyectos p inner join usuarios u on u.usuario_id = p.lider where u.usuario_id=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
           $nombres= $stmt->fetchAll();
            foreach ($nombres as $name){
                $nombre=$name;
            }
            return $nombre['nombre'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function mostrarNombreUsuario($id){
         try {
            $stmt = $this->conn->prepare("select nombre from usuarios where usuario_id=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
           $nombres= $stmt->fetchAll();
            foreach ($nombres as $name){
                $nombre=$name;
            }
            return $nombre['nombre'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function mostrarProyectosAdmin(){
         try {
            $stmt = $this->conn->prepare("SELECT * FROM proyectos");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function mostrarProyectosEmpleado($id){
         try {
            $stmt = $this->conn->prepare("select * from proyectos p inner join proyectos_usuarios u on u.proyecto_id=p.proyecto_id where usuario_id=:usuario_id");
            $stmt->bindParam(':usuario_id',$id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function nuevoProyecto($nombre, $descripcion, $fecha, $lider) {
        try {
            $stmt = $this->conn->prepare("INSERT into proyectos(nombre,descripcion,fecha,fecha_exp,lider) values(:nombre,:descripcion,now(),:fecha,:lider)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':lider', $lider);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function asignarProyecto($id_proyecto, $id_usuario) {
        try {
            $stmt = $this->conn->prepare("INSERT into proyectos_usuarios(usuario_id,proyecto_id) values(:id_usuario,:id_proyecto)");
            $stmt->bindParam(':id_proyecto', $id_proyecto);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
public function consultarUltimoProyecto(){
    try {
         $stmt = $this->conn->prepare("SELECT proyecto_id from proyectos order by proyecto_id desc limit 1");
         $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();  
    }
}
// CARPETAS

public function carpetas($id){
    try {
         $stmt = $this->conn->prepare("SELECT * from carpetas where proyecto_id=:id");
         $stmt->bindParam(':id', $id);
         $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();  
    }
}
public function consultarStatus($id){
    try {
         $stmt = $this->conn->prepare("SELECT * from carpetas where carpeta_id=:id");
         $stmt->bindParam(':id', $id);
         $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();  
    }
}
// TAREAS
public function insertarTarea($carpeta,$descripcion){
    $stmt=$this->conn->prepare("insert into tareas(carpeta_id,descripcion) values(:carpeta,:descripcion)");
    $stmt->bindParam(':carpeta',$carpeta);
    $stmt->bindParam(':descripcion',$descripcion);
    $stmt->execute();
}
public function consultarTarea($id){
    $stmt=$this->conn->prepare("select * from tareas where carpeta_id=:id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetchAll(); 
}
}
