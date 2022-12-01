<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

date_default_timezone_set('Europe/Paris');
date_default_timezone_get();

//Infos à retourner pour la modification du compte
//Création de la SESSION Utilisateur
if (isset($_POST["nomUser"])) {
    $_SESSION["nomUser"] = $_POST["nomUser"];
    $_SESSION["prenomUser"] = $_POST["prenomUser"];
    $_SESSION["mdpUser"] = $_POST["mdpUser"];
    $_SESSION["pseudoUser"] = $_POST["pseudoUser"];
    $_SESSION["emailUser"] = $_POST["emailUser"];
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Que C'est toi qui choisi l'histoire...</title>
</head>
<body>

<?php
if (isset($_SESSION)) {
    ?>
    <a href="compte.php">Mon Compte</a>
    <a href="histoire.php">Page des histoires</a>
    <br>
    <a href="coloriage.php">....VISUALISER LE COLORIAGE....</a>
    <br>
    <?php
}

if (!isset($_POST["emailUser"])) {
    //Si l'e-mail n'est pas renseigné on affiche le form de création compte
    include_once 'form.php';
} else {
    echo "<div>Ouaich, " . $_SESSION['emailUser'] . "</div>";

    //Sinon on utilise les infos dispo pour vérification du droit d'accés...
    require_once("fonctions.php");
    $pseudo = selectUser($_SESSION['mdpUser'], $_SESSION['emailUser']);

    //Si la vérification est négative, on détruit les infos SESSION
    if ($pseudo == null) {
        $txtpseudo = "Utilisateur inconnu dans la base de données...";
        session_unset();
        // session_destroy();
        session_write_close();
        setcookie(session_name(), '', 0, '/');
        $_SESSION['nomUser'] = null;
        ?>
        <form action="forminscription.php" method="POST">
            <input type="submit" value="Je veux créer un compte">
        </form>
        <?php
    } else {
        //Si la vérification est positive, on redirige vers la page des histoires
        $txtpseudo = "Utilisateur reconnu: " . $pseudo;
        header('refresh:3;url=histoire.php');
        echo "Vous allez être redirigé vers la page des histoires, dans un instant!";
    }

    echo $txtpseudo;
}
?>
<br>
<div>
    <form action="deconnexion.php" method="POST"><input type="submit" value="Déconnexion"></form>
</div>


</body>
</html>