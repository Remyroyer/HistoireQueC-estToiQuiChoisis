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
    <title>Visualisation des comptes utilisateurs</title>
</head>
<body>
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