<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

date_default_timezone_set('Europe/Paris');
date_default_timezone_get();
if (isset($_POST["nomUser"])){
$_SESSION["nomUser"]=$_POST["nomUser"];
$_SESSION["prenomUser"]=$_POST["prenomUser"];
$_SESSION["mdpUser"]=$_POST["mdpUser"];
$_SESSION["pseudoUser"]=$_POST["pseudoUser"];
$_SESSION["emailUser"]=$_POST["emailUser"];
}
if(isset($_POST["nomUSer"])){
if(!isset($_COOKIE['utilisateur'])||empty($_COOKIE['utilisateur'])){
setcookie('utilisateur',$_SESSION["nomUser"]."/".$_SESSION["prenomUser"]."/".$_SESSION["emailUser"],time()+360,null,null,false,true);}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Que C'est toi qui choisi l'histoire...</title>
</head>
<body> 
    <?php
    if(!isset($_POST["nomUser"])){
        include_once 'form.php';
    }else{
        echo "<div>Ouaich, " . $_SESSION['emailUser'] . "</div>";
        //Recherche

        require_once("fonctions.php");
        $pseudo = selectUser($_SESSION['mdpUser'],$_SESSION['emailUser']);

        if($pseudo==null){
            try{
            //$txtpseudo="Utilisateur ajouté dans la base de données...";
            require_once("fonctions.php");
            addUser($_SESSION["nomUser"], $_SESSION["prenomUser"], $_SESSION["mdpUser"], $_SESSION["pseudoUser"], $_SESSION["emailUser"]);
        
        } catch(Exception $e){
            //Gestion d'erreur
            $txtpseudo="Cette adresse mail existe déjà!";
            echo $txtpseudo;
            echo "Vous allez être redirigé vers l'accueil dans un instant!";
            header('refresh:3;url=validerinscription.php');
            die();
        } 
            header('refresh:3;url=index.php');
            echo "Vous allez être redirigé vers la page de connexion dans un instant!";

        }else{
            $txtpseudo="Cette adresse mail existe déjà!";
        }

        //echo $txtpseudo;
    }
    ?>
    <br>
    <div><form action="deconnexion.php" method="POST"><input type="submit" value="Déconnexion"></form></div>


</body>
</html>