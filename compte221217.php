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

<div class="container-fluid">
	<div class="row">
    <div class="col-5 col-sm-5 col-md-8 col-lg-8 col-xl-8 p-2"><h1 class="m-2 text-white"></h1></div>
		<div class="titleframe col-7 col-sm-7 col-md-4 col-lg-4 col-xl-4 order-1 p-1 shadow border">
        </div>
        </div>
        </div>
        </div>



















<div class="container bg-secondary">
<form action="modifcompte.php" method="POST">
    <div class="card" style="width: 20rem;">
<div class="p-1" style="width: 6rem;">
        <img src="img/<?php echo $result[0]['imgUser']; ?>" class="card-img-top" alt="Avatar du joueur" background-size= contains>
        </div>
        <div class="">
            <input type='file' name="newImg">
        </div>
        <div class="simone card-body">
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

            </style>
</body>
</html>