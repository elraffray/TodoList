<!DOCTYPE html>
<html lang="en">
<head>
    <title>Todo List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../styles/sidebar.css">
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

                        <li>
                            <a>test</a>
                        </li>
                        <?php
                            if (isset($listsPubliques)) {
                                foreach ($listsPubliques as $liste) {
                                    $href = $rep . "controleur/Controleur.php?id=$liste->id";
                                    print "<li> <a href=\"$href\">$liste->nom</a> </li>";
                                }
                            }
                        ?>

                        <li >
                            <div id="ajoutListePublique">
                                <form action="../controleur.php" method="post">
                                    <input type="text" name="nom"/>
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
                    print "<h1> $list->nom </h1>";
                }
                ?>
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>

</body>
</html> 