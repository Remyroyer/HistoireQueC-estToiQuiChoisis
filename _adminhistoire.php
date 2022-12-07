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
    <title>Histoire</title>
</head>
<body>
    <?php

echo
    "<div class='p-2'>
    <form action='addhistoire.php' method='post'>
    <label for='histoireNom'>Histoire :</label><input type='text' name='histoireNom'>
    <label for='histoireAuteur'>Auteur :</label><input type='text' name='histoireAuteur'><br>
    <label for='histoireDescription'><br>Description :</label><br><input type='text' name='histoireDescription' class='form-control input-lg'><br>
    <label for='histoireGenre'><br>Genre :</label><input type='text' name='histoireGenre'><br>
    <input type='number' value='10' name='lapin'>
    </div>";
    $oskour=$_POST['lapin']; ?>
<div class="row">    
    <div class="col-2 rounded-left border border-info"></div>
    <div class="col-8 p-2 border border-warning overflow-auto" id='lapin'><?php

for ($n=1;$n<=$oskour;$n++){
    echo "<div class='container vertical-scrollable border border-dark rounded-top p-1'>
        <label for='lieuNom'>Lieu :</label><input type='text' name='lieuNom' value='".""."'>
        <label for='lieuImg'>Image :</label><input type='text' name='lieuImg' hidden>
        <label for='lieuCouleur'>Couleur :</label><input type='text' name='lieuCouleur' hidden><br>
        <label for='actionsNom'>Evénement :</label><input type='text' name='eventNom' class='col-xs-2'>
            <div class='p-1'>";
                if($n<$oskour){
                    echo "<fieldset>
                    <label for='eventHistoireIdEvenement' class='ms-4'>Action :</label><input type='text' name='eventHistoireIdEvenement' value='".""."'>
                    <input type='radio' id='contactChoice1' name='action' value='' />

                    <label for='eventHistoireIdEvenement' class='ms-4'>Action :</label><input type='text' name='eventHistoireIdEvenement' value='".""."'>
                    <input type='radio' id='contactChoice2' name='action' value='' />

                    <label for='eventHistoireIdEvenement' class='ms-4'>Action :</label><input type='text' name='eventHistoireIdEvenement' value='".""."'>
                    <input type='radio' id='contactChoice3' name='action' value='' />

                    <label for='eventHistoireIdEvenement' class='ms-4'>Action :</label><input type='text' name='eventHistoireIdEvenement' value='".""."'>
                    <input type='radio' id='contactChoice4' name='action' value='' />
                    </fieldset>";
                }
                if($n==$oskour){
                    echo "<br>
                    <button type='submit' value='envoyer'>Envoyer</button>
                    </form>";
                }
                ?>
            </div>
        </div><br>
<?php
}
?>
</div><div class="col-2"></div></div class="row">
    <br>


</body>
</html>