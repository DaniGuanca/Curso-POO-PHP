<?php
//Clase de herencia y polimorfismo del curso. Hace todo en el mismo archivo por practicidad. En realidad van en
//diferente archivos como ya se.
class Telefono {
    public $marca;
    public $modelo;
    //Hago algunos protegidos, nadie puede acceder excepto las clases que heredan de esta
    protected $alambrico = true;
    protected $comunicacion;

    public function __construct($marca, $modelo){
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->comunicacion = ($this->alambrico) ? 'Alambrica' : 'Inalambrica';
    }

    //NO SE PUEDE RETORNAR ECHO, return echo no se puede, si quiero retornar un string algo print("texto")
    public function llamar() {
        return print('<p>Ring Ring</p>');
    }

    public function mas_info() {
        return print('<ul>
            <li>Marca <b>'.$this->marca.'</b></li>
            <li>Modelo <b>'.$this->modelo.'</b></li>
            <li>Comunicacion <b>'.$this->comunicacion.'</b></li>
        </ul>');
    }
}

//Para la herencia se usa extends
class Celular extends Telefono {
    protected $alambrico = false;

    public function __construct($marca,$modelo) {
        //para llamar a atributos o funciones del padre se usa parent::, en otros lenguajes es el super
        parent::__construct($marca,$modelo);
    }
}

//A esta la hago final, quiere decir que ya no puede ser heredada por otra clase
final class SmartPhone extends Celular {
    //No hace falta poner protected porque es final entonces nunca nadie va a heredarla
    public $alambrico = false; 
    public $internet = true;

    public function __construct($marca, $modelo) {
        parent::__construct($marca,$modelo);

    }

    //POLIMORFISMO
    public function mas_info() {
        return print('<ul>
            <li>Marca <b>'.$this->marca.'</b></li>
            <li>Modelo <b>'.$this->modelo.'</b></li>
            <li>Comunicacion <b>'.$this->comunicacion.'</b></li>
            <li>Dispositivo con acceso a internet</li>
        </ul>');
    }
}

echo '<h1>Evolucion del telefono</h1>';
echo '<h2>Telefono:</h2>';

$tel_casa = new Telefono("Panasonic","kk100");
$tel_casa->llamar();
$tel_casa->mas_info();

echo '<h2>Celular:</h2>';
$mi_cel = new Celular("Nokia","5230");
$mi_cel->llamar();
$mi_cel->mas_info();

echo '<h2>SmartPhone:</h2>';
$mi_sp = new SmartPhone("Motorola", "Z PLAY");
$mi_sp->llamar();
$mi_sp->mas_info();