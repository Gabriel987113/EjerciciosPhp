<?php
class AccesoDatos {
    private static $modelo = null;
    private $conexion = null;

    public static function initModelo() {
        if (self::$modelo == null) self::$modelo = new AccesoDatos();
        return self::$modelo;
    }

    private function __construct() {
        try {
            $dsn = "mysql:host=localhost;dbname=parking_exam;charset=utf8";
            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function guardarTicket($matricula, $tipo, $horas, $importe) {
        $sql = "INSERT INTO tickets (matricula,tipo,horas,importe,fecha)
                VALUES (:matricula,:tipo,:horas,:importe,NOW())";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':matricula' => $matricula,
            ':tipo' => $tipo,
            ':horas' => $horas,
            ':importe' => $importe
        ]);
    }
}
