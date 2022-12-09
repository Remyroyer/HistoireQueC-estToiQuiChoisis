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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Visualisation des comptes utilisateurs</title>
</head>
<body>
<a href="index.php">Accueil</a><br>
<?php
include_once("fonctions.php");
$result=selectutilisateur();

// var_dump($result);
$count = count($result);

?>
<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Mot de passe</th>
        <th scope="col">Date création compte</th>
        <th scope="col">Actif</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Email</th>
        <th scope="col">Admin</th>
        <th scope="col">image</th>
        <th scope="col">Modifier</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $a = 0;
    //Boucle sur toutes les histoires
    foreach ($result as $resultat) {
        ?>
        <form action="validadmincompte.php" method="post">
            <tr>
                <th scope="row"><?php echo $a; ?></th>
                <td><?php echo $result[$a]['nomUser']; ?></td>
                <td><?php echo $result[$a]['prenomUser']; ?></td>
                <td><?php echo $result[$a]['mdpUser']; ?></td>
                <td><?php echo $result[$a]['dateCreationUser']; ?></td>
                <td><?php echo $result[$a]['actifUser']; ?></td>
                <td><?php echo $result[$a]['pseudoUser']; ?></td>
                <td><?php echo $result[$a]['emailUser']; ?></td>
                <td><?php echo $result[$a]['admin']; ?></td>
                <td><?php echo $result[$a]['imgUser']; ?></td>
                <td><input type="submit"><input type="text" name="Id_utilisateur" value="<?php echo $result[$a]['Id_utilisateur']; ?>" hidden></td>
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