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

                case "ajoutTachePublique":
                    $this->ajoutTachePublique();
                    break;

                case "supprListePublique":
                    $this->supprListePublique();
                    break;

                case "supprTachePublique":
                    $this->supprTachePublique();
                    break;


                case "completerTachePublique":
                    $this->completerTachePublique();
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
    }//fin constructeur


    function accueil()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $listsPubliques = ListeGateway::findall();


        $id = $_REQUEST['id'];
        if (isset($id)) {
            $id = Validation::nettoyerInt($id);
            $list = ListeGateway::findById($id);
            $taches = TacheGateway::findAllByList($id);
            if ($taches != null) {
                $list->setTaches($taches);
            }
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


    function ajoutTachePublique()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $nom = $_POST['nom'];
        $nom = Validation::nettoyerString($nom);

        $desc = $_POST['desc'];
        $desc = Validation::nettoyerString($desc);


        $idListe = $_POST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        TacheGateway::insert($idListe, $nom, $desc);
        $this->accueil();
    }


    function supprListePublique() {
        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        $id = $_REQUEST['id'];
        $id = Validation::nettoyerInt($id);

        if ($id == $idListe)
            $_REQUEST['id'] = null;

        ListeGateway::supprById($idListe);
        $this->accueil();
    }


    function supprTachePublique()
    {

        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        $idTache = $_POST['idTache'];

        $idTache = Validation::nettoyerInt($idTache);

        TacheGateway::supprByIdAndList($idListe, $idTache);

        $_REQUEST['id'] = $idListe;
        $this->accueil();
    }

    function completerTachePublique()
    {
        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        $idTache = $_POST['idTache'];

        $idTache = Validation::nettoyerInt($idTache);

        TacheGateway::CompleteByIdAndList($idListe, $idTache);

        $_REQUEST['id'] = $idListe;
        $this->accueil();
    }

}//fin class

?>
