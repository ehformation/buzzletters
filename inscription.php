<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzzletters - Inscris toi à notre newsletters</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-inscription">

        <?php 
            require 'functions.php';

            // Vérifie si le formulaire d'inscription a été soumis
            if( isset($_POST["inscription"]) ){

                // Vérifie si les champs email et theme ne sont pas vides
                if( !empty($_POST["email"]) && !empty($_POST["theme"]) && !empty($_POST["age"]) ){

                    $email = $_POST["email"];
                    $theme = $_POST["theme"];
                    $age = $_POST["age"];
                    
                    if($age < 12){
                        echo "<p class='alert alert-error'>Vous être trop jeune, vous ne pouvez pas vous inscrire.</p>";
                    }else{
                        // Vérifie si l'email est valide
                        if(isValidEmail($email)) {

                            if(emailExist($email)){
                                echo "<p class='alert alert-error'>L'email existe deja.</p>";
                            }else{
                                /* Etape 1 : Connexion a la base de données buzzletters */
                                require "connect.php";

                                /* Etape 2 : Requete pour inserer les données */
                                $result = $connexion->query("INSERT INTO subscribers (email, theme, age) VALUES ('$email', '$theme', '$age' )");

                                if($result){
                                    echo "<p class='alert alert-success'>Vous êtes bien inscris à notre newsletters</p>"; 
                                }else{
                                    echo "<p class='alert alert-error'>Une erreur est survenue, Veuillez réessayer</p>";
                                }
                            }
                        }else {
                            echo "<p class='alert alert-error'>L'email n'est pas valide</p>";
                        }
                    }

                }else {
                    echo "<p class='alert alert-error'>Tous les champs sont requis</p>";
                }
                
            }
        ?>
    
        <h1>Inscris toi à notre newsletters</h1>
        <p>Reste informé et ne manque aucune actualité passionnante ! En t'inscrivant à Buzzletters, tu recevras chaque semaine des contenus sur mesure, choisis selon tes intérêts. Que tu sois passionné de loisirs, de sport, de technologies, d'animaux, de musique ou de films, notre newsletter te proposera des articles, des conseils, et bien plus encore, directement dans ta boîte mail. Rejoins notre communauté et partage tes passions avec nous !</p>
        <form action="" method="POST">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="age">Age</label>
                <input type="text" name="age" id="age" required>
            </div>
            <div>
                <label for="theme">Thème</label>
                <select name="theme" id="theme" required>
                    <option value="loisir">Loisir</option>
                    <option value="sport">Sport</option>
                    <option value="technologies">Technologies</option>
                    <option value="animaux">Animaux</option>
                    <option value="musique">Musique</option>
                    <option value="film">Film</option>
                </select>
            </div>
            <button type="submit" name="inscription" >S'inscrire</button>
        </form>
    </div>
</body>
</html>