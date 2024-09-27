<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzzletters Admin - Stats</title>
</head>
<body>
    <?php if(isLoggedIn()) : 
        require 'connect.php';
        $result = $connexion->query("SELECT COUNT(*) AS total_abonnes FROM subscribers");
        $stat_nbr_abonnes = $result->fetch_assoc();
        echo "Nombre d'abonnes :" . $stat_nbr_abonnes["total_abonnes"] . " abonnés";
        ?>
    <?php endif; ?>
</body>
</html>