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
    <title>Ecran début histoire</title>
</head>

<header>
    <a href="index.php">Retour à l'accueil</a>
    <a href="compte.php">Mon Compte</a>
    <a href="perso.php">Changer / Créer Perso</a>
</header>

<body>
    <?php 
    include('fonctions.php');

    $idHistoire = $_COOKIE['idhistoire'];

    $infoHistoire = affichagehistoire($idHistoire);

    // var_dump($infoHistoire);

    echo "Histoire sélectionnée : <h2>".$infoHistoire[0]['nomHistoire'] ."</h2><br>";
    echo "Personnage sélectionné : " . $_COOKIE['nomPerso'];

    switch($_COOKIE['idhistoire'])
    {
        case 1:
            ?>
            <style>body {background-image: url("img/Roi Yome 2.png");}</style>
        <?php
            break;
        case 2:
            ?>
            <style>body {background-image: url("img/Train.png");}</style>
        <?php
            break;
    }
        ?>
        <h2><a href="gameplay.php">Commencer cette histoire</a></h2>
        <style>body {
            background-attachment: scroll;
            background-repeat: no-repeat;
            background-size: cover;
            }</style>
    </style>



    <!-- ECRAN DEBUT HISTOIRE - Mettre les infos !!! -->

    <?php
    // header('refresh:3;url=gameplay.php');
    // echo "Vous allez être redirigé vers la page du jeu dans un instant!";
    ?>

</body>
</html>