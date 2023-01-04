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
    <title>CD</title>
</head>
<body>
    

<?php
    include "conn.php";
    echo "<div class ='navbar'>";
    include "menu.php";
    echo "</div>";

    $id = $_GET['link'];

    $requete = $db->prepare("SELECT * FROM CD WHERE id = $id");

    $requete->execute();
    $resultat=$requete->fetchAll();

    foreach($resultat AS $row)
    {
        $text = $row['titre'] . " - " . $row['auteur'] . " - " . $row['prix'] . "<BR>";

        $url = $row['lienImage'];

        echo "<img src='$url" . ".jpg'>";

        echo $text;

        echo "<form method='post'>";

        echo "<input type='submit' name='ajoutPanier' id='ajoutP' value='Ajouter au panier'>";

        echo "</form>";
    
        if (isset($_POST['ajoutPanier']))
        {
            $_SESSION['panier'][] = $id;
        }

        
        
    }

?>



</body>
</html>


