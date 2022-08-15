<?php

class MovieSeriesController {
    private $model;

    public function __construct() {
        $this->model = new MovieSeriesModel();
    }


    public function set( $ms_data = array() ){
        return $this->model->set($ms_data);
    }


    public function get($id_imdb = ''){
        return $this->model->get($id_imdb);
    }


    public function del($id_imdb = ''){
        return $this->model->del($id_imdb);
    }

    //Destructor
    public function __destruct() {

	}
}