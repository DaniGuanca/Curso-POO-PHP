<?php
//Me fijo que la variable r osea ruta sea status-add y que tenga permiso de role admin, que lo tengo guardado en la variable de sesion
//y que no este definida la variable crud
//Como el formulario no tiene action al hacer click en agregar va a reprocesar la pagina entonces ahi entra el input crud con value set
$status_controller = new StatusController();

if( $_POST['r']== 'status-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
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
            <h2 class="p1">Editar Status</h2>
            <form method="POST" class="item">
                <div class="p_25">
                    <input type="text" placeholder="status id" value="%s" disabled required>
                    <input type="hidden" name="id_status" value="%s">
                </div>
                <div class="p_25">
                    <input type="text" name="status" placeholder="status" value="%s" required>
                </div>
                <div class="p_25">
                    <input class="button edit" type="submit" value="Editar">
                    <input type="hidden" name="r" value="status-edit">
                    <input type="hidden" name="crud" value="set">                 
                </div>
            </form>
        ';

        printf(
            $template_status,
            $status[0]['id_status'],
            $status[0]['id_status'],
            $status[0]['status']
        );
    }

}else if( $_POST['r']== 'status-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set'){
    //Programo la edicion
    //el arreglo con los campos
    $save_status = array(
        'id_status' => $_POST['id_status'],
        'status' => $_POST['status']);

    //La operacion set
    $status = $status_controller->set($save_status);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item edit">Status <b>%s</b> salvado</p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("status");
            }
        </script>
    ';

    printf($template, $_POST['status']);

} else {
    //Genero vista de no autorizado
    $controller = new ViewController();
    $controller->load_view('error401');
}