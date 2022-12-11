<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
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
//Requete SQL pour désactiver le perso
require_once("fonctions.php");
desactiveperso($_POST['idPerso']);

header('refresh:3;url=perso.php');
echo "Perso supprimé, vous allez être redirigé vers la page Perso dans un instant!";

?>

</body>
</html>