<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

require_once("fonctions.php");
$result = selectOnePerso($_POST['idPerso']);
//var_dump($result);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Page Modification Personnage</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="img/simone.png" alt="image du perso">
    <div class="card-body">
        <form action="validmodifperso.php" method="POST">
            <input name="idPerso" value="<?php echo $_POST['idPerso'] ?>" hidden>
            <h5 class="card-title"><input name="nomPerso" value="<?php echo $result[0]['nomPerso'] ?>" required></h5>
            <p class="card-text">
            <div>
                Sexe: <input name="sexePerso" value="<?php echo $result[0]['sexePerso'] ?>" required>
            </div>
            <br>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
</div>

</body>
</html>