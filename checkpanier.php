<?php
    
    if(_SESSION['panier'] == NULL)
    {
        echo "panier n'existe pas";
    }

    array_push($_SESSION['panier'], $id);

?>