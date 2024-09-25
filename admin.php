<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Buzzletters - Liste des abonnés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <table border="1">
            <tr>
                <th>Email</th>
                <th>Thème</th>
                <th>Action</th>
            </tr>

            <?php
                /* Etape 1 : Connexion a la base de données buzzletters */
                $connexion = new mysqli("localhost", "root", "root", "buzzletters");
                if ($connexion->connect_error) {
                    die('Erreur de connexion à la base de données : '. $connexion->connect_error);
                }

                /* Etape 2 : Requete pour récuperer les données */
                $result = $connexion->query("SELECT * FROM subscribers");

                /* Etape 3 : Affichage du resultat */
                while( $subscriber = $result->fetch_assoc() ){
                    /**
                     * 1er passage: 
                     *  $subscriber =   Clé     | Valeur 
                     *                  id      | 15
                     *                  email   | john@free.fr
                     *                  theme   | loisir 
                     *                 
                     * 2eme passage     Clé     | Valeur 
                     *                  id      | 16
                     *                  email   | richard@gmail.com
                     *                  theme   | animaux 
                    */
                    echo "<tr>"; 
                        echo "<td>" . $subscriber["email"] . "</td>";
                        echo "<td>" . $subscriber["theme"] . "</td>";
                        echo "<td></td>";
                    echo "<tr>";

                }
                
            ?>

        </table>
    </div>
</body>
</html>