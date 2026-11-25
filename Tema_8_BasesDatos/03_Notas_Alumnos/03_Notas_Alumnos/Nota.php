<?php
class Nota {
    private $cod_alumno;
    private $asignatura;
    private $nota;

    public function __construct($cod_alumno, $asignatura, $nota) {
        $this->cod_alumno = $cod_alumno;
        $this->asignatura = $asignatura;
        $this->nota = $nota;
    }

    public function __get($atributo) { return $this->$atributo; }
    public function __set($atributo, $valor) { $this->$atributo = $valor; }
}
