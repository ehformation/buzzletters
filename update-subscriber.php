<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

        <?php 
    if(isset($_SESSION["login"])) : 
        require 'connect.php';
        require 'functions.php';
        if(isset($_GET["id"])) :

        $id = $_GET["id"];
        $result = $connexion->query("SELECT * FROM subscribers WHERE id = $id");
        /* Je recupere l'abonée depuis la bdd dont l'id est passé par l'url  */
        $subscriber = $result->fetch_assoc();

        /*
        * Cle | valeur
        * email | john@free.fr
        * theme | loisir
        * Age   | 23
            */
        if(isset($_POST['update'])){
            if( !empty($_POST["email"]) && !empty($_POST["theme"]) && !empty($_POST["age"]) ){
                $email = $_POST['email'];
                $theme = $_POST['theme'];
                $age = $_POST['age'];

                if(isValidEmail($email)) {

                    $result = $connexion->query("UPDATE subscribers SET email = '$email', theme = '$theme', age = '$age' WHERE id = $id");

                    if($result){
                        echo "<p class='alert alert-success'>Modifications effectuées</p>"; 
                        header("Location: admin.php"); //redirection de la page vers admin.php
                    }else{
                        echo "<p class='alert alert-error'>Une erreur est survenue, Veuillez réessayer</p>";
                    }
                    
                }else {
                    echo "<p class='alert alert-error'>L'email n'est pas valide</p>";
                }
            }else {
                echo "<p class='alert alert-error'>Tous les champs sont requis</p>";
            } 
        }
        
        ?><div class="form-inscription">
            <form action="?id=<?php echo $id ?>" method="POST">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required value="<?php echo $subscriber["email"] ?>">
                </div>
                <div>
                    <label for="age">Age</label>
                    <input type="text" name="age" id="age" required value="<?php echo $subscriber["age"] ?>">
                </div>
                <div>
                    <label for="theme">Thème</label>
                    <select name="theme" id="theme" required>
                        <option value="loisir" <?php echo ($subscriber["theme"] == 'loisir') ? 'selected' : ''; ?>>Loisir</option>
                        <option value="sport" <?php echo ($subscriber["theme"] == 'sport') ? 'selected' : ''; ?>>Sport</option>
                        <option value="technologies" <?php echo ($subscriber["theme"] == 'technologies') ? 'selected' : ''; ?>>Technologies</option>
                        <option value="animaux" <?php echo ($subscriber["theme"] == 'animaux') ? 'selected' : ''; ?>>Animaux</option>
                        <option value="musique" <?php echo ($subscriber["theme"] == 'musique') ? 'selected' : ''; ?>>Musique</option>
                        <option value="film" <?php echo ($subscriber["theme"] == 'loisir') ? 'film' : ''; ?>>Film</option>
                    </select>
                </div>
                <button type="submit" name="update" >Modifier</button>
            </form>
        </div>
        <?php else :  ?>
            <p>Aucun abonée n'a été séléctionné</p>
        <?php endif; ?>
    <?php else :  ?>
        <p>Vous ne pouvez pas accéder à cette page</p>
    <?php endif; ?>
</body>
</html>