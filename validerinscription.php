<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION['nomUser'])){header('Location: index.php');}

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
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <title>Que C'est toi qui choisi l'histoire...</title>
</head>
<body> 
<a href="index.php">Retour à l'accueil</a><br>
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
            header('refresh:3;url=histoire.php');
            echo "Vous allez être redirigé vers la page des histoires, dans un instant!";
        } catch(Exception $e){
            //Gestion d'erreur
            $txtpseudo="Cette adresse mail existe déjà!";
            echo $txtpseudo;
            echo "Vous allez être redirigé vers l'accueil dans un instant!";
            header('refresh:3;url=validerinscription.php');
            die();
        } 
            

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