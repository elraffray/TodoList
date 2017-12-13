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

    public function connexion(string $username, string $password) : bool {

        global $dVueEreur;
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $dVueEreur = array();


        $username = Validation::nettoyerString($username);
        $password = Validation::nettoyerString($password);

        try {
            if (UserGateway::login($username, $password)) {

                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                return true;
            }
            return false;

        } catch (Exception $e) {
            $dVueEreur[] = $e->getMessage();
            require($rep . $vues['erreur']);

        }

    }

    public function deconnexion() {
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