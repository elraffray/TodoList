<?php
/**
 * Created by PhpStorm.
 * User: elone
 * Date: 12/6/17
 * Time: 4:05 PM
 */

class FrontController
{
    function __construct() {
        global $rep, $vues; // nécessaire pour utiliser variables globales


        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            switch ($action) {

                //pas d'action, on r�initialise 1er appel
                case NULL:
                    $c = new Controleur();
                    break;

                case "ajoutListePublique":
                    $c = new Controleur();
                    break;

                case "ajoutTache":
                    $this->checkUser();
                    break;

                case "supprListe":
                    $this->checkUser();
                    break;

                case "supprTache":
                    $this->checkUser();
                    break;


                case "completerTache":
                    $this->checkUser();
                    break;


                //mauvaise action
                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
                    break;
            }

        } catch (PDOException $e) {
            //si erreur BD, pas le cas ici
            $dVueEreur[] = $e;
            require($rep . $vues['erreur']);

        } catch (Exception $e2) {
            $dVueEreur[] = $e2;
            require($rep . $vues['erreur']);
        }


        //fin
        exit(0);
    }

    private function checkUser() {
        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        if (ListeGateway::isPrivate($idListe)) {
            $m = new ModeleUser();
            if (!$m->isUser()) {
                return;
            }
            if (!ListeGateway::findById($idListe)->getUsername() == $_SESSION['username']) {
                return;
            }
        }
        $c = new Controleur();
    }

}