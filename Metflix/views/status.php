<?php
print('<h2 class="p1">GESTIÓN DE STATUS</h2>');

//Declaro el status controller
$status_controller = new StatusController();

//Llamo todo los estados y los guardo
$status = $status_controller->get();

//Valido si esta vacio
if( empty($status) ){
    print('
        <div>
            <p class="item error">No hay status</p>
        </div>
    ');
} else {
    //Voy a mostrar los status lo hago en template porque necesito concatenar las variables
    //El valor r que mando en hidden es para el ruteador, router.php
    //colspan = "2" en un th de un table o un td hace que ocupe DOS celdas de espacio
    $template_status = '
        <div class="item">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Status</th>
                    <th colspan="2">
                        <form method="POST">
                            <input type="hidden" name="r" value="status-add">
                            <input class="button add" type="submit" value="Agregar">
                        </form>
                    </th>
                </tr>';

    //Aca comienzo dinamicamente a crear una fila por registro y en la ultima columna pongo el boton para editar y borrar
    //uso los inputs hidden para guardar valores como en los cursos de javascript
    for($n=0; $n < count($status); $n++){
        $template_status .= '
            <tr>
                <td>' .$status[$n]['id_status']. '</td>
                <td>' .$status[$n]['status']. '</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="status-edit">
                        <input type="hidden" name="id_status" value="' .$status[$n]['id_status']. '">
                        <input class="button edit" type="submit" value="Editar">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="status-delete">
                        <input type="hidden" name="id_status" value="' .$status[$n]['id_status']. '">
                        <input class="button delete" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        ';
    }
    

    $template_status .= '</table>
        </div>        
    ';

    //Muestro la tabla
    print($template_status);
}