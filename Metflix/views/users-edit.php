<?php
//Me fijo que la variable r osea ruta sea status-add y que tenga permiso de role admin, que lo tengo guardado en la variable de sesion
//y que no este definida la variable crud
//Como el formulario no tiene action al hacer click en agregar va a reprocesar la pagina entonces ahi entra el input crud con value set
$users_controller = new UsersController();

if( $_POST['r']== 'users-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
    //Agarro el id_status que se envio del boton anterior por metodo post
    $user = $users_controller->get($_POST['user']);

    if( empty($user) ){
        $template = '
            <div class="container">
                <p class="item error">No existe el usuario <b>%s</b></p>
            </div>
            <script>
                window.onload = function() {
                    reloadPage("usuarios");
                }
            </script>
        ';

        printf($template, $_POST['users']);

    } else {
        //Para poner el checked en los input radio del template en su comodin %s
        $role_admin = ($user[0]['role'] == 'Admin') ? 'checked' : '';
		$role_user = ($user[0]['role'] == 'User') ? 'checked' : '';

        //Un input del tipo disabled no se puede pasar al backend por eso hace otro input
        $template_users = '
            <h2 class="p1">Editar Usuarios</h2>
            <form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="usuario" value="%s" disabled required>
					<input type="hidden" name="user" value="%s">
				</div>
				<div class="p_25">
					<input type="email" name="email" placeholder="email" value="%s" required>
				</div>
				<div class="p_25">
					<input type="text" name="nombre" placeholder="nombre" value="%s" required>
				</div>
				<div class="p_25">
					<input type="text" name="birthday" placeholder="cumpleaños" value="%s" required>
				</div>
				<div class="p_25">
					<input type="password" name="pass" placeholder="password" value="" required>
				</div>
				<div class="p_25">
                    <input type="radio" name="role" id="admin" value="Admin" %s required>
                    <label for="admin">Administrador</label>
                    <input type="radio" name="role" id="noadmin" value="User" %s required>
                    <label for="noadmin">Usuario</label>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="users-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
        ';

        printf(
            $template_users,
			$user[0]['user'],
			$user[0]['user'],
			$user[0]['email'],
			$user[0]['nombre'],
			$user[0]['birthday'],
			//$user[0]['pass'],
			$role_admin,
			$role_user
        );
    }

}else if( $_POST['r']== 'users-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set'){
    //Programo la edicion
    //el arreglo con los campos
    $save_user = array(
        'user' => $_POST['user'],
        'email' => $_POST['email'],
        'nombre' => $_POST['nombre'],
        'birthday' => $_POST['birthday'],
        'pass' => $_POST['pass'],
        'role' => $_POST['role']
    );

    //La operacion set
    $users = $users_controller->set($save_user);

    //En la parte script con javascript llamo a la funcion reloadPage que esta en public js, que hace que
    //despues de 3 segundos me mande de nuevo a la pagina status
    $template = '
        <div class="container">
            <p class="item edit">Usuario <b>%s</b> salvado</p>
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