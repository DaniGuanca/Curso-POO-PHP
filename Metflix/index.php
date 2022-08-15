<?php
//Autoload se va a encargar de cargar automaticamente las clases necesarias para cada proceso asi no estoy
//haciendo un require_once en cada archivo
require_once('./controllers/Autoload.php');
//No estoy mandando el nombre de la clase porque eso lo hace automaticamente el autoload, no hace falta ponerlo
$autoload = new Autoload();

//Se fija si existe la variable r en la URL, el valor ese es una direccion si existe guardo eso en la ruta para ir ahi
//si viene vacia quiere decir que va a ir al home entonces asigno la direccion para home.
$route = (isset($_GET['r'])) ? $_GET['r'] : 'home';

$metflix = new Router($route);

