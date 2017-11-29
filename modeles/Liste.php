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


    public function getId() {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }


    public function getNom() {
        return $this->nom;
    }
    public function setNom(string $nom) {
        $this->nom = $nom;
    }


    public function __construct(int $id, string $nom) {
        $this->id = $id;
        $this->nom = $nom;

    }
}