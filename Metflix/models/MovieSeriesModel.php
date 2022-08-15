<?php

class MovieSeriesModel extends Model {

    //No uso constructor porque al inicializar el modelo no necesito que haga nada

    public function set( $ms_data = array() ){
        foreach($ms_data as $key => $value){
            $$key = $value;
        }
        
        //Como en el plot a veces escriben en ingles y usan comilla simple asi 's, eso hace que se rompa todo
        //porque yo estoy usando comilla simple para asignar, asi que voy a reemplazar esas comillas con 
        //una contrabarra asi la saltea
        $plot = str_replace("'", "\'", $plot);

        $this->query = "REPLACE INTO movieseries (id_imdb, title, plot, author, actors, country, premiere,
            poster, trailer, rating, genres, status, category) 
                VALUES ('$id_imdb', '$title', '$plot', '$author', '$actors', '$country', '$premiere', '$poster',
                    '$trailer', $rating, '$genres', $status, '$category')";

        $this->set_query();
    }

    
    public function get($id_imdb = ''){
        $this->query = ($id_imdb != '')
            ? "SELECT ms.id_imdb, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere,
                ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status
                    FROM movieseries as ms INNER JOIN status as s 
                        ON ms.status = s.id_status
                            WHERE ms.id_imdb = '$id_imdb'" 

            : 'SELECT ms.id_imdb, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere,
                ms.poster, ms.trailer, ms.rating, ms.genres, s.status, ms.category
                    FROM movieseries as ms INNER JOIN status as s
                        ON ms.status = s.id_status';

        $this->get_query();

        $data = array();

        foreach ($this->rows as $key=>$value){
            array_push($data, $value);
        }

        return $data;
    }

    public function del($id_imdb = ''){

        $this->query = "DELETE FROM movieseries WHERE id_imdb = '$id_imdb'";

        $this->set_query();
    }

    //Destructor
    public function __destruct() {
    
	}
}