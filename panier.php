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
    <title>Panier</title>
</head>
<body>
    <?php

        include "conn.php";
        
        echo "<div class ='navbar'>";
        include "menu.php";
        echo "</div>";

        echo "<BR>";

    include "conn.php";
    
    if (isset($_POST['viderPanier']) || !isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = array();
    } 

    if ($_SESSION['panier'] == NULL)
    {
        echo "<div class='vide'>";
        echo "Votre Panier est vide.";
        echo "</div>";
    }

    $prixTotal = 0;


        foreach($_SESSION["panier"] AS $id)
        {
            $requete = $db->prepare("SELECT * FROM CD WHERE id = $id");

            $requete->execute();
            $resultat=$requete->fetchAll();



            foreach($resultat AS $row)
            {
                 
        
                echo "<div class= 'libelle'>";

                    echo "<a href='cd.php?link=" . $row['id'] . "'>";
                    $url = $row['lienImage'];
                    echo "<img src='$url" . "R.jpg'>";

                    echo "<div class='titre'>";
                    $textT = $row['titre'];
                    echo "<p> $textT </p>";
                    echo "</div>";

                    echo "<div class='auteur'>";
                    $textA = $row['auteur'];
                    echo "<p> $textA </p>";
                    echo "</div>";

                    echo "<div class='prix'>";
                    $textP = $row['prix'];
                    echo "<p> $textP </p>";
                    echo "</div>";
                    echo "</a>";

                echo "</div>";
            



            echo "<BR>";

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