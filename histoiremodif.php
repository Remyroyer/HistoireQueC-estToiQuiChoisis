<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Mise à jour des histoires</title>
</head>
<body>
<?php

if (!isset($_POST['actif'])){
    $_POST['actif']='off';
}

include_once("fonctions.php");
$result=modifhistoire($_POST['id_histoire'],$_POST['nomHistoire'],$_POST['auteurHistoire'],$_POST['descriptionHistoire'],$_POST['genreHistoire'],$_POST['actif']);

setcookie('modifhistoire', $_POST['id_histoire'], time() + 3600 * 24, '/', '', false,false);

header('refresh:3;url=validmodifhistoire.php');
echo "<br>" . "Vous allez être redirigé vers les modifications... ";
?>
</body>
</html>