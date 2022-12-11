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
<?php
 include_once("head.php");
 ?>
    <title>Document</title>
</head>
<body>

</body>
</html>