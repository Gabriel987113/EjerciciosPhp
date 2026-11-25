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
            $dsn = "mysql:host=localhost;dbname=cursos_exam;charset=utf8";
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

    public function buscarCurso($codigo) {
        $sql = "SELECT * FROM cursos WHERE cod_curso = :codigo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existeMatricula($alumno, $curso) {
        $sql = "SELECT COUNT(*) FROM matriculas
                WHERE cod_alumno = :alumno AND cod_curso = :curso";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':alumno' => $alumno, ':curso' => $curso]);
        return $stmt->fetchColumn() > 0;
    }

    public function matricular($alumno, $curso) {
        try {
            $this->conexion->beginTransaction();

            $sql = "UPDATE cursos SET plazas_ocupadas = plazas_ocupadas + 1
                    WHERE cod_curso = :curso AND plazas_ocupadas < plazas_max";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':curso' => $curso]);

            if ($stmt->rowCount() != 1) {
                $this->conexion->rollBack();
                return false;
            }

            $sql = "INSERT INTO matriculas (cod_alumno,cod_curso,fecha)
                    VALUES (:alumno,:curso,CURDATE())";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':alumno' => $alumno, ':curso' => $curso]);

            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            return false;
        }
    }
}
