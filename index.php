<?php
    $dbname='dsokhna_bd'; // Nom de la base de données
    $dsn="mysql:host=lakartxela;dbname=$dbname";
    $user ='dsokhna_bd';
    $pass='dsokhna_bd';

    $size_output = 100;


    $db = new PDO($dsn, $user, $pass);

    $requete = $db->prepare("SELECT titre, auteur, prix, lienImage FROM CD ORDER BY titre");

    $requete->execute();
    $resultat=$requete->fetchAll();

    foreach($resultat AS $row)
    {
        $text = $row['titre'] . " - " . $row['auteur'] . " - " . $row['prix'] . "<BR>";

        $url = $row['lienImage'];

        echo "<img src='$url" . "R.jpg'>";

        echo $text;
    }

?>