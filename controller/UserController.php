<?php
/**
 * Created by PhpStorm.
 * User: elone
 * Date: 12/6/17
 * Time: 4:42 PM
 */

class UserController extends Controller
{
    function __construct() {
        global $rep, $vues; // nécessaire pour utiliser variables globales


        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            switch ($action) {


                case "ajoutListePrivée":
                    $this->ajoutListePrive();
                    break;
                case "supprListePrivée":
                    print "eee";
                    $this->supprListePrive();
                    break;

                case "ajoutTachePrivée":
                    $this->ajoutTachePrive();
                    break;
                case "supprTachePrivée":
                    $this->supprTachePrive();
                    break;

                case "completerTachePrivée":
                    $this->completerTachePrive();
                    break;

                case "seDeconnecter":
                    $this->seDeconnecter();

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

    private function isRightUser() : bool
    {
        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        if (ListeGateway::getUserNameById($idListe) == $_SESSION['username'])
            return true;
        return false;
    }

    private function ajoutListePrive()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $nom = $_POST['nom'];
        $nom = Validation::nettoyerString($nom);

        ListeGateway::insert($nom, $_SESSION['username']);

        $this->accueil();
    }

    private function supprListePrive()
    {
        if ($this->isRightUser())
            parent::supprListe();
    }

    private function ajoutTachePrive()
    {
        if ($this->isRightUser())
            parent::ajoutTache();
    }

    private function supprTachePrive()
    {
        if ($this->isRightUser())
            parent::supprTache();
    }

    private function completerTachePrive()
    {
        if ($this->isRightUser())
            parent::completerTache();
    }

    private function seDeconnecter() {
        $mdl = new ModeleUser();

        $mdl->deconnexion();
        parent::accueil();
    }


}