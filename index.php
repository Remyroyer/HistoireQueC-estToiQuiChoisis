<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

date_default_timezone_set('Europe/Paris');
date_default_timezone_get();

//Infos à retourner pour la modification du compte
//Création de la SESSION Utilisateur
if (isset($_POST["nomUser"])) {
    $_SESSION["nomUser"] = $_POST["nomUser"];
    $_SESSION["prenomUser"] = $_POST["prenomUser"];
    $_SESSION["mdpUser"] = $_POST["mdpUser"];
    $_SESSION["pseudoUser"] = $_POST["pseudoUser"];
    $_SESSION["emailUser"] = $_POST["emailUser"];

    require_once("fonctions.php");
    $Menuadmin = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);
   if(isset($Menuadmin[0]['admin'])){
        if($Menuadmin[0]['admin'] == "1")
        {
            $_SESSION['ADMIN'] = true;
        }
}
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
 include_once("head.php");
 ?>
  <title>Accueil</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>

    <div class="container-fluid">
	<div class="row">
    <div class="col-5 col-sm-5 col-md-8 col-lg-8 col-xl-8 p-2"><h1 class="m-2 text-white">Le site des histoires que c'est toi qui choisis!!!</h1></div>
		<div class="titleframe col-7 col-sm-7 col-md-4 col-lg-4 col-xl-4 order-1 p-1 shadow border">

<?php
if (!isset($_SESSION["emailUser"])) {
    //Si l'e-mail n'est pas renseigné on affiche le form de création compte
    include_once 'form.php';
} else {
    //echo "<div>Bonjour, " . $_SESSION['emailUser'] . "</div>";

    //Sinon on utilise les infos dispo pour vérification du droit d'accés...
    //require_once("fonctions.php");
    require_once("fonctions.php");
    $pseudo = selectUser($_SESSION['mdpUser'], $_SESSION['emailUser']);

    //Si la vérification est négative, on détruit les infos SESSION
    if ($pseudo == null) {
        $txtpseudo = "Utilisateur inconnu dans la base de données...";
        session_unset();
        // session_destroy();
        session_write_close();
        setcookie(session_name(), '', 0, '/');
        $_SESSION['nomUser'] = null;
        
        echo "Erreur dans la saisie du mot de passe ou compte inexistant!!!"
        ?>
        <div><a href="index.php"><button class="bottom rounded-1 border border-none m-1">Je veux réessayer</button></a></div>
        <div><a href="forminscription.php"><button class="bottom rounded-1 border border-none m-1">Je veux créer un compte</button></a></div>
        <?php
    } else {
        //Si la vérification est positive, on redirige vers la page des histoires
        require_once("fonctions.php");
        $admin = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);

        if($admin[0]['actifUser'] != "1")
        {
            header('refresh:3;url=deconnexion.php');
            echo "Compte banni ou désactivé.";
        }elseif($admin[0]['admin']==1){
            echo "Bonjour, vous êtes un ADMIN!!!<br>";
            echo "<br>Admin <strong>" . $pseudo . " </strong> reconnu.";
        }else{
           echo "Bonjour, " . $pseudo .".<br>"."<br>Nous sommes ravis de vous voir sur notre site!";
        }
    }
}
?>
<!-- Fin de la div col Form-->
</div>
<!-- Fin de la div ROW-->
</div>
<br>
<?php
if (isset($_SESSION["emailUser"])) {
    ?>
   <!--Ici, il y a une autre div--> 
<div class="row">
		<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
       
        </div>
		<div class="titleframe3 col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
        <?php

    echo "Quoi tu veux faire?";
?>
</div>
	</div>
	<div class="row">
		<button class="choice1 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 bg-warning text-center"><a class="nav-link" href="compte.php">Accéder à mon compte</a></button>
		<button class="choice2 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 bg-warning text-center"><a class="nav-link" href="perso.php">Accéder à mes persos</a></button>
	</div>
	<div class="row">
		<button class="choice3 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 bg-warning text-center">
            <a href="mailto:sebrou01@gmail.com?cc=remyroyer@gamil.com,&subject=Mail envoyé depuis notre Website&body=Bonjour, ">Nous contacter</a>
        </button>
		<button class="choice4 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 bg-warning text-center"><a class="nav-link" href="histoire.php">Commencer une histoire</a></button>
	</div>
	<div class="row">
		<div class="titleframe2 col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9 text-center"><h6>🍌🥸POWERED BY AdaM&DeV🥸🍌</h6></div>
		<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
	</div>
</div>
<?php
}
?>



<!-- Fin de la div container-->
</div>



<!--<div class="container">
	<div class="row">
		<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">AdaM&DeV</div>
		<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 ">Se connecter</div>
		<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">Hambuger</div>
	</div>
	<div class="row">
		<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">Lieu</div>
		<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">Evénement</div>
	</div>
	<div class="row">
		<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Choix 1</div>
		<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Choix 2</div>
	</div>
	<div class="row">
		<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Choix 3</div>
		<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Choix 4</div>
	</div>
	<div class="row">
		<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
		<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">POWERED BY AdaM&DeV</div>
		<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
	</div>
</div>-->

                <style>
                    body {
                    background: url("img/equipiers.png") no-repeat center center fixed;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    background-size: cover;
                    -o-background-size: cover;
                    }

                    .titleframe{
                        background-color: rgba(255,255,255,.50);
                        border-top-left-radius: 15px;
                        /* height: 8em; */
                    }
                    .titleframe2{
                        background-color: rgba(255,255,255,.50);
                        border-bottom-right-radius: 15px;
                        height: auto;
                        padding-top: 5px;
                    }

                    .titleframe3{
                        background-color: rgba(255,255,255,.50);
                        border-top-left-radius: 15px;
                        height: 12em;
                        margin-top: auto;
                    }
                    .choice1,.choice2,.choice3,.choice4{
                        box-sizing: border-box;
                        -moz-box-sizing: border-box;
                        -webkit-box-sizing: border-box;
                        height: 6em;
                        opacity:75%;
                        -webkit-box-shadow: 6px 4px 15px 0px rgba(164,152,153,0.5); 
                        box-shadow: 6px 4px 15px 0px rgba(164,152,153,0.5);
                    }
                    .choice1{
                        border-bottom: 0.15rem solid darkgoldenrod;
                    }
                    .choice2{
                        border-left: .15px solid darkgoldenrod;
                    }
                    .choice3{
                        border-right: .15px solid darkgoldenrod;
                    }
                    .choice4{
                        border-top: .15px solid darkgoldenrod;
                    }
                   
a:link, a:visited {
  text-decoration: none;
  
}


                </style>


</body>
</html>