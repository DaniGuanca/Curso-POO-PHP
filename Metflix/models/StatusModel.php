<?php
//Todas las explicaciones y comentarios estan en la carpeta 02MVC en el archivo StatusModel.php

class StatusModel extends Model {

    //No uso constructor porque al inicializar el modelo no necesito que haga nada

    public function set( $status_data = array() ){
        foreach($status_data as $key => $value){
            $$key = $value;
        }
        
        $this->query = "REPLACE INTO status (id_status, status) VALUES ($id_status, '$status')";

        $this->set_query();
    }

    
    public function get($idStatus = ''){
        $this->query = ($idStatus != '')
            ? "SELECT * FROM status WHERE id_status = '$idStatus'" 
            : 'SELECT * FROM status';

        $this->get_query();
        
        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key=>$value){
            array_push($data, $value);
        }

        return $data;
    }

    public function del($idStatus = ''){

        $this->query = "DELETE FROM status WHERE id_status = '$idStatus'";

        $this->set_query();
    }

    //Destructor
    public function __destruct() {
    
	}
}