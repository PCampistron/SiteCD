<?php
    session_start();

    include "menu.php";
    include "conn.php";
    

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
        $id = $_POST['id'];
        $genre = $_POST['genre'];
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $prix = $_POST['prix'];

        $requete = "INSERT INTO CD (id, titre, auteur) VALUES ($id, $titre, $auteur)";

        $db->exec($requete);
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

        echo "<input type='text' name='pwd'> </input>";

        echo "<input type='submit' value='Connexion'> </input>";

        echo "</form>";
        
    }
    else if($_SESSION['connecte'] == 1)
    {
        echo "<form method='post'>";

        echo "<input type='submit' name='deconnexion' value='Déconnexion'> </input>";

        echo "</form>";

        echo "<form method='post'>";

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