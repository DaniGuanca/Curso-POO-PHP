<?php
//ACA PONGO EL INICIO DE SESION
//Se encarga del enrutamiento
class Router {
    public $route;

    public function __construct($route){
        //Valido si no existe la variable session, si no existo creo una sesion en falso para que entre al formlario
        if( !isset($_SESSION) ){
            //http://php.net/manual/es/function.session-start.php
		    //http://php.net/manual/es/session.configuration.php

            //Inicio una session, a partir de php 7 se pasa un arreglo con parametros, read an close cierra
            //automaticamente la sesion cuando no existe o no se usa
            session_start([
                'use_only_cookies' => 1,
                //'auto_start' => 1,
                //Jon puso en true el read an close pero a mi no me funciona asi que lo puse en false
                'read_and_close' => false
            ]);
        }

        if( !isset($_SESSION['ok']))  $_SESSION['ok'] = false;

        //Va a ser una aplicacion autenticada entonces me fijo si existe la sesion o no
        if($_SESSION['ok']) {
            //Programacion de la aplicacion web
            $this->route = isset($_GET['r']) ? $_GET['r'] : 'home';

            //Aca hago lo propio del enrutador es decir las redirecciones
            $controller = new ViewController();

            switch ($this->route){
                case 'home':  
                    $controller->load_view('home');
                    break;

                case 'movieseries':
                    if ( !isset($_POST['r']) ) $controller->load_view('movieseries');

                     else if( $_POST['r'] == 'ms-add') $controller->load_view('movieseries-add');

                     else if( $_POST['r'] == 'ms-edit') $controller->load_view('movieseries-edit');

                     else if( $_POST['r'] == 'ms-delete') $controller->load_view('movieseries-delete');

                     else if( $_POST['r'] == 'ms-show') $controller->load_view('movieserie-show');
                                      
                    break;

                case 'usuarios':
                    if ( !isset($_POST['r']) ) $controller->load_view('users');

                     else if( $_POST['r'] == 'users-add') $controller->load_view('users-add');

                     else if( $_POST['r'] == 'users-edit') $controller->load_view('users-edit');

                     else if( $_POST['r'] == 'users-delete') $controller->load_view('users-delete');
                                      
                    break;

                //Dentro de status en la tabla en un input hidden puse una variable r para que me redireccione a 
                //eliminar editar o agregar un status segund donde clickeo, viene por POST
                case 'status':
                    if ( !isset($_POST['r']) ) $controller->load_view('status');

                     else if( $_POST['r'] == 'status-add') $controller->load_view('status-add');

                     else if( $_POST['r'] == 'status-edit') $controller->load_view('status-edit');

                     else if( $_POST['r'] == 'status-delete') $controller->load_view('status-delete');
                                      
                    break;

                case 'salir':
                    //Destruyo la sesion
                    $user_session = new SessionController();
                    $user_session->logout();
                    break;

                default:
                    //Aprovecho el default para poner el error 404 de que no existe la pagina
                    $controller->load_view('error404');
                    break;
            }

           

        }else {
            //Cuando el tipo hace submit se mandan por POST las variables que ingreso al formulario y hace la recarga
            //entonces antes de mostrar el formulario me fijo si estan esas variables por si se recargo la pagina
            if( !isset($_POST["user"]) && !isset($_POST["pass"]) ){
                //Muestro formulario de autenticacion
                $login_form = new ViewController();
                $login_form->load_view('login');

            }else {
                //Aca significa que ya uso el formulario, intento crear una session de usuario
                $user_session = new SessionController();
                //Si puso bien el usuario y pass el arrego $session va a venir con algo sino vacio
                $session = $user_session->login($_POST["user"], $_POST["pass"]);

                //empty(arreglo) me dice si un arreglo viene vacio o no
                if( empty($session) ){
                    //No existe el usuario o pass
                    //Llamo al controlador de vistas para que me cargue la vista de login de nuevo
                    $login_form = new ViewController();
                    $login_form->load_view('login');
                    //Le mando la variable a la cabecera
                    header('Location: ./?error=El usuario '. $_POST['user']. ' y el password no coinciden');
                }else {
                    //Si puso bien los datos hago la sesion en true
                    $_SESSION['ok'] = true;
                    
                    //Hay que guardar toda la informacion necesaria en la variables de session
                    //Cuando se crean variables de sesion y se crea la sesion aunque pase de una ruta a otra
                    //esas variables se quedan en esa sesion y puedo accederlas en todas momentos sin necesidad
                    //de hacer otra consulta a la BD

                    //Como ya se que este arreglo viene con una sola posicion no me hace falta usar clave-valor
                    //Recorro el arreglo y guardo las variables
                    foreach($session as $row){
                        $_SESSION['user'] = $row['user'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['birthday'] = $row['birthday'];
                        $_SESSION['pass'] = $row['pass'];
                        $_SESSION['role'] = $row['role'];
                    }

                    //var_dump($session);

                    //Recargo la apllicacion
                    header('Location: ./');
                }

            }
            
        }
    }

    public function __destruct(){

    }
}