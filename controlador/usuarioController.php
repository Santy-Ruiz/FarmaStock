<?php
include_once '../modelo/Usuario.php';
$usuario = new Usuario();
if($_POST['funcion'] == 'buscar_usuario'){
    $json = array();
    $usuario -> obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto->nombre,
            'apellidos' => $objeto->apellidos,
            'edad' => $objeto->edad,
            'documento_identidad' => $objeto->documento_identidad,
            'id_tipo_usuario' => $objeto->id_tipo_usuario,
            'celular' => $objeto->celular,
            'direccion' => $objeto->direccion,
            'correo' => $objeto->correo,
            'adicional' => $objeto->adicional
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion'] == 'capturar_datos'){
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario -> obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'celular' => $objeto->celular,
            'direccion' => $objeto->direccion,
            'correo' => $objeto->correo,
            'adicional' => $objeto->adicional
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion'] == 'editar_usuario'){
    $id_usuario = $_POST['id_usuario'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];   
    $correo = $_POST['correo'];
    $adicional = $_POST['adicional'];
    $usuario -> editar($id_usuario, $celular, $direccion, $correo, $adicional);
    echo 'editado';
}

?>