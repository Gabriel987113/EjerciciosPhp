<?php
require_once "Pedido.php";
require_once "Cliente.php";
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
            $dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
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

    public function validarCliente($usuario, $clave)
    {

        $consultaValidar = "SELECT * FROM clientes WHERE nombre= :usuario AND clave= :clave";

        $buscarUsuario = $this->conexion->prepare($consultaValidar);

        $buscarUsuario->execute([
            ':usuario' => $usuario,
            ':clave' => $clave
        ]);

        $resultado = $buscarUsuario->fetch(PDO::FETCH_ASSOC);

        //devuelve Un array asociativo si encuentra un registro.false si no encuentra ninguno.
        if ($resultado == true) {
            $cliente = new Cliente(
                $resultado['cod_cliente'],
                $resultado['nombre'],
                $resultado['clave'],
                $resultado['veces']
            );
            //devuelvbe el objeto cliente, que sera el cliente con ese usaurio y contraseña.
            return $cliente;
        }

        // Si no encuentra al cliente, devuelve false.
        return false;
    }


    public function actualizarVecesEntradas($cod_cliente)
    {
        $consultaActualizarVeces = "UPDATE clientes 
        SET veces = veces + 1 
        WHERE cod_cliente = :cod_cliente";

        $ejecutarVeces = $this->conexion->prepare($consultaActualizarVeces);

        $ejecutarVeces->execute([
            ':cod_cliente' => $cod_cliente
        ]);

        if($ejecutarVeces->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getPedidos($cod_cliente) {

    $consultaObtenerPedidos = "SELECT *
    FROM pedidos 
    WHERE cod_cliente = :cod_cliente";

    $mostrarPedidos=$this->conexion->prepare($consultaObtenerPedidos);

    $mostrarPedidos->execute([
            ':cod_cliente' => $cod_cliente
        ]);

    $resultado = $mostrarPedidos->fetchAll(PDO::FETCH_ASSOC);

        //CREAMOS EL ARRAY PORQUE UN CLIENTYE PUEDE TENER MUCHOS PEDIDOS
        //Si Eva tiene 3 pedidos, fetchAll() devuelve un array con 3 filas.
        /*
         Primera vuelta → crea el objeto del pedido 1.  
         Segunda vuelta → crea el objeto del pedido 2. 
         Tercera vuelta → crea el objeto del pedido 3.
        */
         $pedidos = [];
        foreach ($resultado as $fila) {
            $pedido = new Pedido(
                $fila['numped'],
                $fila['cod_cliente'],
                $fila['producto'],
                $fila['precio']
            );

            $pedidos[] = $pedido;
        }

        return $pedidos;
    }
}

// fetch()
// Recupera UNA sola fila del resultado de la consulta.
// Devuelve false si no quedan filas.
// Se utiliza cuando buscamos un único registro o recorremos resultados uno a uno.


// fetchAll()
// Recupera TODAS las filas restantes del resultado de la consulta.
// Devuelve un array con todas las filas.
// Se utiliza cuando necesitamos varios registros, por ejemplo, todos los pedidos.

// PDO::FETCH_ASSOC
// Cada fila se devuelve como array asociativo.
// Accedemos mediante el nombre de la columna: $resultado['nombre'].


// PDO::FETCH_NUM
// Cada fila se devuelve como array numérico.
// Accedemos mediante posiciones: $resultado[0], $resultado[1].


// PDO::FETCH_BOTH
// Cada fila se devuelve como array asociativo y numérico.
// Podemos acceder por nombre o por posición.
// Es el modo predeterminado de PDO.


// PDO::FETCH_OBJ
// Cada fila se devuelve como objeto stdClass.
// Accedemos mediante propiedades: $resultado->nombre.


// PDO::FETCH_CLASS
// Convierte cada fila en un objeto de una clase determinada.
// Útil para crear objetos directamente desde los resultados de la BD.


// PDO::FETCH_COLUMN
// Recupera solamente una columna.
// Útil cuando solo necesitamos un dato, por ejemplo, los precios.


// PDO::FETCH_KEY_PAIR
// Devuelve un array asociativo usando la primera columna como clave
// y la segunda como valor.
// Útil para relacionar dos columnas.


// PDO::FETCH_GROUP
// Agrupa los resultados utilizando la primera columna como clave.
// Útil para organizar registros por categorías.

// Un cliente: una fila en formato asociativo.
//$resultado = $consulta->fetch(PDO::FETCH_ASSOC);


// Todos los pedidos: todas las filas en formato asociativo.
//$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
