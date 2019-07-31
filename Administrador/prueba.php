<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MProyectos.php';
include '../backend/controlador/CProyectos.php';
include '../backend/modelo/MUsuarios.php';
include '../backend/controlador/CUsuarios.php';
$controlador= new CProyecto();
$tarea=$controlador->imprimirDashboard();
print_r($tarea);