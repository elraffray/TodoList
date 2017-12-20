<!DOCTYPE html>
<html lang="en">
<head>
    <title>Todo List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="styles/sidebar.css">
    <link rel="stylesheet" type="text/css" href="styles/index.css">
</head>
<body>

<div id="wrapper ">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Todo List
                </a>
            </li>
            <li>
                <a href="#">Publique</a>
                <ul>

                    <?php
                    if (isset($listsPubliques)) {
                        foreach ($listsPubliques as $liste) {
                            $href = "index.php?id=" . $liste->getId();
                            print "<li >";
                            print "<a href=\"$href\" class=\"listeA\">";
                            print "<div class=\"liste\">";
                            print "<p>" . $liste->getNom() . "</p>";
                            print "<form method=\"post\" class='supprListe'>";
                            print "<button class=\"btn btn-danger\" type=\"submit\">";
                            print "<span class=\"glyphicon glyphicon-trash\"/>";
                            print "</button>";
                            print "<input type=\"hidden\" name=\"idListe\" value=" . $liste->getId() . "\">";
                            print "<input type=\"hidden\" name=\"action\" value=\"supprListePublique\">";
                            print "</form>";
                            print "</div>";
                            print "</a>";
                            print "</li>";
                        }
                    }
                    ?>

                    <li class="liAjoutListe" >
                        <form action="" method="post" class="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="nom" placeholder="Ajouter">
                                <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Go</button>
                                </span>
                            </div>
                            <input type="hidden" name="action" value="ajoutListePublique">
                        </form>
                    </li>
                </ul>
            </li>
            <br>
            <br>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <form method="post">
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input name="username" type="text" class="form-control" id="usr">
                    <label for="pwd">Password:</label>
                    <input name="password" type="password" class="form-control" id="pwd">
                    <button class="btn btn-primary" type="submit" name="action" value="seConnecter">Se Connecter</button>
                    <button class="btn btn-primary" type="submit" name="action" value="creerCompte">S'inscrire</button>
                </div>
            </form>
        </div>
        <!-- /#page-content-wrapper -->

    </div>

</body>
</html>