<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION['nomUser'])){header('Location: index.php');}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Modification du compte</title>
</head>
<body>
    
<?php


//En cas de compte rendu inactif, il faut lui demander de valider!!!!


if($_POST['mdp0']===$_POST['mdp'] || $_POST['mdp0']== null){
    require_once("fonctions.php");
    updateUser();
    header('refresh:3;url=compte.php');
echo "Mise à jour effectuée, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
}else{
    header('refresh:3;url=compte.php');
    echo "Erreur dans la saisie du mot de passe, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
}




?>

</body>
</html>