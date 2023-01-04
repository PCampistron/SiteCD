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

    

        if (isset($_POST['viderPanier']))
        {
            $_SESSION['panier'] = array();
        } 

        if ($_SESSION['panier'] == NULL)
        {
            echo "<BR>";
            echo "<div class= vide>";
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
                ob_start();
                echo "<div class= 'libelle'";
                echo "<div class='titre'";
                $textT = $row['titre'];
                echo "</div>";
                echo "<div class='auteur'";
                $textA = " - " . $row['auteur'];
                echo "</div>";
                echo "<div class='prix'";
                
                echo "</div>";
            echo "</div>";
            $url = $row['lienImage'];
            echo "<BR>";
        

            echo "<a href='cd.php?link=" . $row['id'] . "'>";

            echo "<img src='$url" . "R.jpg'>";

            echo $textT, $textA, $textP;

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