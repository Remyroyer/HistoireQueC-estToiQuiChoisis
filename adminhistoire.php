<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Histoire</title>
</head>
<body>
    

<?php
if(empty($_SESSION['histoireNom'])){
echo
    "<form action='addhistoire.php' method='post'>
    <label for='histoireNom'>Histoire :</label><input type='text' name='histoireNom'>
    <label for='histoireAuteur'>Auteur :</label><input type='text' name='histoireAuteur'>
    <label for='histoireDescription'>Description :</label><input type='text' name='histoireDescription'>
    <label for='histoireGenre'>Genre :</label><input type='text' name='histoireGenre'>
    <button type='submit' value='envoyer'>Envoyer</button>
    </form>";

}elseif(empty($_SESSION['lieuNom'])){ 
    echo
    "<form action='addhistoire.php' method='post'>
    <label for='lieuNom'>Lieu :</label><input type='text' name='lieuNom'>
    <label for='lieuImg'>Image :</label><input type='text' name='lieuImg' hidden>
    <label for='lieuCouleur'>Couleur :</label><input type='text' name='lieuCouleur' hidden>
    <button type='submit' value='envoyer'>Envoyer</button>
    </form>";

}elseif(empty($_SESSION['actionsNom'])){ 
    echo
    "<form action='addhistoire.php' method='post'>
    <label for='actionsNom'>Action :</label><input type='text' name='actionsNom'>
    <button type='submit' value='envoyer'>Envoyer</button>
    </form>";
}elseif(empty($_SESSION['evenementNom'])){ 
    echo
    "<form action='addhistoire.php' method='post'>
    <label for='evenementNom'>Action :</label><input type='text' name='evenementNom'>
    <label for='evenementLieu'>Lieu :</label><input type='text' name='evenementLieu' value='".$_SESSION['lieuIdNom']."'>
    <button type='submit' value='envoyer'>Envoyer</button>
    </form>";
}elseif(empty($_SESSION['eventHistoireIdEvenement'])){ 
    echo
    "<form action='addhistoire.php' method='post'>
    <label for='eventHistoireIdEvenement'>Action :</label><input type='text' name='eventHistoireIdEvenement' value='".$_SESSION['']."'>
    <button type='submit' value='envoyer'>Envoyer</button>
    </form>";
}

?>




</body>
</html>