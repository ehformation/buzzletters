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
    require 'connect.php';
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
    ?>
        <form action="" method="POST">
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
            <button type="submit" name="inscription" >S'inscrire</button>
        </form>

    <?php else :  ?>
        <p>Aucun abonée n'a été séléctionné</p>
    <?php endif; ?>
</body>
</html>