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
    
    <div class="parent">

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

            echo "</a>";
            
            
        }

    ?>

    </div>

</body>
</html>

