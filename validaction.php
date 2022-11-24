<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION['nomUser'])){header('Location: index.php');}

var_dump ($_POST['eventval']);
setcookie('idHistoire', $_POST['idhistoire'], time()+3600*24, '/', '', false, false);

var_dump($_COOKIE['idHistoire']);

if ($_POST["actionval"]==="1"){
    echo "Choix valide!<br>";
    setcookie('idEvent', intval($_POST["eventval"])+1);
    setcookie('nbcoups', $_COOKIE['nbcoups']-1);
    header('Location: gameplay.php');
}else{
    echo "Choix non valide!<br>";
    setcookie('idEvent', intval($_POST["eventval"]));
    setcookie('nbcoups', intval($_COOKIE['nbcoups'])+1);
    header('Location: gameplay.php');
}


echo $_COOKIE['idEvent'];


?>