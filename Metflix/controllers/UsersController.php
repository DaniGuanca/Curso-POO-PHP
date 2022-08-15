<?php

class UsersController {
    private $model;

    public function __construct() {
        $this->model = new UsersModel();
    }


    public function set( $user_data = array() ){
        return $this->model->set($user_data);
    }


    public function get($user = ''){
        return $this->model->get($user);
    }


    public function del($user = ''){
        return $this->model->del($user);
    }

    //Destructor
    public function __destruct() {

	}
}