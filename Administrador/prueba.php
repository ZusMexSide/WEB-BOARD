<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MProyectos.php';
include_once '../backend/controlador/CProyectos.php';
$proyectos=new CProyecto();
$analizar=$proyectos->mostrarCarpetas(15);
echo print_r($analizar);
