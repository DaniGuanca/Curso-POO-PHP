<?php
//Status Model se encarga del CRUD a la clase y tabla status

//Para importar archivos en php se usa required.
//require_once significa que lo va a importar una unica vez no cada vez que recarguemos la aplicacion
require_once("Model.php");

/* Los ORM (Object Relational Model) mapean una tabla de la base de datos en un clase para ser usado como objeto
es lo que hacia en c# */

//La clase Status Model va a necesitar algunos atributos y operaciones de Model asi que va a heredar de ella
//Acordarse que la clase que hereda una abstracta tiene que implementar TODOS los metodos abstractos
class StatusModel extends Model {
    //Por cada campo un atributo de clase
    public $id_status;
    public $status;

    //Constructor
    public function __construct() {
        //Este constructor va a seleccionar la BD al crear el objeto
        //$db_name viene de la clase padre
        $this->db_name = 'metflix';
    }

    //Create va a hacer los INSERT, que espera un array lo recorre y va haciendo la consulta para insertar
    public function create( $status_data = array() ){
        foreach($status_data as $key => $value){
            //IMPORTANTE
            //Variable variables, lo que hace es crear una nueva variable dinamica a partir de la primera, se hace con $$
            //En este caso $key hace referencia a la posicion asociativa por ejemplo 'status_id' y $value a su valor
            //al poner doble $ ($$key) lo que hace es crear una variable dinamicamente con el nombre que tiene $key osea $status_id 
            //y a esa variable le asigna el valor de $value;
            $$key = $value;
        }
        //Aca leo las dos variables dinamicas que cree arriba
        $this->query = "INSERT INTO status (id_status, status) VALUES ($id_status, '$status')";

        $this->set_query();
    }

    //Read va a hacer los SELECT, y puede hacer select where con id
    //Entonces cuando pido un $idStatus y no mandan nada le asigno vacio ($idStatus = ''), si si tiene valor 
    //se queda con el valor que mandaron
    public function read($idStatus = ''){
        //Si viene vacia es todas, si no viene vacia solo muestro los valores de ese id, entonces la consulta es asi
        $this->query = ($idStatus != '')
            ? "SELECT * FROM status WHERE id_status = $idStatus" 
            : 'SELECT * FROM status';

        //Ejecuto el metodo, que va a poner en el atributo rows los registros
        $this->get_query();
        
        //Numero de registros, el count(Arreglo) da ese numero, es como el lenght de javascript
        $num_rows = count($this->rows);

        //No voy a devolver la variable rows porque es una variable protegida
        //En vez de eso hago una nueva variable y devuelvo esa variable
        //data va a ser un arreglo porque va a tener lo de rows
        $data = array();

        //http://php.net/manual/es/control-structures.foreach.php
        //foreach(Arreglo as llave(campo) => valor); Del arreglo Arreglo en su campo extrae su valor
        foreach ($this->rows as $key=>$value){
            //array_push(arreglo,elemento) agrega al final un elemento
            array_push($data, $value);
            
            //Otra forma de usarlo usando el indice
            //$data[$key] = $value;
        }

        //Devuelvo la nueva variable
        return $data;
    }

    //Hace las consultas UPDATE
    public function update( $status_data = array() ){
        foreach($status_data as $key => $value){
            //IMPORTANTE
            //Variable variables, lo que hace es crear una nueva variable dinamica a partir de la primera, se hace con $$
            //En este caso $key hace referencia a la posicion asociativa por ejemplo 'status_id' y $value a su valor
            //al poner doble $ ($$key) lo que hace es crear una variable dinamicamente con el nombre que tiene $key osea $status_id 
            //y a esa variable le asigna el valor de $value;
            $$key = $value;
        }
        //Aca leo las dos variables dinamicas que cree arriba
        $this->query = "UPDATE status SET id_status = $id_status, status = '$status' WHERE id_status=$id_status";

        $this->set_query();

    }


    //Hace las consultas DELETE, si no hay nada lo pongo pero no lo uso, es para que no mande error de que falta algo
    public function delete($idStatus = ''){

        $this->query = "DELETE FROM status WHERE id_status = $idStatus";

        $this->set_query();
    }

    //Destructor
    public function __destruct() {
        //Con unset(objeto) destruyo elimino de memoria el objeto PERO YA NO SE HACE DENTRO DEL DESTRUCTOR
        //A PARTIR DE PHP7 YA LO HACE AUTOMATICO
		//unset($this);
	}
}