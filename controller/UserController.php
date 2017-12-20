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
        global $dVueEreur;

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
        try {
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales
            $idListe = $_REQUEST['idListe'];
            $idListe = Validation::nettoyerInt($idListe);

            if (ListeGateway::getUserNameById($idListe) == $_SESSION['username'])
                return true;
            return false;
        }
        catch(Exception $e){
            $dVueEreur[] = "erreur completer Tache";
            require($rep . $vues['erreur RightUser']);
        }
        catch (Error $t){
            $dVueEreur[] = "erreur RightUser";
            require($rep . $vues['erreur']);
        }
    }

    private function ajoutListePrive()
    {
        try {
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales

            $nom = $_POST['nom'];
            $nom = Validation::nettoyerString($nom);

            ListeGateway::insert($nom, $_SESSION['username']);

            parent::accueil();
        }
        catch(Exception $e){
                $dVueEreur[] = "erreur ajout liste prive";
                require($rep . $vues['erreur']);
            }
        catch (Error $t){
                $dVueEreur[] = "erreur ajout liste prive";
                require($rep . $vues['erreur']);
            }
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
        unset($_REQUEST['id']);
        unset($id);
        parent::accueil();
    }




}