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
    <title>Mise à jour des events</title>
</head>
<body>
<?php

$count=$_POST['count'];

for($n=0;$n<=$count-1;$n++){
    $nom=$_POST['nomEvent'.$n];
    echo "Lieu : " . $_POST['nomLieu'.$n]."<br>";
    $idLieu= $_POST['IdLieu'.$n];
    $Id_evenement= $_POST['IdEvent'.$n];

    if(isset($_POST['imgLieu'.$n])){
        $imgLieu= $_POST['imgLieu'.$n];
    }
   else{
    $imgLieu="";
   }
   if(isset($_POST['couleurLieu'.$n])){
    $couleurLieu= $_POST['couleurLieu'.$n];
    }
    else{
    $couleurLieu="";
    }
    
    include_once("fonctions.php");
    updateLieu($idLieu,$_POST['nomLieu'.$n],$imgLieu,$couleurLieu);
    updateEvent($Id_evenement,$nom);

    echo "Evénement " . $n+1 . " : " . $nom ."<br>";

        for ($i=0;$i<=3;$i++){
            if(isset($_POST['nomAction'.$n.$i])){
                $radio=$_POST['action'.$n];
                if($radio==$i){
                    echo "<input type='radio' id='contactChoice$i+1' name='action.$n' checked='on' required>";
                }else{
                    echo "<input type='radio' id='contactChoice$i+1' name='action.$n' required>";
                }
                $Id_actions= $_POST['Id_actions'.$n.$i];
                updateactionevent($Id_actions,$radio,$i);
              

            echo "Action " .$i+1 . ": ".$_POST['nomAction'.$n.$i]."<br>";
            $nomAction= $_POST['nomAction'.$n.$i];
            updateActions($Id_actions,$nomAction);
        // echo $_POST['action'.$n];
        }
    }

    
    

    echo "<br>___________________<br>";
    

}

//echo $_POST['id_histoire'];
setcookie('modifhistoire', $_POST['id_histoire'], time() + 3600 * 24, '/', '', false,false);
header('refresh:3;url=validmodifhistoire.php');
echo "<br>" . "Vous allez être redirigé vers les modifications... ";
?>
</body>
</html>