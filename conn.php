<?php
    $dbname='dsokhna_bd'; // Nom de la base de données
    $dsn="mysql:host=lakartxela;dbname=$dbname";
    $user ='dsokhna_bd';
    $pass='dsokhna_bd';

    $db = new PDO($dsn, $user, $pass);
?>