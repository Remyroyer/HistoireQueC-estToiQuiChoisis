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
<?php
 include_once("head.php");
 ?>
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