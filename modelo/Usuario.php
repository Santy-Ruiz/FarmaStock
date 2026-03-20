<?php
include_once 'Conexion.php';

class Usuario {
    var $objetos;
    public $acceso; // Es buena práctica declarar esta variable

    public function __construct() {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function Loguearse($documento_identidad, $pass) {
        // Aquí está la magia: especificamos usuario.id_tipo_usuario y tipo_usuario.id_tipo_usuario
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
}
?>