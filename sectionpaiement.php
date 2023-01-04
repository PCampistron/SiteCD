<?php

    echo "<section id='panier'>";

        echo "<form method='post' action='transac.php'>";

            echo "<p> Numéro de carte </p>";

            echo "<input type='text' name='numCarte' size='12'> </input> ";

            echo "<p> Date d'expiration </p>";

            echo "<input type='text' name='moisExpi' size='2' placeholder='MM' </input> ";

            echo "<input type='text' name='anneeExpi' size='2' placeholder='AA'> </input> ";

            echo "<p> Code de sécurité </p>";

            echo "<input type='text' name='codeSec' size='3'> </input> ";

            echo "<input type='submit' value='Payer'>";

        echo "<form>";

    echo "</section>";

?>