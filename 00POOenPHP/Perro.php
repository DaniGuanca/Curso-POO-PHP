<?php
class Perro 
{
    /*
		public: Acceso desde cualquier método de la clase u objeto que lo invoque
		private: Acceso sólo desde los métodos de la clase, los objetos no los pueden invocar
		protected: Acceso sólo desde los métodos de la clase y subclases que la hereden, los objetos no los pueden invocar
		static: Pueden ser accedidos sin necesidad de instanciar un objeto y su valor es estático (no cambia)
	*/
    //ATRIBUTOS
    public $nombre;
    public $raza;
    public $edad;
    public $sexo;
    public $adiestrado;
    public $foto;
    public $comida;
    //un atributo privado
    private $pulgas;
    //hago atributos estaticos, los estaticos no se declaran y tienen que tener ya un valor
    public static $mejor_amigo = "Hombre";
    //Para constante es lo mismo que con estaticos
    const MEJOR_CUALIDAD = "Fidelidad";

    //CONSTRUCTOR Y DESTRUCTOR
    public function __construct($nom, $ra, $ed, $sex, $ad, $fo, $p){
        $this->nombre = $nom;
        $this->raza = $ra;
        //Concateno la palabra años
        $this->edad = $ed.' años';
        //Si es true es macho sino es hembra
        $this->sexo = $sex ? 'Macho': 'Hembra';
        $this->adiestrado = $ad ? 'Adiestrado' : 'Perro mierda';
        $this->foto = $fo;
        $this->pulgas = $p;
    }

    //SE EJECUTA SOLO COMO EL GARBAGE COLLECTOR
    public function __destruct(){
        echo '<p><mark>Adios soy el Destructor de la Clase</mark></p>';
    }

    //METODOS
    public function ladrar(){
        echo '<p><mark>GUAU GUAU</mark></p>';
    }

    public function comer($c){
        $this->comida = $c;
        echo '<p>'.$this->nombre.' come '.$this->comida.'</p>';    
    }

    public function aparecer(){
        echo "<img src='$this->foto'>";
    }

    //Un metodo para acceder al atributo privado pulgas, para acceder a variables privadas entro con metodos como geter y seters
    public function tiene_pulgas(){
        echo ($this->pulgas) ? '<p>Tiene pulgas</p>' : '<p>No tiene pulgas</p>';
    }

    public function mas_info(){
        //Tambien puede referirse a si mismo asi, es lo mismo que usar this->
        // $this->ladrar();
        self::ladrar();
        Perro::comer("Croqueta");
        //Pero solo con metodos, cuando intento entrar a variable no estatica tira error de que no es estatica
        //echo self::$nombre;
        //Ahora si llamo al atributo estatico, puede usarse self o Clase, Perro
        echo '<p>El mejor amigo del <mark>' . self::$mejor_amigo . '</mark> es el Perro</p>';
        echo '<p>La mejor cualidad del Perro es la <mark>' . Perro::MEJOR_CUALIDAD . '</mark></p>';

    }
}


//Instanciar un objeto de la clase
$milo = new Perro('Milo', 'SharPei', 5, true, false, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVglnFWh6ebWK4MpU1eLq-JXch0drTW_22jw&usqp=CAU', false);

//var_dump(objeto) permite analizar la estructura de un objeto, muestra por pantalla
//var_dump($milo);

echo '<h1>'.$milo->nombre.'</h1>';
echo '<h2>'.$milo->raza.'</h2>';
echo '<h3>'.$milo->edad.'</h3>';
echo '<h4>'.$milo->sexo.'</h4>';
echo '<h5>'.$milo->adiestrado.'</h5>';
echo '<h6>'.$milo->foto.'</h6>';
//TIRA ERROR QUE NO SE PUEDE ACCEDER PORQUE ES PRIVADO
//echo $milo->pulgas;

$milo->ladrar();
$milo->comer("Alimento");
$milo->aparecer();
$milo->tiene_pulgas();
$milo->mas_info();

