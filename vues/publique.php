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
                                    print "<li> <a href=\"$href\">" . $liste->getNom() . "</a> </li>";
                                }
                            }
                        ?>

                        <li id="liAjoutListePublique">
                            <div id="ajoutListePublique">
                                <form action="" method="post">
                                    <input type="text" name="nom" placeholder="Ajouter"/>
                                    <input type="submit" value="Valider" />

                                    <input type="hidden" name="action" value="ajoutListePublique">
                                </form>
                            </div>

                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Privé</a>
                    <ul>
                        <?php
                        if (isset($listsPrivees)) {
                            foreach ($listsPrivees as $liste) {
                                print "<li> <a href=\"#\">$liste->nom</a> </li>";
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

                <ul class="list-group">

                    <?php
                    if (isset($taches)) {
                        foreach ($list->getTaches() as $tache) {
                            ?>
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <?php

                                    print "<h4 class='mb-1'>" . $tache->getNom() . "</h4>";
                                    print "<h5 class='mb-1'>" . $tache->getDescription() . "</h5>";
                                    print "<small>" . $tache->getDateAjout() . "</small>";
                                    ?>
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
                                <input type="hidden" name="idListe" value=<?php echo htmlspecialchars($list->getId()); ?>>
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