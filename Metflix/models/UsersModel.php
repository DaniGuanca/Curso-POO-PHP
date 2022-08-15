<?php
//Todas las explicaciones y comentarios estan en la carpeta 02MVC en el archivo StatusModel.php

class UsersModel extends Model {

    //No uso constructor porque al inicializar el modelo no necesito que haga nada

    public function set( $user_data = array() ){
        foreach($user_data as $key => $value){
            $$key = $value;
        }
        $this->query = "REPLACE INTO users (user, email, nombre, birthday, pass, role) VALUES ('$user', '$email', 
        '$nombre', '$birthday', MD5('$pass'), '$role')";

        $this->set_query();
    }

    
    public function get($user = ''){
        $this->query = ($user != '')
            ? "SELECT * FROM users WHERE user = '$user'" 
            : 'SELECT * FROM users';

        $this->get_query();
        
        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key=>$value){
            array_push($data, $value);
        }

        return $data;
    }

    public function del($user = ''){

        $this->query = "DELETE FROM users WHERE user = '$user'";

        $this->set_query();
    }

    public function validate_user($user, $pass){
        $this->query = "SELECT * FROM users WHERE user = '$user' AND pass=MD5('$pass')";

        $this->get_query();

        $data = array();

        foreach($this->rows as $key=>$value){
            array_push($data,$value);
        }

        return $data;
    }

    //Destructor
    public function __destruct() {
    
	}
}