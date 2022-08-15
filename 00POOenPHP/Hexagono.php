<?php
class Hexagono extends Poligono {
    private $lado;
    private $apotema;
    

    public function __construct($l, $a){
        //lados esta en la clase poligono
        $this->lados = 6;
        $this->lado = $l;
        $this->apotema = $a;
    }

    //LE PONGO CUERPO A LAS FUNCIONES ABSTRACTAS QUE TRAJE DE POLIGNO
    public function perimetro(){
        //sumo los lados
        return $this->lado * $this->lados;
    }

    public function area(){
        //perimetro * apotema todo dividido 2
        //para llamar a su misma funcion uso el self::
        return (self::perimetro() * $this->apotema)/2;
    }

}