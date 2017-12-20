<?php

/**
 * Created by PhpStorm.
 * User: elraffray
 * Date: 22/11/17
 * Time: 17:12
 */
class Liste
{

    private $id;
    private $nom;

    private $taches;


    public function __construct(int $id, string $nom) {
        $this->id = $id;
        $this->nom = $nom;
        $this->taches = array();
    }



    public function getId() : int {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }

    public function setTaches(array $taches) {
        $this->taches = $taches;
    }
    public function getTaches() : array {
        return $this->taches;
    }


    public function getNom() : string {
        return $this->nom;
    }
    public function setNom(string $nom) {
        $this->nom = $nom;
    }


}