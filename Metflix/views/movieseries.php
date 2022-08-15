<?php
print('<h2 class="p1">GESTIÓN DE MOVIESERIES</h2>');

$ms_controller = new MovieSeriesController();

$ms = $ms_controller->get();

//Valido si esta vacio
if( empty($ms) ){
    print('
        <div>
            <p class="item error">No hay movieseries</p>
        </div>
    ');

} else {    
    $template_ms = '
        <div class="item">
            <table>
                <tr>
                    <th>IMDB Id</th>
                    <th>Título</th>
                    <th>Estreno</th>
                    <th>Géneros</th>
                    <th>Status</th>
                    <th>Categoría</th>
                    <th colspan="3">
                        <form method="POST">
                            <input type="hidden" name="r" value="ms-add">
                            <input class="button  add" type="submit" value="Agregar">
                        </form>
                    </th>
                </tr>';

    for($n=0; $n < count($ms); $n++){
        $template_ms .= '
            <tr>
                <td>' .$ms[$n]['id_imdb']. '</td>
                <td>' .$ms[$n]['title']. '</td>
                <td>' .$ms[$n]['premiere']. '</td>
                <td>' .$ms[$n]['genres']. '</td>
                <td>' .$ms[$n]['status']. '</td>
                <td>' .$ms[$n]['category']. '</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="ms-show">
                        <input type="hidden" name="id_imdb" value="' .$ms[$n]['id_imdb']. '">
                        <input class="button show" type="submit" value="Mostrar">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="ms-edit">
                        <input type="hidden" name="id_imdb" value="' .$ms[$n]['id_imdb']. '">
                        <input class="button edit" type="submit" value="Editar">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="r" value="ms-delete">
                        <input type="hidden" name="id_imdb" value="' .$ms[$n]['id_imdb']. '">
                        <input class="button delete" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        ';
    }
    

    $template_ms .= '</table>
        </div>        
    ';

    //Muestro la tabla
    print($template_ms);
}