<?php
require_once "Producto.php";

/*
 * Acceso a datos con BD y Patrón Singleton
 * el profe llama dbh a conexion.
 * 
 * http://localhost/phpmyadmin/
 * http://localhost/Ejercicios%20PHP/
 */
class AccesoDatos
{

    private static $modelo = null;
    private $conexion = null;
    private $stmt = null; //será el objeto que utilizaremos para guardar las consultas preparadas de PDO.

    public static function initModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }


    private function __construct()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=almacendb;charset=utf8";
            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
    }

    // Evito que se pueda clonar el objeto.
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }

    public function getProductos10Stock(){

    $consultaSeleccionarProductos = "SELECT * FROM Productos 
    WHERE stock_disponible >10 ";

    $buscarProductos = $this->conexion->prepare($consultaSeleccionarProductos);

    $buscarProductos->execute();

    $resultado = $buscarProductos->fetchAll(PDO::FETCH_ASSOC);

    $tproductos = [];

     foreach ($resultado as $fila) {

        $producto = new Producto(
            $fila['producto_no'],
            $fila['descripcion'],
            $fila['precio_actual'],
            $fila['stock_disponible']
        );

        $tproductos[] = $producto;
    }

    return $tproductos;
}

    //El parámetro $producto_no representa el código del producto que hemos seleccionado en el checkbox.
    public function actualizarProductos($producto_no)
    {

        $consultaBajarPrecio = "UPDATE Productos 
    SET precio_actual = precio_actual - (precio_actual * 0.10)
    WHERE producto_no = :producto_no";

        $actualizarPrecios = $this->conexion->prepare($consultaBajarPrecio);

        $actualizarPrecios->execute([
            ':producto_no' => $producto_no
        ]);



        if ($actualizarPrecios->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
}


