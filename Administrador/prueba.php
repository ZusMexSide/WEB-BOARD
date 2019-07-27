<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
if (isset($_POST['editarProyecto'])){
    echo $_POST['fecha'].'<br>';
    echo $_POST['descripcion'].'<br>';
}
?>
