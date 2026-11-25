<?php
class Socio {
    private $cod_socio;
    private $nombre;

    public function __construct($cod_socio, $nombre) {
        $this->cod_socio = $cod_socio;
        $this->nombre = $nombre;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}
