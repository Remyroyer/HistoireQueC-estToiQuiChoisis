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
    <title>Visualisation des comptes utilisateurs</title>
</head>
<body>
<a href="index.php">Accueil</a><br>
<a href="admincompte.php">Retour aux comptes utilisateurs</a><br>
<?php

echo $_POST['Id_utilisateur']."<br>";
$Id_utilisateur=$_POST['Id_utilisateur'];

if(isset($_POST['admin'])){
    if($_POST['admin']=='on'){
        echo "ADMIN"."<br>";
        $admin=1;
}
}else{
    echo "UTILSATEUR"."<br>";
    $admin=0;
}

echo $_POST['nomUser']."<br>";
$nomUser=$_POST['nomUser'];

echo $_POST['prenomUser']."<br>";
$prenomUser=$_POST['prenomUser'];


if(isset($_POST['mdpUser'])){
    echo $_POST['mdpUser']."<br>";
    $mdpUser=$_POST['mdpUser'];
}else{
    $mdpUser='';
}

if($_POST['actifUser']=='on'){
    echo "ACTIF"."<br>";
    $actifUser=1;
    }else{
    echo "DESACTIVE"."<br>";
    $actifUser=0;
    }

echo $_POST['pseudoUser']."<br>";
$pseudoUser=$_POST['pseudoUser'];

echo $_POST['emailUser']."<br>";
$emailUser=$_POST['emailUser'];

echo $_POST['imgUser']."<br>";
$imgUser=$_POST['imgUser'];

include_once("fonctions.php");
$result=adminUpdateUser($Id_utilisateur,$admin,$nomUser,$prenomUser,$mdpUser,$actifUser,$pseudoUser,$emailUser,$imgUser);

setcookie('modifcompte', $_POST['Id_utilisateur'], time() + 3600 * 24, '/', '', false,false);

header('refresh:3;url=validadmincompte.php');
echo "<br>" . "Vous allez être redirigé vers le compte modifié... ";

?>




</body>
</html>