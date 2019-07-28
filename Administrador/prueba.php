<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
$controlador= new CProyecto();
$tarea=$controlador->mostrarTareas(29);
echo var_dump($tarea);
rmdir('../archivos/26/35');