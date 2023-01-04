<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <?php

    include "menu.php";

    include "conn.php";
    
    if (isset($_POST['viderPanier']) || !isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = array();
    } 

    if ($_SESSION['panier'] == NULL)
    {
        echo "panier vide";
    }

    $prixTotal = 0;

    foreach($_SESSION["panier"] AS $id)
    {
        $requete = $db->prepare("SELECT * FROM CD WHERE id = $id");

        $requete->execute();
        $resultat=$requete->fetchAll();

        foreach($resultat AS $row)
        {
            ob_start();
            $text = $row['titre'] . " - " . $row['auteur'] . " - " . $row['genre'] . " - " . $row['prix'] . "<BR>";

            $url = $row['lienImage'];

            echo "<img src='$url" . "R.jpg'>";

            echo $text;

            $prixTotal += $row['prix'];
        }
    }

    if ($_SESSION['panier'] != NULL)
    {
        echo "Prix total : " . $prixTotal . "€";

        echo "<form method='post'  action='panier.php'>";

        echo "<input type='submit' name='viderPanier' id='viderP' value='Vider le panier'>";

        echo "</form>";

        include "sectionpaiement.php";
    }

    
    ?>
</body>
</html>