<?php
    session_start();

    $numCarte = $_POST['numCarte'];

    $moisExpi = $_POST['moisExpi'];
    
    $anneeExpi = $_POST['anneeExpi'];

    $codeSec = $_POST['codeSec'];

    if(ctype_digit($numCarte) && ctype_digit($codeSec) && ctype_digit($moisExpi) && ctype_digit($anneeExpi) && strlen($numCarte) == 16 && strlen($moisExpi) == 2 && strlen($anneeExpi) == 2 && strlen($codeSec) == 3)
    {
        echo "Paiement effectué !";

        $_SESSION['panier'] = array();

        echo "<a href='index.php'> Retourner à l'accueil </a>";
    }
    else
    {
        echo "Informations invalide";
        echo "<a href='panier.php'> Retourner au panier </a>";
    }
?>