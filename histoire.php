<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

//Supprime les infos de l'histoire précédente...
setcookie('idHistoire', "", time() + 3600 * 24, '/', '', false,false);
setcookie('idEvent', "", time() + 3600 * 24, '/', '', false,false);
setcookie('nbcoups', 0, time() + 3600 * 24, '/', '', false,false);

//Requete SQL pour affichage des histoires
require_once("fonctions.php");
$result = selectStory();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Histoires</title>
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
                                                value="<?php echo $result[$a]['Id_histoire']; ?>" hidden>
                    <input type="text" name="debuthistoire"
                           value="true" hidden></td>
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

