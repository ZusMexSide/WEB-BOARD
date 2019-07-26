<?php
include_once '../backend/modelo/BD.php';
include_once '../backend/modelo/MProyectos.php';
include_once '../backend/controlador/CProyectos.php';
$arhivos=new CProyecto();
$analizar=$arhivos->mostrarArchivos(13);
echo print_r($analizar);
echo pathinfo('../archivos/17/13/_DSC1383-Editar.jpg',PATHINFO_BASENAME);