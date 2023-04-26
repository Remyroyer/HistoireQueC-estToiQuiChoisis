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
            setcookie('nomPerso', $_POST['nomPerso'], time() + 3600 * 24, '/', '', false, false);
        }
    }
    if (isset($_COOKIE['nomPerso']) && isset($_POST['nomPerso'])) {
        setcookie('nomPerso', $_POST['nomPerso'], time() + 3600 * 24, '/', '', false, false);
    }

    //Vérification histoire sinon redirection ou création du cookie
    if (isset($_COOKIE['idhistoire']) && !isset($_POST['id_histoire'])) {
        $idhistoire = $_COOKIE['idhistoire'];
        
    }
    if (isset($_COOKIE['idhistoire']) && isset($_POST['id_histoire'])) {
        $idhistoire = $_POST['id_histoire'];
        setcookie('idhistoire', $_POST['id_histoire'], time() + 3600 * 24, '/', '', false, false);
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

    if($idhistoire){
        include('fonctions.php');
        $infoHistoire = affichagehistoire($idhistoire);
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <?php
        include_once("head.php");
        ?>
        <title>Gameplay</title>
    </head>

    <body>
        <header>
            <!-- Navigation -->
            <?php
            include_once("menu.php");
            ?>
        </header>

        <?php
        //Affichage de l'histoire
        echo "<h2 class='title'><p class='titlecontent'>" . $infoHistoire[0]['nomHistoire'] . "</p></h2>";
        ?><?php

        //Requete SQL select evenements de l'histoire pour affichage
        require_once("fonctions.php");
        $result = selecteventhistoire($idhistoire);
        $a = 0;

        echo "<div class='containt'>";
        switch ($_COOKIE['nbcoups']) {
            case 0:
                echo "<div class='cont'>❤️❤️❤️</div>";
                break;
            case 1:
                echo "<div class='cont'>❤️❤️<div class='heart'>💔</div></div>";
                break;
            case 2:
                echo "<div class='cont'>❤️<div class='heart'>💔💔</div></div>";
                break;
            case 3:
                echo "<div class='heart'>💔💔💔</div>";
                break;
        };
        "</div>" ?><?php

                //Si le nb de coups est > à 3 : PERDU......
                // echo "Nombre de coups en cours: " . $_COOKIE['nbcoups'];
                if ($_COOKIE['nbcoups'] >= 3) {
                    header('Location: perdu.php');
                }

                //Affichage du nom du perso
                if (isset($_POST['nomPerso'])) {
                    echo "<h2 class='name'><p class='titlecontent'>" . $_POST['nomPerso'] . "</p></h2>";
                } else {
                    if (isset($_COOKIE['nomPerso'])) {
                        echo "<h2 class='name'><p class='titlecontent'>" . $_COOKIE['nomPerso'] . "</p></h2>";
                    }
                }

                ?>
                <div class="container">
	<div class="row">
		
	<div class="col-xl-9 d-flex">
        <div class="card px-2 d-flex opacity-75">
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
                if (!isset($_COOKIE['idEvent'])) {
                    setcookie('idEvent', 1, time() + 3600 * 24, '/', '', false, false);
                }

                if ($idEvent >= $_COOKIE['idEvent']) {
                    // var_dump($resultLieu[0]['imgLieu']);

            ?>
            <style>
                body {
                    background: url("<?php echo "img/" . $resultLieu[0]['imgLieu'] . "" ?>") no-repeat center center fixed;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    background-size: cover;
                    -o-background-size: cover;
                }
.heart{
    font-size: xx-large;
                    width: fit-content;
            padding: 0px;
            margin-left: auto;
            margin-right: auto;
            animation: coeur 1s ease-in-out 3;
}

@keyframes coeur {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.3);
  }
  100% {
    transform: scale(1);
  }
}
.button {
            background-color: blueviolet;
            width: fit-content;
            padding-inline: 5px;
            border-radius: 4px;
            text-align: center;
            color: whitesmoke;
        }
        .button:hover {
            opacity: 75%;
            color: black;
        }

.cont{
    display: flex;
  justify-content: center;
  align-items: center;
  font-size: xx-large;
                    width: fit-content;
            margin-left: auto;
            margin-right: auto;

}
                .containt {
                    font-size: xx-large;
                    width: fit-content;
            padding: 0px;
            margin-left: auto;
            margin-right: auto;
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
.eventChoice{
    margin-left: auto;
            margin-right: auto;
            width: fit-content;
}
.title {
            color: blueviolet;
            text-align: center;
        }
        .name {
            color: violet;
            text-align: center;
        }
        .centerTxt{
            vertical-align: middle;
        }
        .justify{
            text-align: justify;
        }
        .underline{
            text-decoration: underline overline blueviolet;
            padding-top: 10;
        }
.txtcolor{
    color: whitesmoke;
}
            </style>
            <?php
                                // echo $idEvent;
                    //Requete SQL pour afficher le lieu
                    $resultLieu = selectLieu($idlieu);
            ?><?php
                    echo "<p class='underline'>Votre situation dans l'espace :</p>";
                    echo "<p class='px-2 bg-pink opacity-1'><div class='border px-2 bg-secondary txtcolor'>".$resultLieu[0]['nomLieu']."</div></p>";
                    ?><?php
                    echo "<p class='underline'>L'histoire : </p>";
                    echo "<p class='justify px-2'><div class='border px-2 bg-secondary txtcolor'>" . $resultEvent[0]['nomEvent']."</div></p>";
                    $idEvenement = $resultEvent[0]['Id_evenement'];
                    ?>
                </div></div><div class="col-xl-3 d-flex align-items-center">
<div class="card px-2 d-flex col opacity-75">
                    <?php

                    //Requete SQL pour afficher Id des actions dispos en fonction de l'événement
                    $resultchoix = selectaction($idEvenement);

                    //Si il y a encore des actions dans la requete, alors on boucle pour affichage
                    if (!is_null($resultchoix)) {
                        echo "<p class='underline'>Vos choix : </p>";
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
                        <div class='eventChoice'>
                        <button type="submit" class='button opacity-1'>
                            <?php
                            echo $resultaction[0]["nomAction"];
                            ?>
                        </button>
                        </div>
                    </form>
    <?php
                        }
                        //A- Permet de boucler une seule fois
                        break;
                    } else {
                         echo "Fin de l'histoire...";
                        // header('refresh:0;url=gagne.php');
                        // echo "<br>" . "Vous allez être redirigé dans un instant... ";
                        // header('Location: gagne.php');
                        //Bouton de redirection...
                    }
                }
            }
    ?>
        </div>
        </div>
        </div>

</div>
        <?php
        ?>
        <br>

    </body>

    </html>