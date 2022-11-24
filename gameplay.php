<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION['nomUser'])){header('Location: index.php');}

if(isset($_POST['id_histoire'])){
  $idhistoire= $_POST['id_histoire'];
setcookie('idhistoire', $idhistoire, time()+3600*24, '/', '', false, false);
setcookie('idEvent', 1, time()+3600*24, '/', '', false, false);
setcookie('nbcoups', 0, time()+3600*24, '/', '', false, false);
}else{
  if(isset($_COOKIE['idHistoire'])){
  $idhistoire= $_COOKIE['idhistoire'];
  }else{
    header('Location: histoire.php');
  }
}


if(isset($_POST['nomPerso'])){
  $rest=$_POST['nomPerso'];
setcookie('nomPerso',$rest);
}else{
if(!isset($_COOKIE['nomPerso'])){
  echo "Il n'y a pas le nom du perso...";
  header('Location: perso.php');
}else{
  //setcookie('nomPerso',$_COOKIE['nomPerso']);
  echo "IL MANQUE QUELQUE CHOSE?";
}}
// echo "<br>". "IDHISTOIRE: " . $_COOKIE['idHistoire'] ."<br>";
 //echo "<br>". "NOM PERSO: " . $_POST['nomPerso'] . "<->" . $rest . "<==>" . $_COOKIE['nomPerso'] ."<br>";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <title>Gameplay</title>
</head>
<body>
<a href="index.php">Retour à l'accueil</a><br>
<a href="histoire.php">Page des histoires</a><br>
<a href="compte.php">Mon Compte</a>
<a href="perso.php">Changer/Créer Perso</a>
    <?php
echo "Vous avez choisi l'histoire: " . $idhistoire;

?><br><?php

require_once("fonctions.php");
$result=selecteventhistoire($idhistoire);
$a=0;


echo "Nombre de coups en cours: " . $_COOKIE['nbcoups']; ?><br><?php
if ($_COOKIE['nbcoups']>=3){
  header('Location: perdu.php');
}



if (isset($_POST['nomPerso'])){
  echo "Ton perso s'appel: " . $_POST['nomPerso'] . "<br>";

}else{
  if(isset($_COOKIE['nomPerso'])){
    echo "Ton perso s'appel: " . $_COOKIE['nomPerso'] . "<br>";

  }
}



?>
<div class="card">
<?php

foreach ($result as $resultat){
//var_dump($resultat);
?><?php

  $idEvent= $result[$a]['Id_evenement'];
  $a++;

  require_once("fonctions.php");
  $resultEvent=selectevent($idEvent);

if($idEvent>=$_COOKIE['idEvent']){

  echo $idEvent;

  $idlieu = $resultEvent[0]['Id_lieu'];
  $resultLieu=selectLieu($idlieu);
  ?><br><?php
  echo "Votre situation dans l'espace: ";
  echo $resultLieu[0]['nomLieu'];
  ?><br><?php
  echo "Ce qui ce passe: ";
  echo $resultEvent[0]['nomEvent'];
  $idEvenement=$resultEvent[0]['Id_evenement'];
  ?><br><?php
  echo "Vos choix:";
  $resultchoix=selectaction($idEvenement);
  
  if(!is_null($resultchoix)){
  foreach ($resultchoix as $resultaction){
    ?>
  <form action="validaction.php" method="POST">
  <?php
    //var_dump($resultaction["Id_actions"]);
  $idaction=$resultaction["Id_actions"];
  $actionok=$resultaction["ok"];
  $resultaction=selectActions($idaction);
  ?>
  
  <input type="text" name="idhistoire" value="<?php echo $idhistoire; ?>" hidden>
  <input type="text" name="eventval" value="<?php echo $idEvenement; ?>" hidden>
 <input type="text" name="actionval" value="<?php echo $actionok; ?>" hidden>
  <?php
  ?>
  <button type="submit">
    <?php
      echo $resultaction[0]["nomAction"];
    ?>
  </button>
  </form>
<?php  
}
break;
}else{

echo "<br>" . "Fin de l'histoire...";

  //header('Location: gagne.php');
  //Bouton de redirection...





  }
}
}
?>
</div>
<?php
?>
<br>

</body>
</html>

