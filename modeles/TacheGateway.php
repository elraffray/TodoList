<?php

/**
 * Created by PhpStorm.
 * User: elraffray
 * Date: 15/11/17
 * Time: 16:48
 */
class TacheGateway
{

    private static $con;

    public static function setConnection()
    {
        global $dsn, $user, $pass;
        self::$con = new Connection($dsn, $user, $pass);
    }



    public static function insert(int $idListe, string $nom, string $description) {

        $query = "INSERT INTO Tache VALUES (:id, :idListe, :nom, :description, :dateAjout, :dateFin)";
        $args = array(
            ':id' => array(NULL, PDO::PARAM_INT),
            ':idListe' => array($idListe, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':dateAjout' => array(date("d-m-Y h:i:s"), PDO::PARAM_STR),
            ':dateFin' => array(NULL, PDO::PARAM_STR)
        );

        try {
            self::$con->executeQuery($query, $args);
        } catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }

        echo aaa;


    }


    public static function findAllByList(int $idListe) {
        self::setConnection();


        self::$con->executeQuery("SELECT * FROM Tache where idListe=:idListe",  array(
            ':idListe' => array($idListe, PDO::PARAM_INT),
        ));

        $res = self::$con->getResults();

        foreach ($res as $row) {
            $taches[] = new Tache($row['id'], $row['idListe'], $row['nom'], $row['description'], $row['dateAjout']);
        }
        return $taches;
    }

}