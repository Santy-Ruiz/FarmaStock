<?php
include_once __DIR__ . '/Conexion.php';

class Lote {
    var $objetos;
    public $acceso;

    public function __construct() {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_producto, $proveedor, $stock, $vencimiento) {
        $sql = "INSERT INTO lote(stock, fecha_vencimiento, id_producto, id_proveedor) 
                VALUES (:stock, :vencimiento, :id_producto, :id_proveedor)";
        $query = $this->acceso->prepare($sql);
        try {
            $query->execute(array(
                ':stock' => $stock,
                ':vencimiento' => $vencimiento,
                ':id_producto' => $id_producto,
                ':id_proveedor' => $proveedor
            ));
            echo 'add';
        } catch (PDOException $e) {
            echo "Error SQL: " . $e->getMessage(); 
        }
    }
}
?>