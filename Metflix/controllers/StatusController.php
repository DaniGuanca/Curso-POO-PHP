<?php

class StatusController {
    private $model;

    public function __construct() {
        $this->model = new StatusModel();
    }


    public function set( $status_data = array() ){
        return $this->model->set($status_data);
    }


    public function get($idStatus = ''){
        return $this->model->get($idStatus);
    }


    public function del($idStatus = ''){
        return $this->model->del($idStatus);
    }

    //Destructor
    public function __destruct() {

	}
}