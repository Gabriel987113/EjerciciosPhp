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
            $dsn = "mysql:host=localhost;dbname=citas_exam;charset=utf8";
            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function buscarPaciente($codigo) {
        $sql = "SELECT * FROM pacientes WHERE cod_paciente = :codigo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarMedico($codigo) {
        $sql = "SELECT * FROM medicos WHERE cod_medico = :codigo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existeCita($medico, $fecha, $hora) {
        $sql = "SELECT COUNT(*) FROM citas
                WHERE cod_medico = :medico AND fecha = :fecha AND hora = :hora";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':medico' => $medico,
            ':fecha' => $fecha,
            ':hora' => $hora
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function insertarCita($paciente, $medico, $fecha, $hora) {
        $sql = "INSERT INTO citas (cod_paciente,cod_medico,fecha,hora)
                VALUES (:paciente,:medico,:fecha,:hora)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':paciente' => $paciente,
            ':medico' => $medico,
            ':fecha' => $fecha,
            ':hora' => $hora
        ]);
    }
}
