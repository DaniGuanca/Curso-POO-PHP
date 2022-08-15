<?php
class Cuadrado extends Poligono {
    private $lado;

    public function __construct($l){
        //lados esta en la clase poligono
        $this->lados = 4;
        $this->lado = $l;
    }

    //LE PONGO CUERPO A LAS FUNCIONES ABSTRACTAS QUE TRAJE DE POLIGNO
    public function perimetro(){
        //sumo los lados
        return $this->lado * $this->lados;
    }

    public function area(){
        //base por altura / 2
        //En php para calcular POTENCIAS se usa la funcion pow(numero,potencia)
        return pow($this->lado,2);
    }

}