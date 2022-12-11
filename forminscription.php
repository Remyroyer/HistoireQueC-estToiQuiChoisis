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
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>
<div>
    <form action="index.php" method="POST">
        <input type="submit" value="J'ai déjà un compte">
    </form>
    <div class="container">
        <form action="validerinscription.php" method='POST'>

            <div class="">
                <label for="nomUser">Nom :</label>
                <input type="text" id="nomUser" name="nomUser" required>
            </div>
            <div class="">
                <label for="prenomUser">Prenom :</label>
                <input type="text" id="prenomUser" name="prenomUser" required>
            </div>
            <div>
                <label for="mdpUser">Mot de passe :</label>
                <input type="password" id="mdpUser" name="mdpUser" required>
            </div>
            <div class="">
                <label for="pseudoUser">Pseudo :</label>
                <input type="text" id="pseudoUser" name="pseudoUser" required>
            </div>
            <div>
                <label for="emailUser">E-mail&nbsp;:</label>
                <input type="email" id="emailUser" name="emailUser" required>
            </div>
            <br>
            <button type="submit" value="envoyer">S'inscrire</button>
            <br>
        </form>
    </div>
</div>


</body>
</html>