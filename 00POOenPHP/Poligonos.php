<?php
//Esta va a ser mi clase abstracta con metodos no definidos, para que se sean definidos en cada forma como cuadrado
//rectangulo, triangulo, etc
abstract class Poligono {
    //Protected solo para que entren los que hereden
    protected $lados;

    //funcion abstracta, no llevan cuerpo las funciones abstractas, el cuerpo van en donde voy a usarla
    abstract protected function perimetro();
    abstract protected function area();

    //Tambien puedo poner funciones comunes, no necesariamente todas tienen que ser abstracta
    public function lados(){
        //Mando a imprimir el nombre de la clase con la funcion get_called_class()
        return 'Un <mark>'.get_called_class(). '</mark> tiene <mark>'. $this->lados. '</mark> lados';
    }

}