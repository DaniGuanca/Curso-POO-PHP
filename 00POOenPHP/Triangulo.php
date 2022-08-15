<?php
class Triangulo extends Poligono {
    private $lado_a;
    private $lado_b;
    private $lado_c;
    private $altura;

    public function __construct($a, $b, $c, $h){
        //lados esta en la clase poligono
        $this->lados = 3;
        $this->lado_a = $a;
        $this->lado_b = $b;
        $this->lado_c = $c;
        $this->altura = $h;
    }

    //LE PONGO CUERPO A LAS FUNCIONES ABSTRACTAS QUE TRAJE DE POLIGNO
    public function perimetro(){
        //sumo los lados
        return $this->lado_a+$this->lado_b+$this->lado_c;
    }

    public function area(){
        //base por altura / 2
        return ($this->lado_b * $this->altura)/2;
    }

}