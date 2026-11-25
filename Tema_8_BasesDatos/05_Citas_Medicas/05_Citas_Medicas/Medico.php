<?php
class Medico
{
    private $cod_medico;
    private $nombre;

    public function __construct($cod_medico, $nombre)
    {
        $this->cod_medico = $cod_medico;
        $this->nombre = $nombre;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}
