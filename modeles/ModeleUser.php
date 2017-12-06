<?php
/**
 * Created by PhpStorm.
 * User: elone
 * Date: 12/6/17
 * Time: 4:32 PM
 */

class ModeleUser
{
    function  __construct() {

    }

    public function connexion(string $username, string $password) {
        $username = Validation::nettoyerString($username);
        $password = Validation::nettoyerString($password);

        if (UserGateway::login($username, $password)) {
            session_start();

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }

    }

    public function deconnexion(string $username, string $password) {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function isUser() : bool {
            if (isset($_SESSION['username']) && isset($_SESSION['password']))
                return true;
            return false;
    }

}