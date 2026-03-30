<?php
include_once '../modelo/Producto.php';

$producto = new Producto();

if($_POST['funcion'] == 'crear_producto'){
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $adicional = $_POST['adicional'];
    $precio = $_POST['precio'];
    // Estos son los IDs provenientes de los selects FK
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $presentacion = $_POST['presentacion'];

    // Llamamos a la función crear en el modelo
    $producto->crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion);
}

if($_POST['funcion'] == 'buscar_producto'){
    $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : '';
    $producto->buscar($consulta);
    
    $json = array();
    foreach ($producto->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_producto,
            'nombre' => $objeto->nombre,
            'concentracion' => $objeto->concentracion,
            'adicional' => $objeto->adicional,
            'precio' => $objeto->precio,
            'laboratorio' => $objeto->laboratorio,
            'tipo' => $objeto->tipo,
            'presentacion' => $objeto->presentacion,
            'stock' => $objeto->total_stock
        );
    }
    echo json_encode($json);
}

if($_POST['funcion'] == 'obtener_producto'){
    $id = $_POST['id'];
    $producto->obtener_producto($id);
    
    $json = array();
    foreach ($producto->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_producto,
            'nombre' => $objeto->nombre,
            'concentracion' => $objeto->concentracion,
            'adicional' => $objeto->adicional,
            'precio' => $objeto->precio,
            'laboratorio' => $objeto->id_laboratorio, 
            'tipo' => $objeto->id_tipo_producto,
            'presentacion' => $objeto->id_presentacion
        );
    }

    echo json_encode($json[0]); 
}

if($_POST['funcion'] == 'editar_producto'){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $adicional = $_POST['adicional'];
    $precio = $_POST['precio'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $presentacion = $_POST['presentacion'];

    $producto->editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion);
}

if($_POST['funcion'] == 'borrar_producto'){
    $id = $_POST['id'];
    $producto->borrar($id);
}


?>