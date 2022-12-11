<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Perdu</title>
</head>
<body>
    <a href="index.php">Retour à l'accueil</a><br>
    <a href="histoire.php">Page des histoires</a><br>
    <a href="compte.php">Mon Compte</a><br>

        <style>
            body {
                background-image: url("img/GameOver.png");
                background-attachment: scroll;
                background-repeat: no-repeat;
                background-size: cover;
                }   
        </style>
</body>
</html>