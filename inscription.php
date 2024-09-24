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

            function isValidEmail($email) {
                $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
                return preg_match($pattern, $email) === 1;
            }

            if( isset($_POST["inscription"]) ){

                if(!empty($_POST["email"]) && !empty($_POST["theme"])){

                    $email = $_POST["email"];
                    $theme = $_POST["theme"];

                    if(isValidEmail($email)) {

                        /* Etape 1 : Connexion a la base de données buzzletters */
                        $connexion = new mysqli("localhost", "root", "root", "buzzletters");
                        if ($connexion->connect_error) {
                            die('Erreur de connexion à la base de données : '. $connexion->connect_error);
                        }
                        
                        /* Etape 2 : Requete pour inserer les données */
                        $result = $connexion->query("INSERT INTO subscribers (email, theme) VALUES ('$email', '$theme') ");

                        if($result){
                            echo "<p class='alert alert-success'>Vous êtes bien inscris à notre newsletters</p>"; 
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
        ?>
    
        <h1>Inscris toi à notre newsletters</h1>
        <p>Reste informé et ne manque aucune actualité passionnante ! En t'inscrivant à Buzzletters, tu recevras chaque semaine des contenus sur mesure, choisis selon tes intérêts. Que tu sois passionné de loisirs, de sport, de technologies, d'animaux, de musique ou de films, notre newsletter te proposera des articles, des conseils, et bien plus encore, directement dans ta boîte mail. Rejoins notre communauté et partage tes passions avec nous !</p>
        <form action="" method="POST">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
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