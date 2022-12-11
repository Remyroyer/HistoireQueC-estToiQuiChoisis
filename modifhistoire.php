<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}

//Requete SQL pour affichage des histoires
include_once("fonctions.php");
$result =selectStoryADMIN();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Modifier les histoires</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>
<!--Affichage des histoires-->
<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom de l'histoire</th>
        <th scope="col">Auteur</th>
        <th scope="col">Description de l'histoire</th>
        <th scope="col">Genre de l'histoire</th>
        <th scope="col">Modifier cette histoire</th>
        <th scope="col">Histoire active</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $a = 0;
    //Boucle sur toutes les histoires
    foreach ($result as $resultat) {
        ?>
        <form action="validmodifhistoire.php" method="post">
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
                <td>
                    <?php
                if($result[$a]['actif']==1){
                    echo "<input type='checkbox' name='actif' checked='on' disabled='disabled'>";
                }else{
                    echo "<input type='checkbox' name='actif' disabled='disabled'>";
                }
                    ?>
            </td>
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