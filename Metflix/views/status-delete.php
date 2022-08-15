<?php
//Me fijo que la variable r osea ruta sea status-add y que tenga permiso de role admin, que lo tengo guardado en la variable de sesion
//y que no este definida la variable crud
//Como el formulario no tiene action al hacer click en agregar va a reprocesar la pagina entonces ahi entra el input crud con value set
$status_controller = new StatusController();

if( $_POST['r']== 'status-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
    //Agarro el id_status que se envio del boton anterior por metodo post
    $status = $status_controller->get($_POST['id_status']);

    if( empty($status) ){
        $template = '
            <div class="container">
                <p class="item error">No existe el id de status <b>%s</b></p>
            </div>
            <script>
                window.onload = function() {
                    reloadPage("status");
                }
            </script>
        ';

        printf($template, $_POST['status_id']);

    } else {
        //Un input del tipo disabled no se puede pasar al backend por eso hace otro input
        $template_status = '
            <h2 class="p1">Eliminar Status</h2>
            <form method="POST" class="item">
                <div class="p1 f2">
                    Estas seguro de eliminar el status: <mark class="p1">%s</mark>?                    
                </div>
                <div class="p_25">
                    <input class="button delete" type="submit" value="SI">
                    <input class="button add" type="button" value="NO" onclick="history.back()">
                    <input type="hidden" name="id_status" value="%s">
                    <input type="hidden" name="r" value="status-delete">
                    <input type="hidden" name="crud" value="del">                 
                </div>
            </form>
        ';

        printf(
            $template_status,
            $status[0]['status'],
            $status[0]['id_status']
        );
    }

}else if( $_POST['r']== 'status-delete' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'del'){
    //Programo la eliminacion

    $status = $status_controller->del($_POST['id_status']);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item delete">Status <b>%s</b> eliminado</p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("status");
            }
        </script>
    ';

    printf($template, $_POST['id_status']);

} else {
    //Genero vista de no autorizado
    $controller = new ViewController();
    $controller->load_view('error401');
}