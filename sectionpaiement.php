<?php

    echo "<section id='panier'>";

        echo "<form method='post' action='transac.php'>";

            echo "<p> Numéro de carte </p>";

            echo "<input type='text' name='numCarte' maxlength='16' size='16'> </input> ";

            echo "<p> Date d'expiration </p>";

            echo "<input type='text' name='moisExpi' maxlength='2' size='2' placeholder='MM' </input> ";

            echo "<input type='text' name='anneeExpi' maxlength='2' size='2' placeholder='AA'> </input> ";

            echo "<p> Code de sécurité </p>";

            echo "<input type='password' name='codeSec' maxlength='3' size='3'> </input> ";

            echo "<input type='submit' value='Payer'>";

        echo "<form>";

    echo "</section>";

?>