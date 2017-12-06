<?php
/**
 * Created by PhpStorm.
 * User: elone
 * Date: 12/6/17
 * Time: 4:42 PM
 */

class UserControleur extends Controleur
{
    function __construct() {
        global $rep, $vues; // nécessaire pour utiliser variables globales


        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            switch ($action) {


                case "ajoutListePrive":
                    $this->ajoutListePrive();
                    break;

                case "supprListePrive":
                    $this->supprListePrive();
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

    }




}