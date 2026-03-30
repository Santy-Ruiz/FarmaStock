<?php
include_once '../modelo/Usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new Usuario();


if(!empty($_SESSION['id_tipo_usuario'])){
    
    switch($_SESSION['id_tipo_usuario']){
        case 1:
            header('location: ../vista/admin_catalogo.php');
        break;
        case 2:
            header('location: ../vista/tecnico_catalogo.php');
        break;
    }
}
else{
    $usuario -> Loguearse($user, $pass);
    if(!empty($usuario -> objetos)){
        foreach ($usuario -> objetos as $objeto){
            $_SESSION['usuario'] = $objeto -> id_usuario;
            $_SESSION['id_tipo_usuario'] = $objeto -> id_tipo_usuario;
            $_SESSION['nombre'] = $objeto -> nombre;
        }
        switch($_SESSION['id_tipo_usuario']){
            case 1:
                header('location: ../vista/admin_catalogo.php');
            break;
            case 2:
                header('location: ../vista/tecnico_catalogo.php');
            break;
        }
    }
    else{
        header('Location: ../index.php?error=1');
    }
}


?>