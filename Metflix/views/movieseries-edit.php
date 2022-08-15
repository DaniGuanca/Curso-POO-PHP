<?php
$ms_controller = new MovieSeriesController();

if( $_POST['r']== 'ms-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
    $ms = $ms_controller->get($_POST['id_imdb']);

    if( empty($ms) ){
        $template = '
            <div class="container">
                <p class="item error">No existe la movieserie <b>%s</b></p>
            </div>
            <script>
                window.onload = function() {
                    reloadPage("movieseries");
                }
            </script>
        ';

        printf($template, $_POST['id_imdb']);

    } else {
        //Para poner el checked en los input radio del template en su comodin %s
        $category_movie = ($ms[0]['category'] == 'Movie') ? 'checked' : '';
        $category_serie = ($ms[0]['category'] == 'Serie') ? 'checked' : '';
        
        $status_controller = new StatusController();
		$status = $status_controller->get();
		$status_select = '';

		for ($n=0; $n < count($status); $n++) { 
			$selected = ($ms[0]['status'] == $status[$n]['status']) ? 'selected' : '';
			$status_select .= '<option value="' . $status[$n]['id_status'] . '"' . $selected . '>' . $status[$n]['status'] . '</option>';
		}

        //Un input del tipo disabled no se puede pasar al backend por eso hace otro input
        $template_ms = '
            <h2 class="p1">Editar MovieSerie</h2>
            <form method="POST" class="item">
                <div class="p_25">
                    <input type="text" placeholder="id_imdb" value="%s" disabled required>
                    <input type="hidden" name="id_imdb" value="%s">
                </div>
                <div class="p_25">
                    <input type="text" name="title" placeholder="título" value="%s" required>
                </div>
                <div class="p_25">
                    <textarea name="plot" cols="22" rows="10" placeholder="descripción">%s</textarea>
                </div>
                <div class="p_25">
                    <input type="text" name="author" placeholder="autor" value="%s">
                </div>
                <div class="p_25">
                    <input type="text" name="actors" placeholder="actores" value="%s">
                </div>
                <div class="p_25">
                    <input type="text" name="country" placeholder="país" value="%s">
                </div>
                <div class="p_25">
                    <input type="text" name="premiere" placeholder="estreno" value="%s" required>
                </div>
                <div class="p_25">
                    <input type="url" name="poster" placeholder="poster" value="%s">
                </div>
                <div class="p_25">
                    <input type="url" name="trailer" placeholder="trailer" value="%s">
                </div>
                <div class="p_25">
                    <input type="number" name="rating" placeholder="rating" value="%s" required>
                </div>
                <div class="p_25">
                    <input type="text" name="genres" placeholder="géneros" value="%s" required>
                </div>
                <div class="p_25">
                    <select name="status" placeholder="status" required>
                        <option value="">status</option>
                        %s
                    </select>
                </div>
                <div class="p_25">
                    <input type="radio" name="category" id="movie" value="Movie" %s required><label for="movie">Movie</label>
                    <input type="radio" name="category" id="serie" value="Serie" %s required><label for="serie">Serie</label>
                </div>
                <div class="p_25">
                    <input  class="button  edit" type="submit" value="Editar">
                    <input type="hidden" name="r" value="ms-edit">
                    <input type="hidden" name="crud" value="set">
                </div>
			</form>
        ';

        printf(
            $template_ms,
			$ms[0]['id_imdb'],
			$ms[0]['id_imdb'],
			$ms[0]['title'],
			$ms[0]['plot'],
			$ms[0]['author'],
			$ms[0]['actors'],
			$ms[0]['country'],
			$ms[0]['premiere'],
			$ms[0]['poster'],
			$ms[0]['trailer'],
			$ms[0]['rating'],
			$ms[0]['genres'],
			$status_select,
			$category_movie,
			$category_serie
        );
    }

}else if( $_POST['r']== 'ms-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set'){
    //Programo la edicion
    //el arreglo con los campos
    $save_ms = array(
		'id_imdb' =>  $_POST['id_imdb'],
		'title' =>  $_POST['title'], 
		'plot' =>  $_POST['plot'], 
		'author' =>  $_POST['author'],
		'actors' =>  $_POST['actors'],
		'country' =>  $_POST['country'],
		'premiere' =>  $_POST['premiere'],
		'poster' =>  $_POST['poster'],
		'trailer' =>  $_POST['trailer'],
		'rating' =>  $_POST['rating'],
		'genres' =>  $_POST['genres'],
		'status' =>  $_POST['status'],
		'category' =>  $_POST['category']
	);


    //La operacion set
    $ms = $ms_controller->set($save_ms);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item edit">MovieSerie <b>%s</b> salvada</p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("movieseries");
            }
        </script>
    ';

    printf($template, $_POST['title']);

} else {
    //Genero vista de no autorizado
    $controller = new ViewController();
    $controller->load_view('error401');
}