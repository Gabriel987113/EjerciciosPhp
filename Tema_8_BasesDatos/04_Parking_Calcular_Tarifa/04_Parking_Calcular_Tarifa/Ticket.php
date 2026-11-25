<?php
class Ticket {
    private $matricula;
    private $tipo;
    private $horas;
    private $importe;

    public function __construct($matricula, $tipo, $horas, $importe) {
        $this->matricula = $matricula;
        $this->tipo = $tipo;
        $this->horas = $horas;
        $this->importe = $importe;
    }

    public function __get($atributo) { return $this->$atributo; }
    public function __set($atributo, $valor) { $this->$atributo = $valor; }
}
