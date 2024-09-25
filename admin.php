<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Buzzletters - Liste des abonnés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        require 'functions.php';
        /**
         * admin.php?delete&id=15
         * $_GET 
         * 
         * Clé          | Valeur
         * delete       |  
         * id           | 15
         * 
         */
        if(isset($_GET["delete"])){

            $id_to_delete = $_GET['id'];

            /* Etape 1 : Connexion a la base de données buzzletters */
            require "connect.php";

            /* Etape 2 : Requete pour supprimer */
            $result = $connexion->query("DELETE FROM subscribers WHERE id=$id_to_delete");

            if($result){
                echo "<p class='alert alert-success'>L'abonné a bien été désinscris</p>"; 
            }else{
                echo "<p class='alert alert-error'>Une erreur est survenue, Veuillez réessayer</p>";
            }

        }

        if(isset($_GET["search"])){
            $s = $_GET["s"];

            require 'connect.php';
            $search_result = $connexion->query("SELECT * FROM subscribers WHERE email LIKE '%$s%' ");
        }
    ?>
    <div class="container">
        <h1>Buzzletters - Admin</h1>

        <form action="" method="GET">
            <input type="text" name="s" placeholder="Ex: j.doe@gmail.com">
            <button type="submit" name="search">Rechercher</button>
            <button type="submit" name="search">Renitialiser</button>
        </form>

        <table border="1">
            <tr>
                <th>Email</th>
                <th>Thème</th>
                <th>Age</th>
                <th>Action</th>
            </tr>

            <?php
                if(isset($search_result) && $search_result->num_rows > 0 ) {
                   /* Etape 3 : Affichage du resultat recherché */
                    while( $subscriber = $search_result->fetch_assoc() ){
                        $id = $subscriber["id"];
                        $class = getClassByTheme($subscriber["theme"]);

                        echo "<tr>"; 
                            echo "<td>" . $subscriber["email"] . "</td>";
                            echo "<td><div class='$class' >" . $subscriber["theme"] . "</div></td>";
                            echo "<td>" . $subscriber["age"] . "</td>";
                            echo "<td><a href='?delete&id=$id'>désinscrire</a></td>";
                        echo "<tr>";

                    } 
                }else{
                    /* Etape 1 : Connexion a la base de données buzzletters */
                    require "connect.php";

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
                        $id = $subscriber["id"];
                        $class = getClassByTheme($subscriber["theme"]);

                        echo "<tr>"; 
                            echo "<td>" . $subscriber["email"] . "</td>";
                            echo "<td><div class='$class' >" . $subscriber["theme"] . "</div></td>";
                            echo "<td>" . $subscriber["age"] . "</td>";
                            echo "<td><a href='?delete&id=$id'>désinscrire</a></td>";
                        echo "<tr>";

                    }
                }
                
            ?>

        </table>
    </div>
</body>
</html>