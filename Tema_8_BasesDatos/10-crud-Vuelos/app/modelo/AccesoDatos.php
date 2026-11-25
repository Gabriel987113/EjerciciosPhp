<?php
require_once "Vuelo.php";
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
            $dsn = "mysql:host=localhost;dbname=airflyDB;charset=utf8";
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

    /*
     Comprobar si existe algún vuelo para un destino.
     Obtener los vuelos de ese destino que tengan suficientes asientos.
     Devolver esos vuelos ordenados por precio.
    */

    // 1. Recibe el destino y comprueba si hay vuelos registrados con ese destino.
public function existeDestino($destino)
{
    // Guardamos la consulta y :destino representa el valor que falta.
    $consultaDestino = "SELECT COUNT(*) FROM Vuelos WHERE destino = :destino";

    $buscarDestino = $this->conexion->prepare($consultaDestino);

    // Ejecuta la consulta y coloca el valor de $destino en el hueco :destino.
    // Es decir, la consulta buscará los vuelos cuyo destino sea Japón.
    $buscarDestino->execute([
        ':destino' => $destino
    ]);

    // Recogemos el número de vuelos encontrados.
    /*
     fetch()        para recoger una fila completa.
     fetchColumn()  para recoger una columna de una fila (counts, nombres).
    */
    $total = $buscarDestino->fetchColumn();

    if ($total > 0) {
        return true;
    } else {
        return false;
    }
}

    // 2. Devuelve los vuelos que cumplen las condiciones, ordenados por precio.
    public function obtenerVuelos($destino, $plazas)
    {
        // Preparamos la consulta para buscar los vuelos.
        $consultaObtenerVuelos = "SELECT * FROM Vuelos
        WHERE destino = :destino
        AND asientos_libres >= :plazas
        ORDER BY precio_billete ASC";

        // Preparamos la consulta en la base de datos.
        $buscarVuelos = $this->conexion->prepare($consultaObtenerVuelos);

        // Sustituimos las varibales de la consulta que tienen los dos puntos
        // por los valores recibidos y ejecutamos la consulta.
        $buscarVuelos->execute([
            ':destino' => $destino,
            ':plazas' => $plazas
        ]);

       
        // fetchAll() recoge todas las filas que devuelve la consulta.
        // FETCH_ASSOC convierte cada fila en un array asociativo,
        // donde el nombre de cada columna es la clave y su dato es el valor.
        $resultados = $buscarVuelos->fetchAll(PDO::FETCH_ASSOC);

        // Creamos un array vacío para guardar los objetos Vuelo.
        $vuelos = [];

        // Recorremos todas las filas encontradas.
        foreach ($resultados as $fila) {

            // Creamos un objeto Vuelo con los datos de esa fila.
            $vuelo = new Vuelo(
                $fila["cod_vuelo"],
                $fila["destino"],
                $fila["aerolinea"],
                $fila["clase"],
                $fila["precio_billete"],
                $fila["asientos_libres"]
            );

            // Guardamos el objeto en el array.
            $vuelos[] = $vuelo;
        }

        // Devolvemos el array con todos los vuelos encontrados.
        return $vuelos;
    }
}
