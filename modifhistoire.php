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
    <title>Modifier les histoires</title>
</head>
<body>
<a href="index.php">Accueil</a><br>
<?php

//Requete SQL pour affichage des histoires
include_once("fonctions.php");
$result =selectStoryADMIN();
?>

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