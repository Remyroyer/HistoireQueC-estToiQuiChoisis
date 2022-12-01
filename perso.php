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
    <title>Page Personnage</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a><br>
<a href="histoire.php">Page des histoires</a><br>
<a href="compte.php">Mon Perso</a><br>

<?php
//Requete SQL pour connaitre Id utilisateur
require_once("fonctions.php");
$result = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);

// echo $result[0]['Id_utilisateur']."<br>";

$resultat = selectPerso($result[0]['Id_utilisateur']);
setcookie('idUtilisateur', $result[0]['Id_utilisateur'], time() + 3600 * 24, '/', '', false, false);
?>

<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom du perso</th>
        <th scope="col">Sexe du perso</th>
        <th scope="col">Choisir ce perso</th>
        <th scope="col">Modifier ce perso</th>
        <th scope="col">Supprimer ce perso</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $a = 0;
    //Si l'utilisateur a déjà des perso, on les affiches
    if (!is_null($resultat)){
    foreach ($resultat as $result) {
        ?>
        <tr>
            <form action="gameplay.php" method="POST">
                <th scope="row"><?php echo $a + 1; ?></th>
                <td><input name="nomPerso" value="<?php echo $resultat[$a]['nomPerso']; ?>"
                           hidden><?php echo $resultat[$a]['nomPerso']; ?></td>
                <td><input name="sexePerso" value="<?php echo $resultat[$a]['sexePerso']; ?>"
                           hidden><?php echo $resultat[$a]['sexePerso']; ?></td>
                <td><input type="submit"></td>
                <input type="text" name="debuthistoire"
                                                value="true" hidden></td>
                </form>
                <!--Modification du perso -->
                <form action="modifperso.php" method="POST">
                <td><input name="idPerso" value="<?php echo $resultat[$a]['Id_perso']; ?>"
                           hidden><input type="submit"></td>
                </form>

                <!--Mise en cache du perso -->
                <form action="cacheperso.php" method="POST">
                <td><input name="idPerso" value="<?php echo $resultat[$a]['Id_perso']; ?>"
                           hidden><input type="submit"></td>
                </form>
        </tr>
        <?php
        $a++;
    }
    //On propose de créer un nouveau perso...
    ?>
    <tr>
        <form action="validerperso.php" method="POST">
            <th scope="row"><?php echo $a + 1; ?></th>
            <td><input name="nomPerso" value="Nouveau perso"></td>
            <td><input name="sexePerso" value="Femelle"></td>
            <td><input type="submit"></td>
            <td></td>
            <td></td>
        </form>
    </tr>
    </tbody>
</table>
<?php
//Si l'utilisateur n'a pas de perso, on propose également de créer un nouveau perso...
} else {
    ?>
    <tr>
        <form action="validerperso.php" method="POST">
            <th scope="row"><?php echo $a + 1; ?></th>
            <td><input name="nomPerso" value="Nouveau perso"></td>
            <td><input name="sexePerso" value="Femelle"></td>
            <td><input type="submit"></td>
            <td></td>
            <td></td>
        </form>
    </tr>
    </tbody>
    </table>
    <?php
}
?>


</body>
</html>