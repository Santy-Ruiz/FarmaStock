<?php
include_once 'Conexion.php';

class Presentacion {
    var $objetos;
    public $acceso;

    public function __construct() {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function buscar() {
        $sql = "SELECT * FROM presentacion ORDER BY nombre ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
?>