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
            $dsn = "mysql:host=localhost;dbname=notas_exam;charset=utf8";
            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function buscarAlumno($codigo) {
        $sql = "SELECT * FROM alumnos WHERE cod_alumno = :codigo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertarNota($codigo, $asignatura, $nota) {
        $sql = "INSERT INTO notas (cod_alumno,asignatura,nota)
                VALUES (:codigo,:asignatura,:nota)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':codigo' => $codigo,
            ':asignatura' => $asignatura,
            ':nota' => $nota
        ]);
    }

    public function calcularMedia($codigo) {
        $sql = "SELECT AVG(nota) FROM notas WHERE cod_alumno = :codigo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetchColumn();
    }
}
