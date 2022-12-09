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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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