<?php
class Rectangulo extends Poligono {
    private $base;
    private $altura;

    public function __construct($b, $h){
        //lados esta en la clase poligono
        $this->lados = 4;
        $this->base = $b;
        $this->altura = $h;
    }

    //LE PONGO CUERPO A LAS FUNCIONES ABSTRACTAS QUE TRAJE DE POLIGNO
    public function perimetro(){
        //sumo los lados
        return ($this->base+$this->altura) * 2;
    }

    public function area(){
        //base por altura / 2
        return $this->base * $this->altura;
    }

}