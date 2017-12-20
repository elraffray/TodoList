<!DOCTYPE html>
<html lang="en">
<head>
    <title>Erreur</title>
    <style> p {text-align: center;
               color: #aaaaaa;}</style>
</head>
<body background="errer.jpg">
<?php
global $dVueEreur;

foreach($dVueEreur as $erreur) {
    print "<p>".$erreur."</p>"."<br><br>";
}
?>
</body>

</html>