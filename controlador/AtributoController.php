<?php
// Incluimos los tres modelos
include_once '../modelo/Laboratorio.php';
include_once '../modelo/TipoProducto.php';
include_once '../modelo/Presentacion.php';

$laboratorio = new Laboratorio();
$tipo_producto = new TipoProducto();
$presentacion = new Presentacion();

if($_POST['funcion'] == 'cargar_laboratorios'){
    $json = array();
    $laboratorio->buscar();
    foreach ($laboratorio->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_laboratorio, 
            'nombre' => $objeto->nombre
        );
    }
    echo json_encode($json);
}


if($_POST['funcion'] == 'cargar_tipos'){
    $json = array();
    $tipo_producto->buscar();
    foreach ($tipo_producto->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_tipo_producto, 
            'nombre' => $objeto->nombre
        );
    }
    echo json_encode($json);
}


if($_POST['funcion'] == 'cargar_presentaciones'){
    $json = array();
    $presentacion->buscar();
    foreach ($presentacion->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_presentacion,
            'nombre' => $objeto->nombre
        );
    }
    echo json_encode($json);
}
?>