<!DOCTYPE html>
<html lang="en">
<head>
    <title>Erreur</title>
</head>
<body>
<?php
global $dVueEreur;

foreach($dVueEreur as $erreur) {
    print $erreur."<br><br>";
}
?>
</body>

</html>