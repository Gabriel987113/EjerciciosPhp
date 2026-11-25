<?php
class Curso {
    private $cod_curso;
    private $nombre_curso;
    private $plazas_max;
    private $plazas_ocupadas;

    public function __construct($cod_curso, $nombre_curso, $plazas_max, $plazas_ocupadas) {
        $this->cod_curso = $cod_curso;
        $this->nombre_curso = $nombre_curso;
        $this->plazas_max = $plazas_max;
        $this->plazas_ocupadas = $plazas_ocupadas;
    }

    public function __get($atributo) { return $this->$atributo; }
    public function __set($atributo, $valor) { $this->$atributo = $valor; }
}
