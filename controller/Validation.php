<?php

/**
 * Created by PhpStorm.
 * User: elraffray
 * Date: 15/11/17
 * Time: 17:12
 */
class Validation
{

    public static function validTache(Tache $t) {
        $id = filter_var($t->getId(), FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_var($t->getNom(), FILTER_SANITIZE_STRING);
        $desc =  filter_var($t->getDescription(), FILTER_SANITIZE_STRING);

        if ($id != false) {
            $t->setId($id);
        }
        if ($nom != false) {
            $t->setNom($nom);
        }
        if ($desc != false) {
            $t->setDescription($desc);
        }
    }


    public static function nettoyerInt(int $n) : int {
        return filter_var($n, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function nettoyerString(string $s) : string {
        return filter_var($s, FILTER_SANITIZE_STRING);

    }

}