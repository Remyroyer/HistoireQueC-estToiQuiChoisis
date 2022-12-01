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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecran début histoire</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a>
<a href="compte.php">Mon Compte</a>
<a href="perso.php">Changer/Créer Perso</a>

ECRAN DEBUT HISTOIRE - Mettre les infos!!!

<?php
header('refresh:3;url=gameplay.php');
echo "Vous allez être redirigé vers la page du jeu dans un instant!";
?>

</body>
</html>