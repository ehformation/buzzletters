<?php
$connexion = new mysqli("localhost", "root", "root", "buzzletters");
if ($connexion->connect_error) {
    die('Erreur de connexion à la base de données : '. $connexion->connect_error);
}
?>