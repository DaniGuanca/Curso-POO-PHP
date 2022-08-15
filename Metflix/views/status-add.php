<?php
//Me fijo que la variable r osea ruta sea status-add y que tenga permiso de role admin, que lo tengo guardado en la variable de sesion
//y que no este definida la variable crud
//Como el formulario no tiene action al hacer click en agregar va a reprocesar la pagina entonces ahi entra el input crud con value set
if( $_POST['r']== 'status-add' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
    print ('
        <h2 class="p1">Agregar Status</h2>
        <form method="POST" class="item">
            <div class="p_25">
                <input type="text" name="status" placeholder="status" required>
            </div>
            <div class="p_25">
                <input class="button add" type="submit" value="Agregar">
                <input type="hidden" name="r" value="status-add">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>
    ');
}else if( $_POST['r']== 'status-add' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set'){
    //Programo la inserccion
    $status_controller = new StatusController();

    //el arreglo con los campos, le pongo id 0 porque es numerico autoincremental
    $new_status = array(
        'id_status' => 0,
        'status' => $_POST['status']);

    //La operacion set
    $status = $status_controller->set($new_status);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item add">Status <b>%s</b> salvado</p>
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
