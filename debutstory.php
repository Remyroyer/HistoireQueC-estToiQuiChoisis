<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

$idHistoire = $_COOKIE['idhistoire'];
$idEvent = $_COOKIE['idEvent'];
include('fonctions.php');
$resultEvent = selectevent($idEvent);
$idlieu = $resultEvent[0]['Id_lieu'];
$resultLieu = selectLieu($idlieu);
$infoHistoire = affichagehistoire($idHistoire);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Ecran début histoire</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>
   <?php
echo "Histoire sélectionnée : <h2>".$infoHistoire[0]['nomHistoire'] ."</h2><br>";
echo "Personnage sélectionné : " . $_COOKIE['nomPerso'];
?>

   <style>
    body {
        background-image: url("<?php echo "img/" .$resultLieu[0]['imgLieu'].""; ?>");
        background-attachment: scroll;
        background-repeat: no-repeat;
        background-size: cover;
        }
    </style>
        
        <h2><a href="gameplay.php">Commencer cette histoire</a></h2>
        <style>
        body {
            background-attachment: scroll;
            background-repeat: no-repeat;
            background-size: cover;
            }
            </style>

</body>
</html>