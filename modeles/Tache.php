<?php

/**
 * Created by PhpStorm.
 * User: elraffray
 * Date: 15/11/17
 * Time: 16:38
 */

//$date = date(Y-m-d H:i:s)




class Tache
{

    private $id;
    private $idListe;
    private $nom;
    private $description;
    private $dateAjout;
    private $dateFin;


    public function getId() {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getIdListe() {
        return $this->idListe;
    }
    public function setIdListe(int $idListe) {
        $this->idListe = $idListe;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function getDescription() {
        return $this->description;
    }
    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getDateAjout() {
        return $this->dateAjout;
    }
    public function setDateAjout(string $dateAjout) {
        $this->dateAjout = $dateAjout;
    }

    public function getDateFin() {
        return $this->dateFin;
    }
    public function setDateFin(string $dateFin) {
        $this->dateFin = $dateFin;
    }


    public function __construct(int $id, int $idListe, string $nom, string $description, string $dateAjout) {
        $this->id = $id;
        $this->idListe = $idListe;
        $this->nom = $nom;
        $this->description = $description;
        $this->dateAjout = $dateAjout;

    }


}