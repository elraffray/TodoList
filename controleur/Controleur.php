<?php

class Controleur
{

    function __construct()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales


        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];

            switch ($action) {

                //pas d'action, on r�initialise 1er appel
                case NULL:
                    $this->accueil();
                    break;

                case "ajoutListePublique":
                    $this->ajoutListePublique();
                    break;

                //mauvaise action
                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
                    break;
            }

        } catch (PDOException $e) {
            //si erreur BD, pas le cas ici
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);

        } catch (Exception $e2) {
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);
        }


        //fin
        exit(0);
    }//fin constructeur


    function accueil()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $listsPubliques[] = ListeGateway::findall();

        $id = $_GET['id'];
        if (isset($id)) {
            $id = Validation::nettoyerInt($id);
            $list = ListeGateway::findById($id);
        }
        require($rep . $vues['publique']);
    }

    function ajoutListePublique()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $nom = $_POST['nom'];
        $nom = Validation::nettoyerString($nom);

        ListeGateway::insert($nom);

        $this->accueil();
    }

}//fin class

?>
