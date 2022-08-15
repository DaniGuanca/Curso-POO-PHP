<?php
//Se encarga de validar si los usuarios existen para levantar la sesion
class SessionController {
    private $session;

    public function __construct() {
        //Para llamar a los metodos que entran a la BD y buscar los usuarios para ver si estan bien lo que envio
        $this->session = new UsersModel();
    }

    //Inicia la sesion
    public function login($user, $pass) {
        return $this->session->validate_user($user, $pass);
    }

    //Destruye sesion
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ./');
    }

    public function __destruct()
    {
        
    }
}