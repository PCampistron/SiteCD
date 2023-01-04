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
    
        include "conn.php";

        echo "<div class ='navbar'>";
        include "menu.php";
        echo "</div>";

        $size_output = 100;

        $requete = $db->prepare("SELECT id, titre, auteur, prix, lienImage FROM CD ORDER BY titre");

        $requete->execute();
        $resultat=$requete->fetchAll();

        foreach($resultat AS $row)
        {
        
            echo "<a href='cd.php?link=" . $row['id'] . "'>";
                echo "<div class='cd'>";
                    $url = $row['lienImage'];
                    echo "<img src='$url" . "R.jpg' class= 'imageCD' >";
                    
                    $textT = $row['titre'];
                    echo "<p> $textT </p>";
                    $textA = $row['auteur'];
                    echo "<p> $textA </p>";

                    $textP = $row['prix'];
                    echo "<p> $textP </p>";

                echo "</div>";
            
            echo "</a>";
            
        }

    ?>

</body>
</html>

