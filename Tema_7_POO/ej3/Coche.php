<?php

class Coche
{

    private $modelo;
    private $distanciaTotal;
    private $distanciaParcial;
    private $motor;
    private $velocidad;
    private $velocidadMax;

    //los paréntesis contienen los datos que necesitamos recibir desde fuera al crear el objeto.
    public function __construct(string $modelo, int $velocidadMax)  {
        $this->modelo = $modelo;
        $this->velocidadMax = $velocidadMax;

        $this->distanciaTotal = 0;
        $this->distanciaParcial = 0;
        $this->motor = false;
        $this->velocidad = 0;
    }

    public function arrancar(){
        if ($this->motor == false) {
            $this->motor = true;
            return true;
        } else {
            $this->infoError("ya esta arrancado");
            return false;
        }
    }

    public function parar() {
        if ($this->motor == true) {
            $this->motor = false;
            $this->distanciaParcial = 0;
            $this->velocidad = 0;
            return true;
        }else{
            $this->infoError("Ya esta parado");
            return false;
        }
    }

    public function acelera(int $cantidad){

        if ($this->motor == true) {
            if($this->velocidad + $cantidad <= $this->velocidadMax){
              $this->velocidad = $this->velocidad + $cantidad;
               return true;
            }else{
              $this->infoError("No puedes superar la max velocidad");
              return false;
            }
            
        }else{
           $this->infoError("Debe estar arrancado el motor para acelerar");
           return false;
        }
    }

    public function frena(int $cantidad){
        if ($this->motor == true && $this->velocidad > 0 && ($this->velocidad - $cantidad) >= 0) {
            $this->velocidad = $this->velocidad - $cantidad;
            return true;
        } else {
            $this->infoError("El motor debe estar arrancado o la velocidad debe ser mayor a 0");
            return false;
        }
    }

    public function recorre()
    {
        if ($this->motor == true) {
            $this->distanciaParcial = $this->distanciaParcial + $this->velocidad;
            $this->distanciaTotal = $this->distanciaTotal + $this->velocidad;
            return true;
        }else{
            $this->infoError("El motor debe estar arrancado");
            return false;
        }
    }

    public function info()
    {
        $estado="";
        if($this->motor==true){
            $estado="arrancado";
        }else{
           $estado="parado"; 
        }
        return "Modelo: " . $this->modelo .
            " velocidad actual: " . $this->velocidad .
            " estado: " . $estado .
            " distancia parcial: " . $this->distanciaParcial .
            " distancia total: " . $this->distanciaTotal;
    }

    public function getKilometros() {
        return $this->distanciaParcial;
    }

    private function infoError(string $mensaje): void
    {
        echo $mensaje;
    }
}
