<?php
require_once "Socio.php";
require_once "Producto.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 * el profe llama dbh a conexion.
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
            $dsn = "mysql:host=localhost;dbname=comprasDB;charset=utf8";
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

    // 1. VALIDAMOS AL SOCIO
    public function validarSocio($cod_socio, $clave)
    {
        // Preparamos la consulta para buscar al socio.
        $consultaBuscarSocio = "SELECT * FROM socios
    WHERE cod_socio = :cod_socio AND clave = :clave";

        $buscarSocio = $this->conexion->prepare($consultaBuscarSocio);

        // Sustituimos los parámetros por los valores recibidos.
        $buscarSocio->execute([
            ':cod_socio' => $cod_socio,
            ':clave' => $clave
        ]);

        // Recuperamos una fila como array asociativo.
        $resultado = $buscarSocio->fetch(PDO::FETCH_ASSOC);

        // Comprobamos si existe el socio.
        if ($resultado == false) {
            return false;
        }

        // Creamos el objeto Socio.
        $socio = new Socio(
            $resultado["cod_socio"],
            $resultado["nombre"],
            $resultado["clave"],
            $resultado["cantidad_max"]
        );

        return $socio;
    }

    // 2. BUSCAMOS EL PRODUCTO
    public function buscarProducto($cod_pro)
    {
        
        $consultaBuscarProducto = "SELECT * FROM productos
    WHERE cod_pro = :cod_pro";

        $buscarProducto = $this->conexion->prepare($consultaBuscarProducto);

        
        $buscarProducto->execute([
            ':cod_pro' => $cod_pro
        ]);

        // Recuperamos una fila como array asociativo.
        $resultado = $buscarProducto->fetch(PDO::FETCH_ASSOC);

        // Comprobamos si existe el producto.
        if ($resultado == false) {
            return false;
        }

        // Creamos el objeto Producto.
        $producto = new Producto(
            $resultado["cod_pro"],
            $resultado["nombre_pro"],
            $resultado["precio"]
        );

        return $producto;
    }

    public function actualizarCantidadMax($cod_socio, $precio)
    {

        //hay que restar el precio del producto a la cantidad máxima disponible del socio.
        /*
      El socio tiene cantidad_max = 1500.
      Compra un producto que cuesta 250.
      Hay que restar: 1500 - 250 = 1250.
   */

        $consultaActualizarMax = "UPDATE socios
   SET cantidad_max = cantidad_max - :precio
   WHERE cod_socio = :cod_socio";

        $actualizarCantidadMax = $this->conexion->prepare($consultaActualizarMax);

        $actualizarCantidadMax->execute([
            ':cod_socio' => $cod_socio,
            ':precio' => $precio
        ]);

        if ($actualizarCantidadMax->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
