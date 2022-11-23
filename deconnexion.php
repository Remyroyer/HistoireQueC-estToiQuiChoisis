<?php
session_unset();
// session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/');
$_SESSION['nomUser']=null;
header('refresh:3;url=index.php');
echo "Vous allez être redirigé vers l'accueil dans un instant!";
?>