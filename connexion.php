<?php require "functions.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Buzzletters - Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Si il n'est PAS connecté  -->
    <?php if(!isLoggedIn()) : ?>
        <div class="form-inscription">
            <?php
                if(isset($_POST["connexion"])){
                    $valid_login = "admin";
                    $valid_mdp = "1234";

                    if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
                        $login = $_POST["login"];
                        $mdp = $_POST["mdp"];

                        if($login == $valid_login && $mdp == $valid_mdp){
                            $_SESSION["login"] = $login;
                            header("Location: admin.php");
                        }else{
                            echo "<div class='alert alert-error'>Identifiant ou mot de passe incorrect</div>";
                        }
                    }
                }
            
            ?>

        
            <h1>Connectez-vous à l'admin Buzzletters</h1>
            <form action="" method="post">
                <div>
                    <input type="text" name="login" placeholder="Login">
                </div>
                <div>
                    <input type="password" name="mdp" placeholder="Mot de passe">
                </div>
                <button name="connexion" type="submit">Connexion</button>
            </form>
        </div>
    <?php else :  ?>
        <p>Vous etes deja connecté</p>
    <?php endif; ?>
</body>
</html>