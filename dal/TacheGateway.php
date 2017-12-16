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
        self::setConnection();


        if ($nom == "") return;

        $query = "INSERT INTO tache VALUES (:id, :idListe, :nom, :description, now(), :dateFin)";
        $args = array(
            ':id' => array(NULL, PDO::PARAM_INT),
            ':idListe' => array($idListe, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':dateFin' => array(NULL, PDO::PARAM_STR)
        );

        try {
            self::$con->executeQuery($query, $args);
        } catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }



    }


    public static function findAllByList(int $idListe) {
        self::setConnection();
        try {
            self::$con->executeQuery("SELECT * FROM tache where idListe=:idListe order by dateFin, dateAjout desc", array(
                ':idListe' => array($idListe, PDO::PARAM_INT),
            ));

            $res = self::$con->getResults();
        } catch (PDOException $e) {
            var_dump($e);
        }

        try {
            foreach ($res as $row) {
                $taches[] = new Tache($row['id'], $row['idListe'], $row['nom'], $row['description'], $row['dateAjout']);
                if ($row['dateFin'] != null) $taches[count($taches)-1]->setDateFin($row['dateFin']);
            }
        } catch (Exception $e) {
            var_dump($e);
        }
        return $taches;
    }

    public static function supprByIdAndList(int $idListe, int $idTache) {
        self::setConnection();

        try {
            self::$con->executeQuery("delete from tache where id=:id and idListe=:idListe", array(
                ':id' => array($idTache, PDO::PARAM_INT),
                ':idListe' => array($idListe, PDO::PARAM_INT),
            ));
        } catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

    public static function supprByList(int $idListe) {
        self::setConnection();

        try {
            self::$con->executeQuery("delete from tache where idListe=:idListe", array(
                ':idListe' => array($idListe, PDO::PARAM_INT),
            ));
        } catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }



    public static function CompleteByIdAndList($idListe, $idTache)
    {
        self::setConnection();

        try {
            self::$con->executeQuery("update tache set dateFin=now() where id=:id and idListe=:idListe", array(
                ':id' => array($idTache, PDO::PARAM_INT),
                ':idListe' => array($idListe, PDO::PARAM_INT),
            ));
        } catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }


}