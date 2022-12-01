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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <title>Page Modification Personnage</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a><br>
<a href="histoire.php">Page des histoires</a><br>
<a href="compte.php">Mon Compte</a><br>

<?php
require_once("fonctions.php");
$result = selectOnePerso($_POST['idPerso']);
//var_dump($result);
?>

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