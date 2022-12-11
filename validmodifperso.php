<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('refresh:3;url=index.php');
    echo "Vous allez être redirigé vers l'accueil dans un instant!";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Page Personnage</title>
</head>
<body>
<?php

require_once("fonctions.php");
updateperso($_POST['idPerso'], $_POST['nomPerso'], $_POST['sexePerso']);

header('refresh:3;url=perso.php');
echo "Mise à jour faite, vous allez être redirigé vers la page Perso dans un instant!";

?>

</body>
</html>