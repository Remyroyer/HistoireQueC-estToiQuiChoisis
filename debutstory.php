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
    echo "<h2 class='title'><p class='titlecontent'>" . $infoHistoire[0]['nomHistoire'] . "</p></h2><br>";
    echo "<h2 class='name'><p class='titlecontent'>" . $_COOKIE['nomPerso'] . "</p></h2><br>";
    ?>

    <style>
        body {
            background-image: url("<?php echo "img/" . $resultLieu[0]['imgLieu'] . ""; ?>");
            background-attachment: scroll;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <h2>
        <a href="gameplay.php" class="nolink">
            <p class="linkcontent">Commencer cette histoire</p>
        </a>
    </h2>
    
    <style>
        body {
            background-attachment: scroll;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .titlecontent {
            background-color: white;
            opacity: 50%;
            width: fit-content;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px;
            border-color: black;
            border-style: inset;
            border-width: 2px;
        }

        .name {
            color: violet;
            text-align: center;
        }

        .title {
            color: blueviolet;
            text-align: center;
        }

        .nolink {
            text-decoration: none;
            text-align: center;
        }

        .nolink:link,
        .nolink:visited {
            color: blueviolet;
        }

        .linkcontent {
            background-color: white;
            opacity: 50%;
            width: fit-content;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px;
            border-color: black;
            border-style: inset;
            border-width: 2px;
        }

        .linkcontent:hover {
            background-color: black;
            opacity: 75%;
            width: fit-content;
        }

        .nolink:hover {
            color: violet;
        }

        .button {
            background-color: blueviolet;
            width: fit-content;
            padding: 10px;
            text-align: center;
        }
    </style>

</body>

</html>