<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}
//Affichage des infos utilisateur
require_once("fonctions.php");
$result = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Compte utilisateur</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>



<div class="container">

<form action="modifcompte.php" method="POST">
    <div class="card" style="width: 20rem;">
<div style="width: 5rem;">
        <img src="img/<?php echo $result[0]['imgUser']; ?>" class="card-img-top" alt="Avatar du joueur" background-size= contains>
        </div>   
        <div class="card-body">
            <h5 class="card-title">Nom : <input type="text" name="nom" size="20"
                                                value="<?php echo $result[0]['nomUser']; ?>"
                                                disabled="disabled"></h5>
            <p class="card-text"><input type="text" name="idUser" size="2"
                                        value="<?php echo $result[0]['Id_utilisateur']; ?>" hidden></p>
            <p class="card-text">Prénom : <input type="text" name="prenom" size="18"
                                                 value="<?php echo $result[0]['prenomUser']; ?>" required></p>
                                                 <span class="text-warning bg-dark">Le mot de passe est nécessaire pour toute modification :</span>
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
                <p class="card-text">Actif: <input type="checkbox" name="actif" onchange="JSConfDesact()" ></p>
                <?php
            } else {
                ?>
                <p class="card-text">Actif: <input type="checkbox" name="actif" onchange="JSConfDesact()" checked ></p>        
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
</div>



</body>
</html>