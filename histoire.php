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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <title>Histoires</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a>
<a href="compte.php">Mon Compte</a>
<a href="perso.php">Changer/Créer Perso</a>
<?php

//Supprime les infos de l'histoire précédente...
setcookie('idHistoire', "");
setcookie('idEvent', "");
setcookie('nbcoups', 0);

//Requete SQL pour affichage des histoires
require_once("fonctions.php");
$result = selectStory();

?>
<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom de l'histoire</th>
        <th scope="col">Auteur</th>
        <th scope="col">Description de l'histoire</th>
        <th scope="col">Genre de l'histoire</th>
        <th scope="col">Choisir cette histoire</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $a = 0;
    //Boucle sur toutes les histoires
    foreach ($result as $resultat) {

        ?>
        <form action="gameplay.php" method="post">
            <tr>
                <th scope="row"><?php echo $a; ?></th>
                <td><?php echo $result[$a]['nomHistoire']; ?></td>
                <td><?php echo $result[$a]['auteurHistoire']; ?></td>
                <td><?php echo $result[$a]['descriptionHistoire']; ?></td>
                <td><?php echo $result[$a]['genreHistoire']; ?></td>
                <td><input type="submit"><input type="text" name="id_histoire"
                                                value="<?php echo $result[$a]['Id_histoire']; ?>" hidden></td>
            </tr>
        </form>
        <?php
        $a++;
    }
    ?>
    </tbody>
</table>


</body>
</html>

