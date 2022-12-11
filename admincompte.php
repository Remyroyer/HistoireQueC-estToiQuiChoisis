<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}

include_once("fonctions.php");
$result=selectutilisateur();

// var_dump($result);
$count = count($result);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Visualisation des comptes utilisateurs</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>
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