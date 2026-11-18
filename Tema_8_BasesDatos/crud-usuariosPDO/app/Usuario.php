<?php


class Usuario
{
    private $nombre;
    private $login;
    private $password;
    private $comentario;
    private $bloqueo;
    private $saldo;

    public function __construct($nombre, $login, $password, $comentario, $bloqueo, $saldo) {

    $this->nombre = $nombre;
    $this->login = $login;
    $this->password = $password;
    $this->comentario = $comentario;
    $this->bloqueo = $bloqueo;
    $this->saldo = $saldo;

}
    
    // Getter con método mágico
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágico
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
    
}

