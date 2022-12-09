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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

    $idEvent = $_COOKIE['idEvent'];
    $resultEvent = selectevent($idEvent);
    $idlieu = $resultEvent[0]['Id_lieu'];
    $resultLieu = selectLieu($idlieu);

    $infoHistoire = affichagehistoire($idHistoire);

    // var_dump($infoHistoire);

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