<?php
//ESTA LINEA ES PARA VER MEJOR LOS ERRORES DE CONEXION O CONSULTAS CUANDO HAYA UNO
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//Clase abstracta para crear la conexion y consultas a BD
//IMPORTANTE SI QUIERO EJECUTAR EL SCRIPT BORRO EL 1 AL LADO DE Model. SE LO PUSE PORQUE DABA PROBLEMAS DE 
//REFERENCIA CON MI OTRO EJERCICIO DE METFLIX
abstract class Model1 {
    //Atributos necesarios para la conexion
    //Necesito que estas variables sean privadas y que no cambien el valor por eso le pongo static
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = '';
    protected $db_name;
    private static $db_charset =  'utf8';
    //La conexion
    private $conn;
    //Las consultas a ejecutar
    protected $query;
    //Resultados de las consultas
    protected $rows = array ();

    //Metodos abstractos para CRUD de clases que hereden
    abstract protected function create();
    abstract protected function read();
    abstract protected function update();
    abstract protected function delete();

    //Metodo privado para conectarse a la BD 
    private function db_open(){
        //Como los atributos son static los puedo llamar con self
        $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
        $this->conn->set_charset(self::$db_charset);

    }

    //Metodo privado para conectarse a la BD 
    private function db_close(){
        $this->conn->close();
    }

    //Establecer un query que afecte datos: INSERT, DELETE, UPDATE (Solo dice si ejecuto o no la consulta)
    protected function set_query(){
        //Conecto
        $this->db_open();
        //Ejecuto consulta
        $this->conn->query($this->query);
        //Cierro conexion
        $this->db_close();
    }

    //Obtener resultados de un query SELECT en un array
    protected function get_query(){
        //Conecto
        $this->db_open();

        //Ejecuto consulta
        $result = $this->conn->query($this->query);

        //Guardo en un array los resultados
        //El while no tieene cuerpo y una condicional rara porque lo que hace el fetch assoc es mandar cada
        //registro al array rows. En el curso PHP esta la explicacion tambien y en la documentacion de PHP
        //Como es el fetch assoc devuelve un array asociativo osea que puedo acceder al valor del arreglo a
        //traves del nombre en vez de la posicion
        while( $this->rows[] = $result->fetch_assoc() );
        //Cierro la consulta pa limpiar memoria
        $result->close();

        //Cierro conexion
        $this->db_close();

        //Cuando ejecuto una consulta select y uso fetch assoc para guardar los resultados en un array, la funcion
        //agrega un registro demas nulo para hacer referencia a la cantidad de elementos
        //La funcion array_pop(arreglo) quita el ultimo elemento de un arreglo
        //Uso esa funcion para sacar ese ultimo registro que agrega con valor nulo
        return array_pop($this->rows);
    }
}
