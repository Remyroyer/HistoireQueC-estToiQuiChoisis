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
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
          <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
          
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="style.css">
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
    <div class="col-5 col-sm-5 col-md-8 col-lg-8 col-xl-8 p-2"><h1 class="m-2 text-white">Le site que c'est toi qui décide des choix!</h1></div>
		<div class="titleframe col-7 col-sm-7 col-md-4 col-lg-4 col-xl-4 order-1 p-1 shadow border">

<?php
if (!isset($_SESSION["emailUser"])) {
    //Si l'e-mail n'est pas renseigné on affiche le form de création compte
    include_once 'form.php';
} else {
    //echo "<div>Bonjour, " . $_SESSION['emailUser'] . "</div>";

    //Sinon on utilise les infos dispo pour vérification du droit d'accés...
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
        <!-- <form action="forminscription.php" method="POST">
            <input type="submit" value="Je veux créer un compte">
        </form> -->
        
        <div><a href="index.php"><button class="bottom rounded-1 border border-none m-1">Je veux réessayer</button></a></div>
        <div><a href="forminscription.php"><button class="bottom rounded-1 border border-none m-1">Je veux créer un compte</button></a></div>
        <?php
    } else {
        //Si la vérification est positive, on redirige vers la page des histoires
        $admin = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);

        if($admin[0]['actifUser'] != "1")
        {
            header('refresh:3;url=deconnexion.php');
            echo "Compte banni ou désactivé.";
        }elseif($admin[0]['admin']==1){
            echo "Bonjour, vous êtes un ADMIN!!!<br>";
            ?>
            <!--<a href="compte.php">Mon Compte</a>
            <a href="histoire.php">Page des histoires</a> -->
            <?php
            $_SESSION['ADMIN'] = true;
            echo "<br>Admin <strong>" . $pseudo . " </strong> reconnu.";
            //echo "<a href='adminhistoire.php'>Ajouter une histoire</a>";
            //echo " / <a href='modifhistoire.php'>Modifier une histoire</a>";
            //echo " / <a href='admincompte.php'>Voir les comptes utilisateurs</a>";
        }else{
           echo "Bonjour, " . $pseudo .".<br>"."<br>Nous sommes ravis de vous revoir sur notre site!";
        }
    }
}
?>
<!-- Fin de la div col Form-->
</div>
<!-- Fin de la div ROW-->
</div>

<div>
<!--Ici, il y a une autre div-->
</div>

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
                    }
                </style>


</body>
</html>