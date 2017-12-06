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
                                            print "<form method=\"post\" class='supprListePublique'>";
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

                        <li id="liAjoutListePublique" >
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
                <li>
                    <a href="#">Privé</a>
                    <ul>
                        <?php
                        if (isset($listsPrivees)) {
                            foreach ($listsPrivees as $liste) {
                                print "<li> <a href=\"#\">$liste->getNom()</a> </li>";
                            }
                        }
                        ?>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <?php
                if (isset($list)) {
                print "<h1>" . $list->getNom() . "</h1>";
                ?>

                <ul class="list-group" id="taches">

                    <?php
                    if (isset($taches)) {
                        foreach ($list->getTaches() as $tache) {
                            ?>
                            <li class="list-group-item <?php if ($tache->getDateFin() != null) echo "disabled"; ?>">
                                <div class="row tache" style="width: 100%; padding: 0">
                                    <div class="col-sm-11">
                                        <?php

                                        print "<h4 class='mb-1'>" . $tache->getNom() . "</h4>";
                                        print "<h5 class='mb-1'>" . $tache->getDescription() . "</h5>";
                                        print "<p><small>" . $tache->getDateAjout() . "</small>";
                                        if ($tache->getDateFin() != null) print "<small>" . "  --  " . $tache->getDateFin() . "</small>";
                                        print "</p>";
                                        ?>
                                    </div>
                                    <div class="col-sm-1 tacheAction">
                                            <form method="post" style="width: 25px;">
                                                <button class="tacheBtn btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"/></button>
                                                <input type="hidden" name="action" value="supprTachePublique">
                                                <input type="hidden" name="idListe" value=<?php echo htmlspecialchars($tache->getIdListe()) ?>>
                                                <input type="hidden" name="idTache" value=<?php echo htmlspecialchars($tache->getId()) ?>>
                                            </form>
                                            <?php
                                            if ($tache->getDateFin() == null) {
                                                print '<form method="post" style="width: 25px">';
                                                    print "<button class=\"tacheBtn btn btn-primary\" type=\"submit\"><span class=\"glyphicon glyphicon-ok\"/></button>";
                                                    print "<input type=\"hidden\" name=\"action\" value=\"completerTachePublique\">";
                                                    print "<input type=\"hidden\" name=\"idListe\" value=" . $tache->getIdListe() . ">";
                                                    print "<input type=\"hidden\" name=\"idTache\" value=" . $tache->getId() . ">";
                                                print "</form>";
                                            }
                                            ?>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }

                    ?>
                    <li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <form action="" method="post" id="newTache">
                                <input type="text" name="nom" placeholder="Tache"/>
                                <textarea name="desc" form="newTache" placeholder="Description"></textarea>
                                <input type="submit" value="Valider"/>

                                <input type="hidden" name="action" value="ajoutTachePublique">
                                <input type="hidden" name="idListe" value=<?php echo htmlspecialchars($list->getId()) ?>>
                            </form>
                        </div>
                    </li>
                    <?php
                }
                    ?>

                </ul>
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>

</body>
</html>