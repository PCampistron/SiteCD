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
    echo "<div class ='navbar'>";
        include "menu.php";
    echo "</div>";

    echo "<BR>";

    include "conn.php";
    
    $dest = "img/";

    


    if(!isset($_SESSION['user']) || !isset($_SESSION['pwd']) || !isset($_SESSION['connecte']))
    {
        $_SESSION['user'] = "";
        $_SESSION['pwd'] = "";
        $_SESSION['connecte'] = 0;
    }

    if(!isset($_POST['user']) || !isset($_POST['pwd']))
    {
        $_POST['user'] = "";
        $_POST['pwd'] = "";
    }
    

    if (isset($_POST['deconnexion']))
    {
        $_SESSION['user'] = "";
        $_SESSION['pwd'] = "";
        $_SESSION['connecte'] = 0;
    } 

    if (isset($_POST['inserer']))
    {
        if(!empty($_POST['id']) && !empty($_POST['genre']) && !empty($_POST['titre']) && !empty($_POST['auteur']) && !empty($_POST['prix']))
        {
            $id = $_POST['id'];
            $genre = $_POST['genre'];
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $prix = $_POST['prix'];

            $dest = getcwd();
            
            $name = $_FILES['imageCD']['name'];
            $temp_name = $_FILES['imageCD']['tmp_name'];

            if(is_uploaded_file($_FILES["imageCD"]['tmp_name']))
            {
                $finalPath = "img/";
                move_uploaded_file($temp_name, $finalPath.$name);
            }

            $image = $finalPath.$name;
            $size = 100;

            $im = imagecreatefromjpeg($image);
            $dest = imagecreatetruecolor($size, $size);

            imagecopyresampled($dest, $im, 0, 0, 0, 0, $size, $size, imagesx($im), imagesy($im));
            $nom = explode(".", $name);

            $nomR = $nom[0] . "R." . $nom[1];

            imagejpeg($dest, $finalPath.$nomR);

           

            $lien = $finalPath.$nom[0];

            var_dump($nom);


            $requete = $db->prepare("INSERT INTO CD (id, genre, titre, auteur, prix, lienImage) VALUES (:id, :genre, :titre, :auteur, :prix, :lienImage)");

            $requete->bindParam(':id', $id);
            $requete->bindParam(':titre', $titre);
            $requete->bindParam(':genre', $genre);
            $requete->bindParam(':prix', $prix);
            $requete->bindParam(':auteur', $auteur);
            $requete->bindParam(':lienImage', $lien);

            $requete->execute();
        }
        else
        {
            echo "Echec d'insertion";
        }

        
    } 

    if($_POST['user'] == "admin" && $_POST['pwd'] == "pass")
    {
        $_SESSION['connecte'] = 1;
    }

    if(isset( $_POST['supprimer'] ) && isset($_POST['id'])) {
        $cdId = $_POST['id'];
        $requete = $db->prepare("DELETE FROM CD WHERE id = $cdId");
        $requete->execute();
        $resultat=$requete->fetchAll();
    }

    if($_SESSION['connecte'] == 0)
    {
        echo "<form method='post' action='gestioncd.php'>";

        echo "<p> Identifiant </p>";

        echo "<input type='text' name='user'> </input>";
        
        echo "<p> Mot de passe </p>";

        echo "<input type='password' name='pwd'> </input>";

        echo "<input type='submit' value='Connexion'> </input>";

        echo "</form>";
        
    }
    else if($_SESSION['connecte'] == 1)
    {
        echo "<form method='post'>";

        echo "<input type='submit' name='deconnexion' value='Déconnexion'> </input>";

        echo "</form>";

        echo "<form method='post'  enctype='multipart/form-data' >";

        echo "<p> Id </p>";
        echo "<input type='text' name='id'> </input>";

        echo "<p> Titre </p>";
        echo "<input type='text' name='titre'> </input>";

        echo "<p> Artiste </p>";
        echo "<input type='text' name='auteur'> </input>";

        echo "<p> Genre </p>";
        echo "<input type='text' name='genre'> </input>";

        echo "<p> Prix </p>";
        echo "<input type='text' name='prix'> </input>";

        echo "<input type='file' name='imageCD' id='image'> </input>";

        echo "<input type='submit' name='inserer' value='Insérer'> </input>";

        echo "</form>";

        $requete = $db->prepare("SELECT id, titre, auteur, prix, lienImage FROM CD ORDER BY titre");

        $requete->execute();
        $resultat=$requete->fetchAll();

        echo "<form method='post'>";

        foreach($resultat AS $row)
        {
            echo "<div>";

            $text = $row['titre'] . " - " . $row['auteur'] . " - " . $row['prix'] . "<BR>";

            $url = $row['lienImage'];

            echo "<img src='$url" . "R.jpg'>";

            echo $text;

            echo "<form method='post'>";

            
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";

            echo "<input type='submit' value='Supprimer' name ='supprimer'> </input>";

            echo "</form>";

            echo "</div>";
        }

       
    }

    
?>