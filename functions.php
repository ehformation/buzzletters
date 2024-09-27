<?php 
session_start(); 
/*
La fonction isValidEmail($email) valide une adresse email en utilisant une expression régulière. Elle définit un modèle ($pattern) qui décrit le format acceptable d'une adresse email, incluant des caractères alphanumériques, le symbole "@", et un domaine suivi d'une extension. La fonction utilise preg_match() pour comparer l'email fourni avec le modèle défini. Si l'email correspond au modèle, elle retourne true, sinon elle retourne false, indiquant si l'email est valide ou non. 
*/
function isValidEmail($email) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email) === 1;
}

function emailExist($email){
    /* Etape 1 : Connexion a la base de données buzzletters */
    require "connect.php";

    /* Etape 2 : Requete pour rechercher un email*/
    $result = $connexion->query("SELECT * FROM subscribers WHERE email = '$email'");

    if ($result->num_rows > 0) {
        return true; // L'email existe
    } else {
        return false; // L'email n'existe pas
    }
}

function getClassByTheme($theme){
    $class = '';
    switch ($theme) {
        case 'loisir':
            $class = 'badge';
            break;
        case 'animaux':
            $class = 'badge badge-brown';
            break;
        case 'musique':
            $class = 'badge badge-yellow';
            break;
    }

    return $class;
}

function isLoggedIn(){
    if(isset($_SESSION['login'])){
        return true;
    }else{
        return false;
    }
    //returnisset($_SESSION['login'])
}

?>