<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

//Requete SQL pour connaitre Id utilisateur
require_once("fonctions.php");
$result = selectCompte($_SESSION['mdpUser'], $_SESSION['emailUser']);

// echo $result[0]['Id_utilisateur']."<br>";

$resultat = selectPerso($result[0]['Id_utilisateur']);
setcookie('idUtilisateur', $result[0]['Id_utilisateur'], time() + 3600 * 24, '/', '', false, false);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Page Personnage</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>

<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom du perso</th>
        <th scope="col">Sexe du perso</th>
        <?php
        if (!isset($_GET["vue"])){
            echo "<th scope='col'>Choisir ce perso</th>";
        }
        ?>
           <th scope='col'>Modifier ce perso</th>
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
                           <?php 
                           if (!isset($_GET["vue"])){
                            echo "<td><input type='submit'></td>";
                           }
                           ?>
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
            <?php if (!isset($_GET["vue"])){
            echo "<td></td>";
            }
            ?>
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