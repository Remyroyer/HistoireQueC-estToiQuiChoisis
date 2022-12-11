<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

date_default_timezone_set('Europe/Paris');
date_default_timezone_get();


//Redondance dans ces lignes...................................
//On passe par la SESSION puis on passe par un cookie?..........
if (isset($_POST["nomUser"])) {
    $_SESSION["nomUser"] = $_POST["nomUser"];
    $_SESSION["prenomUser"] = $_POST["prenomUser"];
    $_SESSION["mdpUser"] = $_POST["mdpUser"];
    $_SESSION["pseudoUser"] = $_POST["pseudoUser"];
    $_SESSION["emailUser"] = $_POST["emailUser"];
}

if (isset($_POST["nomUSer"])) {
    if (!isset($_COOKIE['utilisateur']) || empty($_COOKIE['utilisateur'])) {
        setcookie('utilisateur', $_SESSION["nomUser"] . "/" . $_SESSION["prenomUser"] . "/" . $_SESSION["emailUser"], time() + 360, null, null, false, true);
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Que C'est toi qui choisi l'histoire...</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a><br>
<?php
//Si le nom de l'utilisateur n'est pas renseigné, on affiche le form
if (!isset($_POST["nomUser"])) {
    include_once 'form.php';
} else {//Sinon on affiche les infos utilisateur
    echo "<div>Ouaich, " . $_SESSION['emailUser'] . "</div>";
    //Recherche

    //Requete SQL affichage des infos utilisateur
    require_once("fonctions.php");
    $pseudo = selectUser($_SESSION['mdpUser'], $_SESSION['emailUser']);

    //Si pas d'info utilisateur
    if ($pseudo == null) {
        try {
            //$txtpseudo="Utilisateur ajouté dans la base de données...";
            //Requete SQL pour ajouter un utilisateur
            require_once("fonctions.php");
            addUser($_SESSION["nomUser"], $_SESSION["prenomUser"], $_SESSION["mdpUser"], $_SESSION["pseudoUser"], $_SESSION["emailUser"]);
            //Si la mise à jour c'est bien passée, on redirige vers la page des histoires
            header('refresh:3;url=histoire.php');
            echo "Vous allez être redirigé vers la page des histoires, dans un instant!";
        } catch (Exception $e) {
            //Gestion d'erreur
            $txtpseudo = "Cette adresse mail existe déjà!";
            echo $txtpseudo;
            //En cas d'erreur, on redirige vers cette page........................................
            echo "Vous allez être redirigé vers l'accueil dans un instant!";
            header('refresh:3;url=forminscription.php');
            die();
        }
    } else {
        $txtpseudo = "Cette adresse mail existe déjà!";
        echo "Cette adresse mail existe déjà!!!";
        echo "Vous allez être redirigé vers l'accueil dans un instant!";
            header('refresh:3;url=index.php');
    }

    //echo $txtpseudo;
}
?>
<br>
<div>
    <form action="deconnexion.php" method="POST"><input type="submit" value="Déconnexion"></form>
</div>


</body>
</html>