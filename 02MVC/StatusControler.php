<?php
//Status Controler se encarga de llamar a operaciones de status model o status view segun las peticiones o proceso
require_once('StatusModel.php');

class statusController {
    //Atributo privado para invocar o inicializar la clase StatusModel
    private $model;


    //EL controlador tiene que replicar los mismos metodos que statusModelo con los mismos parametros
    //Basicamente hace una instancia de statusModelo y llama a sus metodos
    public function __construct() {
        //Desde aca creo un objeto statusModel
        $this->model = new StatusModel();
    }


    public function create( $status_data = array() ){
        return $this->model->create($status_data);
    }


    public function read($idStatus = ''){
        return $this->model->read($idStatus);
    }


    public function update( $status_data = array() ){
        return $this->model->update($status_data);
    }


    public function delete($idStatus = ''){
        return $this->model->delete($idStatus);
    }

    //Destructor
    public function __destruct() {

	}
}