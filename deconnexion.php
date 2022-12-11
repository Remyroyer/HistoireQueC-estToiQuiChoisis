<?php
//On détruit les infos de SESSION utilisateur
session_unset();
// session_destroy();
session_write_close();
$_SESSION['nomUser'] = null;
setcookie(session_name(), '', time() + 3600 * 24, '/', '', false,false);
setcookie('nbcoups', '', time() + 3600 * 24, '/', '', false,false);
setcookie('idEvent', '', time() + 3600 * 24, '/', '', false,false);
setcookie('nomPerso', '', time() + 3600 * 24, '/', '', false,false);
setcookie('idUtilisateur', '', time() + 3600 * 24, '/', '', false,false);
setcookie('idhistoire', '', time() + 3600 * 24, '/', '', false,false);
setcookie('modifhistoire', '', time() + 3600 * 24, '/', '', false,false);
$_SESSION['ADMIN']=null;

session_unset();
session_write_close();

//.......................................................
//Ne doit on pas aussi détruire le perso, histoire?

header('refresh:3;url=index.php');
echo "Vous allez être redirigé vers l'accueil dans un instant!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Document</title>
</head>
<body>

</body>
</html>