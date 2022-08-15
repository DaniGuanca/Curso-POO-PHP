<?php
//StatusView tiene la vista al usuario
require('StatusControler.php');

echo'<h1>CRUD con MVC de la tabla status</h1>';

//Llamo al controlador y el controlador a traves de sus metodos llama al modelo y ejecuta los metodos de accesos a BD
$status = new StatusController();

$status_data = $status->read();
var_dump($status_data);
 
$num_status = count($status_data);

echo "<h2>Numero de Status: <mark>$num_status</mark></h2>";

echo '<h2>Tabla de Status</h2>';

//Relleno dinamicamente la tabla
echo "
    <table>
        <tr>
            <th>Id Status</th>
            <th>Status</th>
        </tr>";

        for ($i = 0; $i < $num_status; $i++) {
            //Concateno porque echo no deja imprimir un array, como es arreglo asociativo entro por el nombre
            //a su posicion
            echo "
            <tr>
                <td>".$status_data[$i]['id_status']."</td>
                <td>".$status_data[$i]['status']."</td>
            </tr>";
        }
        
echo "</table>";

echo '<h2>Insertando Status</h2>';
//Creo el arreglo con los datos a insertar, es un arreglo porque la funcion create hice que reciba un arreglo
//va a ser un arreglo asociativo, entre los parentesis defino el cuerpo del arreglo
//a id status le pongo 0 porque es autoincremental
$new_status = array(
                    'id_status'=> 0,
                    'status' => 'Otro status'
                    );

//INVOCO LA FUNCION
//$status->create($new_status);

echo '<h2>Actualizando Status</h2>';
$update_status = array(
    'id_status'=> 9,
    'status' => 'Other status'
    );

//INVOCO LA FUNCION
//$status->update($update_status);



echo '<h2>Eliminando Status</h2>';
//$status->delete(9);

