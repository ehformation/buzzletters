<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Buzzletters - Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
                }
            }
        }
    
    ?>

    <div class="form-inscription">
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
</body>
</html>