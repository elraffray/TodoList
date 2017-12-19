<?php
/**
 * Created by PhpStorm.
 * User: elone
 * Date: 12/6/17
 * Time: 4:07 PM
 */

class UserGateway
{
    private static $con;

    public static function setConnection()
    {
        global $dsn, $user, $pass;
        self::$con = new Connection($dsn, $user, $pass);
    }


    public static function login(string $username, string $password) : bool {
        self::setConnection();


        self::$con->executeQuery("Select password from users where username=:username", array(
            ':username' => array($username, PDO::PARAM_STR)
        ));

        $res = self::$con->getResults();

        if (count($res) != 0 ) {
            if (password_verify($password, $res[0]['password']))
                return true;
        }
        return false;


    }
}