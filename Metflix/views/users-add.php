<?php
//Me fijo que la variable r osea ruta sea status-add y que tenga permiso de role admin, que lo tengo guardado en la variable de sesion
//y que no este definida la variable crud
//Como el formulario no tiene action al hacer click en agregar va a reprocesar la pagina entonces ahi entra el input crud con value set
if( $_POST['r']== 'users-add' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
    print ('
        <h2 class="p1">Agregar Usuario</h2>
        <form method="POST" class="item">
            <div class="p_25">
                <input type="text" name="user" placeholder="Usuario" required>
            </div>
            <div class="p_25">
                <input type="email" name="email" placeholder="email" required>
            </div>
            <div class="p_25">
                <input type="text" name="nombre" placeholder="nombre" required>
            </div>
            <div class="p_25">
                <input type="text" name="birthday" placeholder="cumpleaños" required>
            </div>
            <div class="p_25">
                <input type="password" name="pass" placeholder="password" required>
            </div>
            <div class="p_25">
                <input type="radio" name="role" id="admin" value="Admin" required>
                <label for="admin">Administrador</label>
                <input type="radio" name="role" id="noadmin" value="User" required>
                <label for="noadmin">Usuario</label>
            </div>
            <div class="p_25">
                <input class="button add" type="submit" value="Agregar">
                <input type="hidden" name="r" value="users-add">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>
    ');
}else if( $_POST['r']== 'users-add' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set'){
    //Programo la inserccion
    $users_controller = new UsersController();

    //el arreglo con los campos, le pongo id 0 porque es numerico autoincremental
    $new_user = array(
        'user' => $_POST['user'],
        'email' => $_POST['email'],
        'nombre' => $_POST['nombre'],
        'birthday' => $_POST['birthday'],
        'pass' => $_POST['pass'],
        'role' => $_POST['role']
    );

    //La operacion set
    $users = $users_controller->set($new_user);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item add">Usuario <b>%s</b> salvado</p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("usuarios");
            }
        </script>
    ';

    printf($template, $_POST['user']);

} else {
    //Genero vista de no autorizado
    $controller = new ViewController();
    $controller->load_view('error401');
}
