<?php
//On détruit les infos de SESSION utilisateur
session_unset();
// session_destroy();
session_write_close();
setcookie(session_name(), '', time() + 3600 * 24, '/', '', false,false);
$_SESSION['nomUser'] = null;
setcookie('nbcoups', '', time() + 3600 * 24, '/', '', false,false);
setcookie('idEvent', '', time() + 3600 * 24, '/', '', false,false);
setcookie('nomPerso', '', time() + 3600 * 24, '/', '', false,false);
setcookie('idUtilisateur', '', time() + 3600 * 24, '/', '', false,false);
setcookie('idhistoire', '', time() + 3600 * 24, '/', '', false,false);

session_unset();
session_write_close();

//.......................................................
//Ne doit on pas aussi détruire le perso, histoire?

header('refresh:3;url=index.php');
echo "Vous allez être redirigé vers l'accueil dans un instant!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

</body>
</html>