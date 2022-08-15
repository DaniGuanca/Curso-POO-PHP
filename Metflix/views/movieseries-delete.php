<?php
$ms_controller = new MovieSeriesController();

if( $_POST['r']== 'ms-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
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
        //Un input del tipo disabled no se puede pasar al backend por eso hace otro input
        $template_ms = '
            <h2 class="p1">Eliminar Usuario</h2>
            <form method="POST" class="item">
                <div class="p1 f2">
                    Estas seguro de eliminar la movieserie: <mark class="p1">%s</mark>?                    
                </div>
                <div class="p_25">
                    <input class="button delete" type="submit" value="SI">
                    <input class="button add" type="button" value="NO" onclick="history.back()">
                    <input type="hidden" name="id_imdb" value="%s">
                    <input type="hidden" name="r" value="ms-delete">
                    <input type="hidden" name="crud" value="del">                 
                </div>
            </form>
        ';

        printf(
            $template_ms,
            $ms[0]['title'],
            $ms[0]['id_imdb']
        );
    }

}else if( $_POST['r']== 'ms-delete' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'del'){
    //Programo la eliminacion

    $user = $ms_controller->del($_POST['id_imdb']);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item delete">Movieserie <b>%s</b> eliminado</p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("movieseries");
            }
        </script>
    ';

    printf($template, $_POST['id_imdb']);

} else {
    //Genero vista de no autorizado
    $controller = new ViewController();
    $controller->load_view('error401');
}