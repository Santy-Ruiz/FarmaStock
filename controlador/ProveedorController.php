<?php
include_once '../modelo/Proveedor.php';
$proveedor = new Proveedor();

if($_POST['funcion'] == 'llenar_proveedores'){
    $proveedor->buscar();
    $json = array();
    foreach ($proveedor->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_proveedor,
            'nombre' => $objeto->nombre
        );
    }
    echo json_encode($json);
}
?>