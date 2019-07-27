<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MUsuarios.php';
$arhivos=new MUsuarios();
$analizar=$arhivos->consultarUsuariosDentroDeProyectomostrarArchivos(22);
echo print_r($analizar);
?>
