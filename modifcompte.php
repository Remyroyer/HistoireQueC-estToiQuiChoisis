<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['nomUser'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Modification du compte</title>
</head>
<body>

<?php


//En cas de compte rendu inactif, il faut lui demander de valider!!!!

//Vérification si mot de passe modifié correctement ou pas modifié



if (isset($_POST['mdp']) && !empty($_POST['mdp1']) && $_POST['mdp1'] == $_POST['mdp2']) 
{
    if (isset($_POST['actif'])) {
        $actif = 1;
    } else {
        $actif = 0;
    }
    //Requete SQL pour mise à jour du compte utilisateur
    require_once("fonctions.php");
    // var_dump($_POST['idUser']);
    updateUser($_POST['idUser'], $_POST['prenom'], $_POST['mdp1'], $_POST['pseudo'], $_POST['mail'], $actif);
    //Redirection
    //header('refresh:3;url=index.php');
    //ou vers
    header('refresh:3;url=deconnexion.php');
    echo "Mise à jour effectuée, merci de vous reconnecter";

}elseif (isset($_POST['actif'])) 
{
    $actif = 1;
    require_once("fonctions.php");
    // var_dump($_POST['idUser']);
    updateUser($_POST['idUser'], $_POST['prenom'], $_POST['mdp'], $_POST['pseudo'], $_POST['mail'], $actif);
    //Redirection
    header('refresh:3;url=compte.php');
    echo "Mise à jour effectuée, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
} elseif (!isset($_POST['actif']))
{
    $actif = 0;
    require_once("fonctions.php");
    // var_dump($_POST['idUser']);
    updateUser($_POST['idUser'], $_POST['prenom'], $_POST['mdp'], $_POST['pseudo'], $_POST['mail'], $actif);
    //Redirection
    header('refresh:3;url=compte.php');
    echo "Mise à jour effectuée, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
}else {
    //Si le mot de passe est incorrectement modifié, on redirige sans mise à jour
    header('refresh:3;url=compte.php');
    echo "Erreur dans la saisie du mot de passe, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
}





?>

</body>
</html>