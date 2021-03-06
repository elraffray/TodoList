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



    public static function insert(string $nom, string $username=null) {
        self::setConnection();

        if ($nom == "") return;

        $query = "INSERT INTO liste VALUES (:id, :nom, :username)";
        $args = array(
            ':id' => array(null, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':username' => array($username, PDO::PARAM_STR)
        );


        self::$con->executeQuery($query, $args);
    }


    public static function findAllPublique() : array {
        self::setConnection();

        self::$con->executeQuery("SELECT * FROM liste where username IS NULL", array());

        $res = self::$con->getResults();

        $lists = array();

        foreach ($res as $row) {
            $lists[] = new Liste($row['id'], $row['nom']);
        }

        return $lists;
    }


    public static function findByUser(string $username) : array {
        self::setConnection();

        self::$con->executeQuery("SELECT * FROM liste where username=:username", array(
            ':username' => array($username, PDO::PARAM_STR)
        ));

        $res = self::$con->getResults();

        $lists = array();
        foreach ($res as $row) {
            $lists[] = new Liste($row['id'], $row['nom']);
        }

        return $lists;
    }


    public static function findById(int $id) : Liste {
        self::setConnection();


        self::$con->executeQuery("SELECT id, nom FROM liste where id=:id",  array(
            ':id' => array($id, PDO::PARAM_INT),
        ));

        $res = self::$con->getResults();

        if (count($res) > 0)
            return new Liste($res[0]['id'], $res[0]['nom']);
        else return new Liste(-1, "");
    }


    public static function supprById(int $id) {
        self::setConnection();

        try {

            TacheGateway::supprByList($id);

            self::$con->executeQuery("DELETE FROM liste where id=:id", array(
                ':id' => array($id, PDO::PARAM_INT),
            ));
        } catch(PDOException $e) {
            var_dump($e);
        }
    }

    public static function getUserNameById(int $id) : string {
        self::setConnection();


        self::$con->executeQuery("SELECT * FROM liste where id=:id",  array(
            ':id' => array($id, PDO::PARAM_INT),
        ));

        $res = self::$con->getResults();

        $s = $res[0]['username'];
        if ($s == null)
            $s = "";
        return $s;
    }


    public static function isPrivate(int $id) : bool {
        $username = self::getUserNameById($id);
        if ($username != "" && $username != null)
            return true;
        return false;
    }




}