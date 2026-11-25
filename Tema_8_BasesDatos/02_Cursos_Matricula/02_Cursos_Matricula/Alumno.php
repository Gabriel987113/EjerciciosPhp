<?php
class Alumno {
    private $cod_alumno;
    private $nombre;

    public function __construct($cod_alumno, $nombre) {
        $this->cod_alumno = $cod_alumno;
        $this->nombre = $nombre;
    }

    public function __get($atributo) { return $this->$atributo; }
    public function __set($atributo, $valor) { $this->$atributo = $valor; }
}
