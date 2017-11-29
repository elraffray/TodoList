<?php

/**
 * Created by PhpStorm.
 * User: elraffray
 * Date: 15/11/17
 * Time: 16:48
 */
class GatewayTache
{

    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }



    public function insert(int $id, int $idListe, string $nom, string $description, string $dateAjout) {
        $query = "INSERT INTO Tache VALUES (:id, :idListe, :nom, :description, :dateAjout)";
        $args = array(
            ':id' => array($id, PDO::PARAM_INT),
            ':idListe' => array($idListe, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':dateAjout' => array(date ("Y-m-d H:i:s", strtotime($dateAjout)), PDO::PARAM_STR)
        );


        $this->con->executeQuery($query, $args);
    }

}