<?php
print('<h2 class="p1">GESTIÓN DE USUARIOS</h2>');

//Declaro el status controller
$users_controller = new UsersController();

//Llamo todo los estados y los guardo
$users = $users_controller->get();

//Valido si esta vacio
if( empty($users) ){
    print('
        <div>
            <p class="item error">No hay usuarios</p>
        </div>
    ');
} else {
    //Voy a mostrar los status lo hago en template porque necesito concatenar las variables
    //El valor r que mando en hidden es para el ruteador, router.php
    //colspan = "2" en un th de un table o un td hace que ocupe DOS celdas de espacio
    $template_users = '
        <div class="item">
            <table>
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Cumpleaños</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th colspan="2">
                        <form method="POST">
                            <input type="hidden" name="r" value="users-add">
                            <input class="button add" type="submit" value="Agregar">
                        </form>
                    </th>
                </tr>';

    //Aca comienzo dinamicamente a crear una fila por registro y en la ultima columna pongo el boton para editar y borrar
    //uso los inputs hidden para guardar valores como en los cursos de javascript
    for($n=0; $n < count($users); $n++){
        $template_users .= '
            <tr>
                <td>' .$users[$n]['user']. '</td>
                <td>' .$users[$n]['email']. '</td>
                <td>' .$users[$n]['nombre']. '</td>
                <td>' .$users[$n]['birthday']. '</td>
                <td>' .$users[$n]['pass']. '</td>
                <td>' .$users[$n]['role']. '</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="users-edit">
                        <input type="hidden" name="user" value="' .$users[$n]['user']. '">
                        <input class="button edit" type="submit" value="Editar">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="users-delete">
                        <input type="hidden" name="user" value="' .$users[$n]['user']. '">
                        <input class="button delete" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        ';
    }
    

    $template_users .= '</table>
        </div>        
    ';

    //Muestro la tabla
    print($template_users);
}