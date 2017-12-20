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
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales
            $listsPubliques = ListeGateway::findAllPublique();
            $mdl = new ModeleUser();
            if ($mdl->isUser()) {
                $listsPrivees = ListeGateway::findByUser($_SESSION['username']);

            } else
                unset($listsPrivees);

            if (isset($_REQUEST['p']))
                $p = $_REQUEST['p'];
            else
                $p = 1;
            if (isset($_REQUEST['id']))
                $id = $_REQUEST['id'];

            if (isset($id)) {
                $id = Validation::nettoyerInt(null);
                $list = ListeGateway::findById($id);
                $p = Validation::nettoyerInt($p);
                if ($p < 1)
                    $p = 1;

                $taches = TacheGateway::findLimitByList($id, $p-1, 2);
                //$taches = TacheGateway::findAllByList($id);
                $pmax = ceil(TacheGateway::getNumberOfTache($id)/2);
                if ($taches != null) {
                    $list->setTaches($taches);
                }
            }
            require($rep . $vues['publique']);


        } catch (Error $e) {
            $dVueEreur[] = "erreur accueil ".$e->getMessage();
            require($rep . $vues['erreur']);
        }
        catch(Exception $e){
            $dVueEreur[] = "erreur accueil";
            require($rep . $vues['erreur']);
        }


    }



    function ajoutListePublique()
    {
        global $dVueEreur;
        global $rep, $vues; // nécessaire pour utiliser variables globales
        try {
            $nom = $_POST['nom'];
            $nom = Validation::nettoyerString($nom);

            ListeGateway::insert($nom);

            $this->accueil();
        }
        catch (Error $t){
            $dVueEreur[] = "erreur ajout liste";
            require($rep . $vues['erreur']);
        }
        catch(Exception $e){
            $dVueEreur[] = "erreur ajout liste";
            require($rep . $vues['erreur']);
        }
    }


    function ajoutTache()
    {
        try {
            global $dVueEreur;
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
        catch (Error $t){
            $dVueEreur[] = "erreur ajout Tache";
            require($rep . $vues['erreur']);
        }
        catch(Exception $e){
            $dVueEreur[] = "erreur ajout Tache";
            require($rep . $vues['erreur']);
        }
    }


    function supprListe() {

        try {
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales
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
        catch (Exception$e){
            $dVueEreur[] = "erreur suppr Liste";
            require($rep . $vues['erreur']);
        }
        catch (Error $t){
            $dVueEreur[] = "erreur suppr Liste";
            require($rep . $vues['erreur']);
        }
    }


    function supprTache()
    {
        try {
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales
            $idListe = $_REQUEST['idListe'];
            $idListe = Validation::nettoyerInt($idListe);

            $idTache = $_POST['idTache'];

            $idTache = Validation::nettoyerInt($idTache);

            TacheGateway::supprByIdAndList($idListe, $idTache);

            $_REQUEST['id'] = $idListe;
            $this->accueil();
        }
        catch (Exception $e){
            $dVueEreur[] = "erreur suppr Tache";
            require($rep . $vues['erreur']);
        }
        catch (Error $t){
            $dVueEreur[] = "erreur suppr Tache";
            require($rep . $vues['erreur']);
        }
    }

    function completerTache()
    {
        try {
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales
            $idListe = $_REQUEST['idListe'];
            $idListe = Validation::nettoyerInt($idListe);

            $idTache = $_POST['idTache'];

            $idTache = Validation::nettoyerInt($idTache);

            TacheGateway::CompleteByIdAndList($idListe, $idTache);

            $_REQUEST['id'] = $idListe;
            $this->accueil();
        }
        catch(Exception $e){
            $dVueEreur[] = "erreur completer Tache";
            require($rep . $vues['erreur']);
        }
        catch (Error $t){
            $dVueEreur[] = "erreur completer Tache";
            require($rep . $vues['erreur']);
        }
    }

    private function seConnecter()
    {
        try {
            global $dVueEreur;
            global $rep, $vues; // nécessaire pour utiliser variables globales

            $mdl = new ModeleUser();

            $dVueEreur = array();

            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];

            $username = Validation::nettoyerString($username);
            $password = Validation::nettoyerString($password);

            if ($mdl->connexion($username, $password)) {
                unset($_REQUEST['id']);
                $this->accueil();
            } else {
                $dVueEreur[] = "erreur mauvais mot de passe";
                require($rep . $vues['erreur']);
            }
        }
        catch (Exception $e){
            $dVueEreur[] = "erreur se connecter";
            require($rep . $vues['erreur']);
        }
        catch (Error $t){
            $dVueEreur[] = "erreur se connecter";
            require($rep . $vues['erreur']);
        }

    }

    private function connexion()
    {
        try {
            global $rep, $vues; // nécessaire pour utiliser variables globales
            global $dVueEreur;

            $dVueEreur = array();


            $listsPubliques = ListeGateway::findAllPublique();

            require($rep . $vues['login']);
        }
        catch (Exception $e){
            $dVueEreur[] = "erreur connexion";
            require($rep . $vues['erreur']);
        }
    }

}//fin class

?>
