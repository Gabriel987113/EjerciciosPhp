<?php
class AccesoDatos {
    private static $modelo = null;
    private $conexion = null;

    public static function initModelo() {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    private function __construct() {
        try {
            $dsn = "mysql:host=localhost;dbname=biblioteca_exam;charset=utf8";
            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function buscarSocio($cod_socio) {
        $sql = "SELECT * FROM socios WHERE cod_socio = :cod_socio";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':cod_socio' => $cod_socio]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarLibro($cod_libro) {
        $sql = "SELECT * FROM libros WHERE cod_libro = :cod_libro";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':cod_libro' => $cod_libro]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function prestarLibro($cod_socio, $cod_libro) {
        try {
            // Empezamos una transacción.
            $this->conexion->beginTransaction();

            $sql = "UPDATE libros SET ejemplares = ejemplares - 1
                    WHERE cod_libro = :cod_libro AND ejemplares > 0";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':cod_libro' => $cod_libro]);

            if ($stmt->rowCount() != 1) {
                $this->conexion->rollBack();
                return false;
            }

            $sql = "INSERT INTO prestamos (cod_socio, cod_libro, fecha)
                    VALUES (:cod_socio, :cod_libro, CURDATE())";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':cod_socio' => $cod_socio,
                ':cod_libro' => $cod_libro
            ]);

            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            return false;
        }
    }
}
