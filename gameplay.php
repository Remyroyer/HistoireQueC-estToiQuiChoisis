<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

//Vérification nom perso sinon redirection ou création du cookie
if (!isset($_COOKIE['nomPerso']) && !isset($_POST['nomPerso'])) {
    header('Location: perso.php');
} else {
    if (!isset($_COOKIE['nomPerso']) && isset($_POST['nomPerso'])) {
        setcookie('nomPerso', $_POST['nomPerso'], time() + 3600 * 24, '/', '', false,false);
    }
}
if (isset($_COOKIE['nomPerso']) && isset($_POST['nomPerso'])) {
    setcookie('nomPerso', $_POST['nomPerso'], time() + 3600 * 24, '/', '', false,false);
}

//Vérification histoire sinon redirection ou création du cookie
if (isset($_COOKIE['idhistoire']) && !isset($_POST['id_histoire'])) {
    $idhistoire = $_COOKIE['idhistoire'];
}
if (isset($_COOKIE['idhistoire']) && isset($_POST['id_histoire'])) {
    $idhistoire = $_POST['id_histoire'];
    setcookie('idhistoire', $_POST['id_histoire'], time() + 3600 * 24, '/', '', false,false);
}
if (!isset($_COOKIE['idhistoire']) && !isset($_POST['id_histoire'])) {
    header('Location: histoire.php');
} else {
    if (!isset($_COOKIE['idhistoire']) && isset($_POST['id_histoire'])) {
        setcookie('idhistoire', $_POST['id_histoire'], time() + 3600 * 24, '/', '', false, false);
        setcookie('idEvent', 1, time() + 3600 * 24, '/', '', false, false);
        // setcookie('nbcoups', 0, time() + 3600 * 24, '/', '', false, false);
        $idhistoire = $_POST['id_histoire'];
    }
}

//Affichage de la page Ecran début histoire parce que c'est dans les specs!
if ((isset($_POST['debuthistoire'])) && ((isset($_COOKIE['nomPerso'])) || (isset($_POST['nomPerso'])))) {
    //Go to page ECRAN DEBUT HISTOIRE
    header('Location: debutstory.php');
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <title>Gameplay</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a><br>
<a href="histoire.php">Page des histoires</a><br>
<a href="compte.php">Mon Compte</a><br>
<a href="perso.php">Changer / Créer Perso</a><br>
<br>
<?php
//Affichage de l'histoire
echo "Vous avez choisi l'histoire : " . $idhistoire;
?><br><?php

//Requete SQL select evenements de l'histoire pour affichage
require_once("fonctions.php");
$result = selecteventhistoire($idhistoire);
$a = 0;

echo "Vie : ";
switch ($_COOKIE['nbcoups']){
    case 0:
        echo "❤️❤️❤️";
        break;
    case 1:
        echo "❤️❤️💔";
        break;
    case 2:
        echo "❤️💔💔";
        break;
    case 3:
        echo "💔💔💔";
        break;
    }
;?><br><?php

//Si le nb de coups est > à 3 : PERDU......
// echo "Nombre de coups en cours: " . $_COOKIE['nbcoups'];
if ($_COOKIE['nbcoups'] >= 3) {
    header('Location: perdu.php');
}

//Affichage du nom du perso
if (isset($_POST['nomPerso'])) {
    echo "Ton perso s'appel : " . $_POST['nomPerso'] . "<br>";
} else {
    if (isset($_COOKIE['nomPerso'])) {
        echo "Ton perso s'appel : " . $_COOKIE['nomPerso'] . "<br>";
    }
}

?>
<div class="card">
    <?php

    //A- Boucle 1 fois sur les Evenements de l'histoire de Requete SQL select id evenements lié à l'histoire pour affichage.
    foreach ($result as $resultat) {
//var_dump($resultat);
        ?><?php

        $idEvent = $result[$a]['Id_evenement'];
        $a++;

        //Requete SQL select evenements pour connaitre les infos de l'evenements pour affichage (nom du lieu...)
        require_once("fonctions.php");
        $resultEvent = selectevent($idEvent);
        $idlieu = $resultEvent[0]['Id_lieu'];
        $resultLieu = selectLieu($idlieu);

        //Si la valeur de Event affiché est superieur à celle mis en memoire Alors on affiche l'histoire
if(!isset($_COOKIE['idEvent'])){
    setcookie('idEvent', 1, time() + 3600 * 24, '/', '', false, false);
}

        if ($idEvent >= $_COOKIE['idEvent']) {
            // var_dump($resultLieu[0]['imgLieu']);

            ?>
                <style>
                body {
                    background-image: url("<?php echo "img/" .$resultLieu[0]['imgLieu']. ""?>");
                    background-attachment: scroll;
                    background-repeat: no-repeat;
                    background-size: cover;
                    }
                </style>
            <?php

            echo $idEvent;

            //Requete SQL pour afficher le lieu
            $resultLieu = selectLieu($idlieu);
            ?><br><?php
            echo "Votre situation dans l'espace : ";
            echo $resultLieu[0]['nomLieu'];
            ?><br><?php
            echo "Ce qui ce passe : ";
            echo $resultEvent[0]['nomEvent'];
            $idEvenement = $resultEvent[0]['Id_evenement'];
            ?><br><?php
            echo "Vos choix : ";

            //Requete SQL pour afficher Id des actions dispos en fonction de l'événement
            $resultchoix = selectaction($idEvenement);

            //Si il y a encore des actions dans la requete, alors on boucle pour affichage
            if (!is_null($resultchoix)) {
                foreach ($resultchoix as $resultaction) {
                    ?>
                    <form action="validaction.php" method="POST">
                        <?php
                        //var_dump($resultaction);
                        $idaction = $resultaction["Id_actions"];
                        $actionok = $resultaction["ok"];

                        //Requete SQL pour afficher les actions précédement définies
                        $resultaction = selectActions($idaction);
                        ?>

                        <input type="text" name="idhistoire" value="<?php echo $idhistoire; ?>" hidden>
                        <input type="text" name="eventval" value="<?php echo $idEvenement; ?>" hidden>
                        <input type="text" name="actionval" value="<?php echo $actionok; ?>" hidden>
                        <input type="text" name="debuthistoire" value="false" hidden>
                        <?php
                        ?>
                        <button type="submit">
                            <?php
                            echo $resultaction[0]["nomAction"];
                            ?>
                        </button>
                    </form>
                    <?php
                }
//A- Permet de boucler une seule fois
                break;
            } else {
                // echo "<br>" . "Fin de l'histoire...";
                header('refresh:0;url=gagne.php');
                // echo "<br>" . "Vous allez être redirigé dans un instant... ";
                //header('Location: gagne.php');
                //Bouton de redirection...
            }
        }
    }
    ?>
</div>
<?php
?>
<br>

</body>
</html>

