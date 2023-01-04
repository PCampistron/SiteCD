<?php
    session_start();

    if(isset($_POST['usr']) && isset($_POST['pwd']))
    {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['pwd'] = $_POST['pwd'];
    }

    if (isset($_POST['deconnexion']))
    {
        $_SESSION['user'] = "";
        $_SESSION['pwd'] = "";
    } 

    if($_POST['user'] == "admin" && $_POST['pwd'] == "pass")
    {
        echo "<form method='post'>";

        echo "<input type='button' name='deconnexion' value='Déco'> </input>";

        echo "</form>";
    }
    else
    {
        echo "<form method='post' action='connexion.php'>";

        echo "<p> Identifiant </p>";

        echo "<input type='text' name='user'> </input>";
    
        echo "<p> Mot de passe </p>";

        echo "<input type='text' name='pwd'> </input>";

        echo "<input type='submit' value='Connexion'> </input>";

        echo "</form>";
    }
?>