<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Formulaire de connexion</title>
</head>
<body>
<!-- <a href="index.php">Retour à l'accueil</a> -->
    <div class="container">
        <h5>J'ai déjà un compte,</h5>
        <form action="index.php" method='POST'>
            <!--<div class="invisible">
                <label for="nomUser">Nom :</label>-->
                <input type="text" id="nomUser" name="nomUser" hidden>
           <!--  </div>
           <div class="invisible">
                <label for="prenomUser">Prenom :</label>-->
                <input type="text" id="prenomUser" name="prenomUser" hidden>
            <!--</div>-->
            <div>
                <label for="emailUser">Email :</label><br>
                <input class="inputshadow w-100" type="email" id="emailUser" name="emailUser" required>
            </div>
            <br>
            <div>
                <label for="mdpUser">Mot de passe :</label>
                <input class="inputshadow w-100" type="password" id="mdpUser" name="mdpUser" required>
            </div>
            <!--<div class="invisible">
                <label for="pseudoUser">Pseudo :</label>-->
                <input type="text" id="pseudoUser" name="pseudoUser"  hidden>
            <!--</div>-->
            <button class="bottom rounded-1 border border-none m-1" type="submit" value="envoyer">Envoyer</button>
            <br>
        </form>
        <br>
        <h5>Je n'ai pas de compte,</h5>
        <form action="forminscription.php" method="POST">
        <input class="bottom rounded-1 border border-none m-1" type="submit" value="Je veux créer un compte">
    </form>
    </div>

    <style>
        .inputshadow{
    box-shadow: inset 8px 8px 16px #d1d1d1, inset -8px -8px 16px #e9e9e9;
    border: none;
    border-radius: 3px;
        }   
    </style>

</body>
</html>