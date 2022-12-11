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
    <title>Fin Histoire</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a>
<a href="histoire.php">Page des histoires</a>
<a href="compte.php">Mon Compte</a><br><br>

<?php     

include('fonctions.php');

$idEvent = $_COOKIE['idEvent'];

$infoEvent = selectEvent($idEvent);

// var_dump($infoEvent);
?>
<div class="gagnee">
    <?php    
        echo "<h4>".$infoEvent[0]['nomEvent'] ."</h4><br>";
        echo $_COOKIE['nomPerso']. " a réussi grace à vous";
    ?>
</div>
<?php
?>
    <style>
body {
    background-image: url("img/YouWin.png");
    background-attachment: scroll;
    background-repeat: no-repeat;
    background-size: cover;
    }
</style>

</body>
</html>