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


        self::$con->executeQuery("Select count(1) as count from users where username=:username and password=:password", array(
            ':username' => array($username, PDO::PARAM_STR),
            ':password' => array($password, PDO::PARAM_STR),
        ));

        $res = self::$con->getResults();

        if ($res[0]['count'] == 1) return true;

        return false;


    }
}