<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Compte utilisateur</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a><br>
<a href="histoire.php">Page des histoires</a><br>
<?php

//Affichage des infos utilisateur
require_once("fonctions.php");
$result = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);
?>
<form action="modifcompte.php" method="POST">
    <div class="card" style="width: 20rem;">

        <img src="<?php echo $result[0]['imgUser']; ?>" class="card-img-top" alt="Avatar du joueur" height=200>
        <div class="card-body">
            <h5 class="card-title">Nom : <input type="text" name="nom" size="20"
                                                value="<?php echo $result[0]['nomUser']; ?>"
                                                disabled="disabled"></h5>
            <p class="card-text"><input type="text" name="idUser" size="2"
                                        value="<?php echo $result[0]['Id_utilisateur']; ?>" hidden></p>
            <p class="card-text">Prénom : <input type="text" name="prenom" size="18"
                                                 value="<?php echo $result[0]['prenomUser']; ?>" required></p>
                                                 <span>Le mot de passe est nécessaire pour toute modification :</span>
            <p class="card-text">Mot de passe Actuel : <input type="password" name="mdp" size="24" required></p>
            <p class="card-text">Nouveau mot de passe : <input type="password" name="mdp1" size="24"></p>
            <p class="card-text">Confirmation : <input type="password" name="mdp2" size="24"></p>
            <p class="card-text">Date de création : <input type="text" name="date" size="7"
                                                           value="<?php echo $result[0]['dateCreationUser']; ?>"
                                                           disabled="disabled"></p>
            <?php
            // echo $result[0]['actifUser'];
            if ($result[0]['actifUser'] != 1) {
                ?>
                <p class="card-text">Actif: <input type="checkbox" name="actif"></p>
                <?php
            } else {
                ?>
                <p class="card-text">Actif: <input type="checkbox" name="actif" checked='on'></p>
                <?php
            }
            ?>
            <p class="card-text">Pseudo: <input type="text" name="pseudo" size="24"
                                                value="<?php echo $result[0]['pseudoUser']; ?>" required></p>
            <p class="card-text">E-mail: <input type="email" name="mail" size="28"
                                                value="<?php echo $result[0]['emailUser']; ?>" required></p>
            <p class="card-text"><input type="text" name="admin" size="1"
                                        value="<?php echo $result[0]['admin']; ?>" hidden></p>

            <input type="submit" class="btn btn-primary">
</form>
</div>
</div>

<?php
?>

</body>
</html>