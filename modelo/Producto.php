<?php
include_once 'Conexion.php';

class Producto {
    var $objetos;
    public $acceso;

    public function __construct() {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    //Funcion para crear un nuevo producto, recibe los datos del controlador y los inserta en la base de datos
    function crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion) {
        
        $sql = "SELECT id_producto FROM producto 
                WHERE nombre = :nombre AND concentracion = :concentracion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(
            ':nombre' => $nombre,
            ':concentracion' => $concentracion
        ));
        $this->objetos = $query->fetchall();

        if(!empty($this->objetos)){
            echo 'noadd';
        } 
        else {
            $sql = "INSERT INTO producto(nombre, concentracion, adicional, precio, id_laboratorio, id_tipo_producto, id_presentacion) 
                    VALUES (:nombre, :concentracion, :adicional, :precio, :laboratorio, :tipo, :presentacion)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(
                ':nombre' => $nombre,
                ':concentracion' => $concentracion,
                ':adicional' => $adicional,
                ':precio' => $precio,
                ':laboratorio' => $laboratorio, 
                ':tipo' => $tipo,
                ':presentacion' => $presentacion
            ));
            
            echo 'add';
        }
    }

    // Función para buscar productos y sumar su stock (INNER JOIN + LEFT JOIN)
    function buscar($consulta) {
        if(!empty($consulta)){
            $sql = "SELECT producto.id_producto, producto.nombre AS nombre, concentracion, adicional, precio, 
                           laboratorio.nombre AS laboratorio, tipo_producto.nombre AS tipo, presentacion.nombre AS presentacion,
                           IFNULL(SUM(lote.stock), 0) AS total_stock 
                    FROM producto 
                    INNER JOIN laboratorio ON producto.id_laboratorio = laboratorio.id_laboratorio 
                    INNER JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto 
                    INNER JOIN presentacion ON producto.id_presentacion = presentacion.id_presentacion 
                    LEFT JOIN lote ON producto.id_producto = lote.id_producto
                    WHERE producto.nombre LIKE :consulta
                    GROUP BY producto.id_producto";
            
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } 
        else {
            $sql = "SELECT producto.id_producto, producto.nombre AS nombre, concentracion, adicional, precio, 
                           laboratorio.nombre AS laboratorio, tipo_producto.nombre AS tipo, presentacion.nombre AS presentacion,
                           IFNULL(SUM(lote.stock), 0) AS total_stock 
                    FROM producto 
                    INNER JOIN laboratorio ON producto.id_laboratorio = laboratorio.id_laboratorio 
                    INNER JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto 
                    INNER JOIN presentacion ON producto.id_presentacion = presentacion.id_presentacion 
                    LEFT JOIN lote ON producto.id_producto = lote.id_producto
                    WHERE producto.nombre NOT LIKE '' 
                    GROUP BY producto.id_producto
                    ORDER BY producto.nombre LIMIT 25";
            
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    //Funcion para editar un producto, recibe los datos del controlador y actualiza el producto en la base de datos
    function obtener_producto($id) {
        $sql = "SELECT * FROM producto WHERE id_producto = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    // Editar el producto
    function editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion) {
        // Validamos duplicados EXCLUYENDO el producto que estamos editando
        $sql = "SELECT id_producto FROM producto 
                WHERE nombre = :nombre AND concentracion = :concentracion AND id_producto != :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre, ':concentracion' => $concentracion, ':id' => $id));
        $this->objetos = $query->fetchall();

        if(!empty($this->objetos)){
            echo 'noedit';
        } else {
            $sql = "UPDATE producto 
                    SET nombre=:nombre, concentracion=:concentracion, adicional=:adicional, precio=:precio, 
                        id_laboratorio=:laboratorio, id_tipo_producto=:tipo, id_presentacion=:presentacion 
                    WHERE id_producto = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(
                ':nombre'=>$nombre, ':concentracion'=>$concentracion, ':adicional'=>$adicional, ':precio'=>$precio, 
                ':laboratorio'=>$laboratorio, ':tipo'=>$tipo, ':presentacion'=>$presentacion, ':id'=>$id
            ));
            echo 'edit';
        }
    }

        //Funcion para eliminar un producto, recibe el id del producto a eliminar y lo borra de la base de datos
      function borrar($id) {
        $sql = "DELETE FROM producto WHERE id_producto = :id";
        $query = $this->acceso->prepare($sql);
        
        
        try {
            $query->execute(array(':id' => $id));
            echo 'borrado';
        } catch (PDOException $e) {
            echo 'noborrado'; 
        }
    }

    
}
?>