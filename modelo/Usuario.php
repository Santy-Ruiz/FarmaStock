<?php
include_once 'Conexion.php';

class Usuario {
    var $objetos;
    public $acceso; 

    public function __construct() {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function Loguearse($documento_identidad, $pass) {
    
        $sql = "SELECT * FROM usuario 
                INNER JOIN tipo_usuario 
                ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario 
                WHERE usuario.documento_identidad = :documento_identidad 
                AND usuario.password = :password";
                
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':documento_identidad' => $documento_identidad, ':password' => $pass));
        $this->objetos = $query->fetchall();
        
        return $this->objetos;
    }

     function obtener_datos($id) {
    
        $sql = "SELECT * FROM usuario JOIN tipo_usuario ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario
                WHERE usuario.id_usuario = :id";
                
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        
        return $this->objetos;
    }

    function editar($id_usuario, $celular, $direccion, $correo, $adicional){
        $sql = "UPDATE usuario SET celular = :celular, direccion = :direccion, correo = :correo, adicional = :adicional
                WHERE id_usuario = :id_usuario";
                
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario, ':celular' => $celular, ':direccion' => $direccion, ':correo' => $correo, ':adicional' => $adicional));
    }

    function buscar($consulta) {
        if(!empty($consulta)){
            $sql = "SELECT * FROM usuario 
                    INNER JOIN tipo_usuario 
                    ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario 
                    WHERE usuario.nombre LIKE :consulta";
            
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } 
    
        else {
            $sql = "SELECT * FROM usuario 
                    INNER JOIN tipo_usuario 
                    ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario 
                    WHERE usuario.nombre NOT LIKE '' 
                    ORDER BY usuario.id_usuario LIMIT 25";
            
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function crear($nombre, $apellidos, $edad, $documento_identidad, $pass, $tipo, $avatar) {
        $sql = "SELECT id_usuario FROM usuario WHERE documento_identidad = :documento_identidad";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':documento_identidad' => $documento_identidad));
        $this->objetos = $query->fetchall();

        if(!empty($this->objetos)){
            echo 'noadd';
        } 
        else {
            $sql = "INSERT INTO usuario(nombre, apellidos, edad, documento_identidad, password, id_tipo_usuario, avatar) 
                    VALUES (:nombre, :apellidos, :edad, :documento_identidad, :pass, :tipo, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':edad' => $edad,
                ':documento_identidad' => $documento_identidad,
                ':pass' => $pass,
                ':tipo' => $tipo,
                ':avatar' => $avatar
            ));
            echo 'add';
        }
    }


}



?>