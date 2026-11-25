<?php
class Paciente {
    private $cod_paciente;
    private $nombre;

    public function __construct($cod_paciente, $nombre) {
        $this->cod_paciente = $cod_paciente;
        $this->nombre = $nombre;
    }

    public function __get($atributo) { return $this->$atributo; }
    public function __set($atributo, $valor) { $this->$atributo = $valor; }
}
