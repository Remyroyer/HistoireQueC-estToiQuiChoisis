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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
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