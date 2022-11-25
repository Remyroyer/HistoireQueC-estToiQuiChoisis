<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}
//echo $_COOKIE['idUtilisateur'];

//On créer le cookie du perso choisi
setcookie('nomPerso', $_POST['nomPerso'], time() + 3600 * 24, '/', '', false, false);
//echo "NOM: ".$_COOKIE['nomPerso'];
//echo "NOM: " .$_POST['nomPerso'];

//Requete SQL pour ajouter un perso à l'utilisateur
require_once("fonctions.php");
insertPerso($_POST['nomPerso'], $_POST['sexePerso'], $_COOKIE['idUtilisateur']);

// header
//Redirection vers la page perso
header('refresh:3;url=perso.php');
echo "Mise à jour effectuée, vous allez être redirigé vers la page 'Perso' dans un instant!";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

</body>
</html>