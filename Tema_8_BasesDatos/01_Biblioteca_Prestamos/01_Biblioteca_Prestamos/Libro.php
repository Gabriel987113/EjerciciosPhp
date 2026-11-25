<?php
class Libro {
    private $cod_libro;
    private $titulo;
    private $ejemplares;

    public function __construct($cod_libro, $titulo, $ejemplares) {
        $this->cod_libro = $cod_libro;
        $this->titulo = $titulo;
        $this->ejemplares = $ejemplares;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}
