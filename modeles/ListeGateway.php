<?php

/**
 * Created by PhpStorm.
 * User: elraffray
 * Date: 22/11/17
 * Time: 17:13
 */
class ListeGateway
{
    private static $con;

    public static function setConnection()
    {
        global $dsn, $user, $pass;
        self::$con = new Connection($dsn, $user, $pass);
    }



    public static function insert(string $nom) {
        self::setConnection();


        $query = "INSERT INTO Liste VALUES (:id, :nom)";
        $args = array(
            ':id' => array(null, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
        );


        self::$con->executeQuery($query, $args);
    }


    public static function findall() : array {
        self::setConnection();

        self::$con->executeQuery("SELECT * FROM Liste", array());

        $res = self::$con->getResults();

        foreach ($res as $row) {
            $lists[] = new Liste($row['id'], $row['nom']);
        }

        return $lists;
    }

    public static function findById(int $id) {
        self::setConnection();


        self::$con->executeQuery("SELECT * FROM Liste where id=:id",  array(
            ':id' => array($id, PDO::PARAM_INT),
        ));

        $res = self::$con->getResults();
        return new Liste($res[0]['id'], $res[0]['nom']);
    }

}