<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>tp1</title>

</head>
<body>
<header>





        <?php
           /* $num =1;
            $nom = "Aurélien DOUARD";
            $groupe = 5;
            $date = date("d/m/Y");
            print("Aujourd'hui: $date nous travaillons sur le TP numéro $num réalisé par $nom du groupe $groupe");
            $TMessage=["division par zero","valeur invalide"];
            require ('erreur.php');
            function pourcentageAvis(string $typeAvis,int $nbAvisFav,int $nbAvisDefav):string{
                $inter=$nbAvisFav+$nbAvisDefav;
                $res=100/($inter/$nbAvisFav);
                if ($typeAvis == "favorable") {
                    echo $res;
                }
                else echo 100-$res;
                return "ok";
            }
            pourcentageAvis("favorable",10,40);
            require ('Personne.php');
            $p[0] = new Personne("alber","durand",1990,"sdfsdfsd@gg");
            $p[1] = new Personne("didier","dupon",1950,"sdfsdfsd@gg");
            $p[2] = new Personne("roger","riri",1997,"sdfsdfsd@gg");
            $p[3] = new Personne("jean","arle",1987,"sdfsdfsd@gg");
            $p[4] = new Personne("tom","rix",1999,"sdfsdfsd@gg");*/


            require_once("dal/Connection.php");

            //A CHANGER
            $user= 'elraffray';
            $pass='elraffray';
            $dsn='mysql:host=hina;dbname=dbelraffray';
            try{
                $con=new Connection($dsn,$user,$pass);

                 $query = "SELECT * FROM Tache WHERE id=:id";
                 $query = "INSERT INTO Tache VALUE(:id,:nom, :description)";

               /* echo $con->executeQuery($query, array(':id' => array(1, PDO::PARAM_INT),
                                                      ':nom' => array("dupond", PDO::PARAM_STR),
                                                      ':description' => array("coucou", PDO::PARAM_STR)));
                 //echo $con->executeQuery($query, array(':id' => array(1, PDO::PARAM_INT) ) );*/
                if (isset($_POST)){
                    echo $con->executeQuery($query, array(':id' => array($_POST['id'], PDO::PARAM_INT),
                        ':nom' => array($_POST['nom'], PDO::PARAM_STR),
                        ':description' => array($_POST['description'], PDO::PARAM_STR)));
                }

                $results=$con->getResults();
                  Foreach ($results as $row)
                       print $row['titre'];


             }
            catch( PDOException $Exception ) {
                 echo 'erreur';
                 echo $Exception->getMessage();}





        ?>

</header>



</body>
</html>