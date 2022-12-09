<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}

if(!isset($_POST['id_histoire'])){
//    var_dump($_COOKIE['modifhistoire']);
    $_POST['id_histoire']=$_COOKIE['modifhistoire'];
    setcookie('modifhistoire', '', time() + 3600 * 24, '/', '', false,false);
}

if (!isset($_POST['id_histoire'])&&!isset($_COOKIE['modifhistoire'])){
    header('Location: modifhistoire.php');
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
    <title>Modification des histoires</title>
</head>
<body>
<a href="index.php">Accueil</a> / <a href='modifhistoire.php'>Modifier une histoire</a><br>
<?php

include_once("fonctions.php");
$idhistoire=$_POST['id_histoire'];
$result=affichagehistoire($idhistoire);
?>
<br>
<div class="container">
<div class="form-group row border border-dark p-2">
<form action="histoiremodif.php" method="POST">
<input type='text' class="form-control" name='id_histoire' value="<?php echo $result[0]['Id_histoire']; ?>" hidden>
<div class="w-75">
<br>Titre : <input type='text' class="form-control" name='nomHistoire' value="<?php echo $result[0]['nomHistoire']; ?>">
</div>
<div class="w-50">
<br>Auteur : <input type='text' class="form-control" name='auteurHistoire' value="<?php echo $result[0]['auteurHistoire']; ?>">
</div>
<div class="w-100">
<br>Description : <input type='text' class="form-control" name='descriptionHistoire' value="<?php echo $result[0]['descriptionHistoire']; ?>">
</div>
<br>Genre : <input type='text' name='genreHistoire' value="<?php echo $result[0]['genreHistoire']; ?>"><br>
<?php
if($result[0]['actif']==1){
    echo "<br>Histoire active : <input type='checkbox' name='actif' checked='on'>";
}else{
    echo "<br>Histoire active : <input type='checkbox' name='actif'>";
}
?>
<div class="w-25"><br>
<input class="form-control bg-info" type="submit">
<br></div>
</form>
</div>

<div class="form-group row border border-dark p-2">
    <?php
$resultat=selecteventhistoire($idhistoire);
$count=count($resultat);
    ?>
<form action="eventmodif.php" method="POST">
<input type='text' name='id_histoire' value="<?php echo $idhistoire;?>" hidden>
<?php
for ($n=0;$n<=$count-1;$n++){
// echo "idEvent : ".$resultat[$n]['Id_evenement']."<br>";
$idevent=$resultat[$n]['Id_evenement'];
?>
<div class='w-25'>
<input type='text' class="form-control" name='<?php echo "IdEvent".$n; ?>' value="<?php echo $resultat[$n]['Id_evenement'];?>" hidden>
</div>
<?php

$result=selectEvent($idevent);
// echo "Lieu : " . $result[0]['Id_lieu']."<br>";
$idlieu=$result[0]['Id_lieu'];
$resu=selectLieu($idlieu);
?>
<div class='w-50'>
<input type='text' class="form-control" name='<?php echo "IdLieu".$n; ?>' value="<?php echo $result[0]['Id_lieu'];?>" hidden>
</div>
<?php
echo "<div class='w-50'>";
echo "Lieu : ";?><input class="form-control" type='text' name='<?php echo "nomLieu".$n; ?>' value="<?php echo $resu[0]['nomLieu'];?>"><?php
echo "</div>";

if(isset($resu[0]['imgLieu'.$n])){
?>
<input type='text' class="form-control" name='<?php echo "imgLieu".$n; ?>' value="<?php echo $resu[0]['imgLieu'.$n];?>" hidden>
<?php
}
if(isset($resu[0]['couleurLieu'.$n])){
?>

<input type='text' class="form-control" name='<?php echo "couleurLieu".$n; ?>' value="<?php echo $resu[0]['couleurLieu'.$n];?>" hidden>
<?php
// echo "Image : ".$resu[0]['imgLieu'.$n]."<br>";
// echo "Couleur : ".$resu[0]['couleurLieu'.$n]."<br>";
}

echo "Evénement : "; ?>
<div class='w-85'>
<input type='text' class="form-control" name='<?php echo "nomEvent".$n; ?>' value="<?php echo $result[0]['nomEvent'];?>">
</div>
<?php
echo "<br>";

$res=selectaction($idevent);
if(!is_null($res)){
    for($i=0;$i<=3;$i++){
        // echo $res[$i]['Id_actions'];
        ?>
        <div class='w-75'>
        <input type='text' class="form-control" name='<?php echo "Id_actions".$n.$i; ?>' value="<?php echo $res[$i]['Id_actions'];?>" hidden>
        </div>
        <div class='row w-75'>
        <div class="col-1">
        <?php
        $idaction=$res[$i]['Id_actions'];
        $action=selectActions($idaction);
        if($res[$i]['ok']=='1'){
            echo "<input type='radio' id='contactChoice$i+1' name='action$n' value='$i' checked='on' required>";
        }else{
            echo "<input type='radio' id='contactChoice$i+1' name='action$n' value='$i' required>";
        }
        ?>
        </div>
        <div class='col-11'>
        <input type='text' class='form-control' name='<?php echo "nomAction".$n.$i; ?>' value="<?php echo $action[0]['nomAction'];?>">
        </div>    
    </div>
        <?php echo "<br>";
    }
}else{echo "<br>Fin de l'aventure....";}
echo "<br>__________________________<br>";
}
 
?>
<input type='text' name='count' value="<?php echo $count ?>" hidden>
<div class='w-25'>
<input class='form-control bg-info' type="submit">
</div>
</form>

</div>
</div>

</body>
</html>