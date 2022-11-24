<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Formulaire de connexion</title>
</head>
<body>
   <!-- <a href="index.php">Retour à l'accueil</a> -->
    <div>
        <form action="forminscription.php" method="POST">
            <input type="submit" value="Je veux créer un compte">
        </form>
        <div class="container">
    <form action="index.php" method='POST'>

<div class="invisible">
    <label for="nomUser">Nom :</label>
    <input type="text" id="nomUser" name="nomUser">
</div>
<div class="invisible">
    <label for="prenomUser">Prenom :</label>
    <input type="text" id="prenomUser" name="prenomUser">
</div>
<div>
    <label for="mdpUser">Mot de passe :</label>
    <input type="password" id="mdpUser" name="mdpUser" required>
</div>
<div class="invisible">
    <label for="pseudoUser">Pseudo :</label>
    <input type="text" id="pseudoUser" name="pseudoUser">
</div>
<div>
    <label for="emailUser">E-mail&nbsp;:</label>
    <input type="email" id="emailUser" name="emailUser" required>
</div>
<br>
<button type="submit" value="envoyer">Se connecter</button>
<br>
</form>
    </div>
    </div>

    

</body>
</html>