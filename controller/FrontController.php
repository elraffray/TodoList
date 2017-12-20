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

        $actions=["ajoutListePublique", "ajoutTachePublique", "supprListePublique", "supprTachePublique", "completerTachePublique", "seConnecter", "connexion", "creerCompte"];
        $userActions=["seDeconnecter", "ajoutListePrivée", "ajoutTachePrivée", "supprListePrivée", "supprTachePrivée", "completerTachePrivée"];

        try
        {
            $action = $_REQUEST['action'];
            if ($action != null)
                $action = Validation::nettoyerString($action);
            $mdl = new ModeleUser();

            if ($action == null)
                new Controller();
            if (in_array($action, $userActions)) {
                if (!$mdl->isUser()) {

                    $_REQUEST['action'] = "seConnecter";
                    new Controller();
                } else {
                    new UserController();
                }
            }
            else if (in_array($action, $actions))
            {
                new Controller();
            }
        } catch(Exception $e)
        {
            $tabErreur[] = $e->getMessage();
			require($vues["erreur"]);
		}


        //fin
        exit(0);
    }


}