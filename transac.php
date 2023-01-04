<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
</head>
<body>
<?php

    $numCarte = $_POST['numCarte'];

    $moisExpi = $_POST['moisExpi'];
    
    $anneeExpi = $_POST['anneeExpi'];

    $codeSec = $_POST['codeSec'];

    if(ctype_digit($numCarte) && ctype_digit($codeSec) && ctype_digit($moisExpi) && ctype_digit($anneeExpi) && strlen($numCarte) == 16 && strlen($moisExpi) == 2 && strlen($anneeExpi) == 2 && strlen($codeSec) == 3)
    {
        echo "<div class= 'valide'>";
        echo "Paiement effectué avec succés !";
        echo "</div>";
        echo "<BR>";

        $_SESSION['panier'] = array();

    }
    else
    {
        echo "<div class= 'invalide'>";
        echo "Informations invalide :(";
        echo "</div>";
        echo "<BR>";
    }
    echo "<div class= 'accueil'>";
    echo "<a href='index.php'> --->  Retourner à l'accueil </a>";
    echo "</div>";
?>
</body>
</html>