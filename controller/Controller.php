<?php

class Controller
{

    function __construct()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales


        //debut

        //on initialise un tableau d'erreur
        global $dVueEreur;

        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            switch ($action) {

                //pas d'action, on r�initialise 1er appel
                case NULL:

                    $this->accueil();
                    break;

                case "connexion":
                    $this->connexion();
                    break;

                case "ajoutListePublique":
                    $this->ajoutListePublique();
                    break;

                case "ajoutTachePublique":
                    $this->ajoutTache();
                    break;

                case "supprListePublique":
                    $this->supprListe();
                    break;

                case "supprTachePublique":
                    $this->supprTache();
                    break;


                case "completerTachePublique":
                    $this->completerTache();
                    break;

                case "seConnecter":
                    $this->seConnecter();
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

        try {
            global $rep, $vues; // nécessaire pour utiliser variables globales
            $listsPubliques = ListeGateway::findAllPublique();
            $mdl = new ModeleUser();
            if ($mdl->isUser()) {
                $listsPrivees = ListeGateway::findByUser($_SESSION['username']);
            } else
                unset($listsPrivees);

            $id = $_REQUEST['id'];
            $p = $_REQUEST['p'];
            if (isset($id)) {
                $id = Validation::nettoyerInt($id);
                $list = ListeGateway::findById($id);
                $p = Validation::nettoyerInt($p);
                if (!isset($p))
                    $p = 1;
                else if ($p < 1)
                    $p = 1;
                $taches = TacheGateway::findLimitByList($id, $p-1, 2);
                //$pmax = TacheGateway::getNumberOfTache($id)/2;
                if ($taches != null) {
                    $list->setTaches($taches);
                }
            }
            require($rep . $vues['publique']);


        } catch (Exception $e) {
            var_dump($e);
        }
    }



    function ajoutListePublique()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $nom = $_POST['nom'];
        $nom = Validation::nettoyerString($nom);

        ListeGateway::insert($nom);

        $this->accueil();
    }


    function ajoutTache()
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


    function supprListe() {
        $idListe = $_REQUEST['idListe'];

        $idListe = Validation::nettoyerInt($idListe);

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $id = Validation::nettoyerInt($id);

            if ($id == $idListe)
                $_REQUEST['id'] = null;
        }

        ListeGateway::supprById($idListe);
        $this->accueil();
    }


    function supprTache()
    {

        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        $idTache = $_POST['idTache'];

        $idTache = Validation::nettoyerInt($idTache);

        TacheGateway::supprByIdAndList($idListe, $idTache);

        $_REQUEST['id'] = $idListe;
        $this->accueil();
    }

    function completerTache()
    {
        $idListe = $_REQUEST['idListe'];
        $idListe = Validation::nettoyerInt($idListe);

        $idTache = $_POST['idTache'];

        $idTache = Validation::nettoyerInt($idTache);

        TacheGateway::CompleteByIdAndList($idListe, $idTache);

        $_REQUEST['id'] = $idListe;
        $this->accueil();
    }

    private function seConnecter()
    {
        global $dVueEreur;
        global $rep, $vues; // nécessaire pour utiliser variables globales

        $mdl = new ModeleUser();

        $dVueEreur = array();

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $username = Validation::nettoyerString($username);
        $password = Validation::nettoyerString($password);

        if ($mdl->connexion($username, $password)){
            unset($_REQUEST['id']);
            $this->accueil();
        }
        else {
            $dVueEreur[] = "erreur login";
            require($rep . $vues['erreur']);
    }

    }

    private function connexion()
    {
        global $rep, $vues; // nécessaire pour utiliser variables globales
        global $dVueEreur;

        $dVueEreur = array();


        $listsPubliques = ListeGateway::findAllPublique();

        require($rep . $vues['login']);
    }

}//fin class

?>
