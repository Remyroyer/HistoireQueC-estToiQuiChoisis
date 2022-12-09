<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}

if (!isset($_POST['lapin'])){
    $oskour=10;
}else{
    $oskour=$_POST['lapin'];
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
<a href="index.php">Accueil</a><br>
<div class="container">
<div class="border border-dark w-100">
<?php

if(!isset($_POST['lapin'])){
echo "Combien d'événements dans votre histoire?" . "<br>
<form action='adminhistoire.php' method ='POST'>
    <input type='number' class='p-1 px-2' value=$oskour name='lapin' min='2' max='50'>
    <div><br></div>
    <button type='submit' class='form-control bg-info w-25' value='envoyer'>Envoyer</button>
    </form><br></div>";
}
    echo
    "<div class='p-2'>
    <form action='addhistoire.php' method='POST'>
    <label for='histoireNom'>Histoire :</label><input class='form-control w-75'type='text' name='histoireNom' required>
    <label for='histoireAuteur'>Auteur :</label><input class='form-control w-25'type='text' name='histoireAuteur' required><br>
    <label for='histoireDescription'><br>Description :</label><br><input class='form-control w-75'type='text' name='histoireDescription' class='form-control input-lg' required><br>
    <label for='histoireGenre'><br>Genre :</label><input class='form-control w-25' type='text' name='histoireGenre' required><br>
    </div>";
    ?>
    
<div class="row">    
    <div class="col-2 rounded-left"></div>
    <div class="col-8 p-2 border border-warning overflow-auto" id='lapin'><?php

for ($n=1;$n<=$oskour;$n++){
    echo "<div class='container vertical-scrollable border border-dark rounded-top p-1'>
        <label for='lieuNom'>Lieu :</label><input class='form-control' type='text' name='lieuNom$n' required>
        <label for='lieuImg' hidden>Image :</label><input class='form-control' type='text' name='lieuImg$n' hidden>
        <label for='lieuCouleur' hidden>Couleur :</label><input class='form-control' type='text' name='lieuCouleur$n' hidden><br>
        <label for='actionsNom'>Evénement :</label><input class='form-control' type='text' name='eventNom$n' class='col-xs-2' required>
            <div class='p-1'>";
                if($n<$oskour){
                    echo "<fieldset>
                    <div>
                    <label for='eventHistoireIdEvenement' class='ms-3'>Actions :</label>
                    <br>
                    <div class='row justify-content-start'>
                    <div class='col-11'>
                    <input type='text' class='form-control' name='eventHistoireIdEvenement1$n' value='' required>
                    </div>
                    <div class='col-1'>
                    <input type='radio' id='contactChoice1' name='action$n' value='1' required/>
                    </div>
                    </div>

                    <div class='row justify-content-start'>
                    <div class='col-11'>
                    <input type='text' class='form-control' name='eventHistoireIdEvenement2$n' value='' required>
                    </div>
                    <input type='radio' id='contactChoice2' name='action$n' value='2' required />
                    </div>
                    
                    <div class='w-75'>
                    <input type='text' class='form-control' name='eventHistoireIdEvenement3$n' value='' required>
                    <input type='radio' id='contactChoice3' name='action$n' value='3' required />
                    </div>
                    
                    <div class='w-75'>
                    <input type='text' class='form-control' name='eventHistoireIdEvenement4$n' value='' required>
                    <input type='radio' id='contactChoice4' name='action$n' value='4' required />
                    </div>
                    </div>
                    </fieldset>";
                }
                if($n==$oskour){
                    echo "<br>
                    <input type='number' name='nbEvent' value='$n' hidden>
                    <button class='form-control bg-info w-25' type='submit' value='envoyer'>Envoyer</button>
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

    </div>
</body>
</html>