<?php
//Esta clase va a cargar todas las clases necesarias de forma automatica para no hacer los require en cada
//archivo
class Autoload {
    public function __construct(){
        //spl_autoload_register() recibe el nombre de una funcion o puedo hacer una funcion anonima dentro
        //Esta funcion va a hacer un bucle por cada archivo para poner el include automaticamente
        spl_autoload_register(function ($class_name) {
            //Le tengo que decir donde estan las rutas para acceder a los modelos y controladores
            //Ruta de modelos
            $models_path = './models/' .$class_name. '.php';
            
            //Ruta de controladores
            $controllers_path = './controllers/' .$class_name. '.php';

            //Esto es para mostrar como sirve, que automatica te agarra la clase que necesita 
            /* echo "<p>$models_path</p>
                <p>$controllers_path</p>"; */

            //Aca hago el require que es lo que va a poner con el nombre de la clase que necesite
            //como require detiene todo con un error fatal cuando no encuentra un archivo
            //primero valido que exista el archivo con la funcion file_exists(ruta con archivo)
            if( file_exists($models_path) ) require_once($models_path);

            if( file_exists($controllers_path) ) require_once($controllers_path);

        });
        
    }

    public function __destruct(){}
}