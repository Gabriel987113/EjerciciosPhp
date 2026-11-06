<?php

class Reloj
{
    // ------------------------------------
    // ATRIBUTOS (todos privados)
    // ------------------------------------
    private $segundos;        // Hora actual, en segundos desde las 00:00:00 (de 0 a 86399)
    private $formato24;       // true = mostrar en 24 horas, false = en 12 horas
    private $alarma;          // Hora de la alarma, en segundos desde las 00:00:00
    private $alarmaActiva;    // true = alarma activada, false = desactivada

    // ------------------------------------
    // CONSTRUCTOR
    // ------------------------------------
    // Junta hora, minutos y segundos en un solo número.
    // El formato por defecto es 24 horas y la alarma empieza desactivada.
    public function __construct(int $hora, int $minutos, int $segundos)
    {
        $this->segundos = ($hora * 3600) + ($minutos * 60) + $segundos;
        $this->formato24 = true;
        $this->alarma = 0;
        $this->alarmaActiva = false;
    }

    // ------------------------------------
    // MOSTRAR LA HORA
    // ------------------------------------
    // 24 horas: 20:10:15   |   12 horas: 8:10:15 pm
    public function mostrar()
    {
        // De un solo número a horas, minutos y segundos
        $horas = intdiv($this->segundos, 3600);
        $minutos = intdiv($this->segundos % 3600, 60);
        $segs = $this->segundos % 60;

        if ($this->formato24) {
            return sprintf("%02d:%02d:%02d", $horas, $minutos, $segs);
        }

        // Formato 12 horas: am antes de las 12:00, pm desde las 12:00
        if ($horas < 12) {
            $sufijo = "am";
        } else {
            $sufijo = "pm";
        }

        // La hora 0 y la hora 12 se escriben como 12
        $horas12 = $horas % 12;
        if ($horas12 == 0) {
            $horas12 = 12;
        }

        return sprintf("%d:%02d:%02d %s", $horas12, $minutos, $segs, $sufijo);
    }

    // ------------------------------------
    // CAMBIAR FORMATO
    // ------------------------------------
    // true = 24 horas, false = 12 horas
    public function cambiarFormato24(bool $formato24)
    {
        $this->formato24 = $formato24;
    }

    // ------------------------------------
    // TICTAC
    // ------------------------------------
    // Avanza un segundo. El % 86400 hace que después de las 23:59:59 vuelva a 00:00:00.
    // Si la alarma está activada y llegamos a su hora, avisa por pantalla.
    public function tictac()
    {
        $this->segundos = ($this->segundos + 1) % 86400;

        if ($this->alarmaActiva && $this->segundos == $this->alarma) {
            echo "<br>¡RIIING! La alarma de las " . $this->mostrar() . " está sonando";
        }
    }

    // ------------------------------------
    // COMPARAR
    // ------------------------------------
    // Devuelve la diferencia en segundos entre este reloj y otro (siempre positiva)
    public function comparar(Reloj $otroreloj)
    {
        return abs($this->segundos - $otroreloj->segundos);
    }

    // ------------------------------------
    // MEJORA: ALARMA
    // ------------------------------------
    // Fija la hora de la alarma (hora y minutos)
    public function fijarAlarma(int $hora, int $minutos)
    {
        $this->alarma = ($hora * 3600) + ($minutos * 60);
    }

    // Activa (true) o desactiva (false) la alarma
    public function activarAlarma(bool $activa)
    {
        $this->alarmaActiva = $activa;
    }
}
