<?php
//Esta clase se va a encargar de cargar las vistas que se necesiten
class ViewController {
    //Estatico porque no va a cambiar
    private static $view_path = './views/';

    public function load_view($view){
        //Va a cargar la vista que necesite dentro del path views, con esto formo la ruta del archivos
        //Hago la reutilizacion del header y footer tambien
        require_once(self::$view_path .'header.php');
        require_once(self::$view_path .$view. '.php');
        require_once(self::$view_path .'footer.php');
    }

    public function __destruct()
    {
        
    }
}