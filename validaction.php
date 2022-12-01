<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

//var_dump ($_POST['eventval']);
// setcookie('idHistoire', $_POST['idhistoire'], time() + 3600 * 24, '/', '', false, false);

//var_dump($_COOKIE['idHistoire']);

//Vérification du bon choix de l'action
if ($_POST["actionval"] === "1") {
    echo "Choix valide!<br>";
    //On passe à l'event suivant
    setcookie('idEvent', intval($_POST["eventval"]) + 1, time() + 3600 * 24, '/', '', false, false);
    //Le joueur gagne un coup supplémentaire
    setcookie('nbcoups', $_COOKIE['nbcoups'] - 1, time() + 3600 * 24, '/', '', false, false);
    if ($_COOKIE['nbcoups'] <= 0) {
        setcookie('nbcoups', 0, time() + 3600 * 24, '/', '', false,false);
    }
    header('Location: gameplay.php');

} else {
    echo "Choix non valide!<br>";
    //On reste sur l'event en cours
    setcookie('idEvent', intval($_POST["eventval"]), time() + 3600 * 24, '/', '', false, false);
    //Le joueur perd un coup
    setcookie('nbcoups', intval($_COOKIE['nbcoups']) + 1, time() + 3600 * 24, '/', '', false, false);
    header('Location: gameplay.php');
}

echo $_COOKIE['idEvent'];


?>