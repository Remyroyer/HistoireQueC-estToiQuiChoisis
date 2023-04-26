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
<?php
 include_once("head.php");
 ?>
    <title>Modification du compte</title>
</head>
<body>

<?php



//Vérification si mot de passe modifié correctement ou pas modifié
if (isset($_POST['mdp']) && !empty($_POST['mdp1']) && $_POST['mdp1'] == $_POST['mdp2'] && $_POST['mdp'] == $_SESSION["mdpUser"]) {
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
    //header('refresh:3;url=deconnexion.php');
    //echo "Mise à jour effectuée, merci de vous reconnecter";
    //sinon, modification $_SESSION
    $_SESSION["mdpUser"] = $_POST["mdp1"];
    $_SESSION["emailUser"] = $_POST["mail"];
    header('refresh:3;url=compte.php');
    echo "Mise à jour effectuée A, vous allez être redirigé vers la page 'Mon compte' dans un instant!";

} elseif (isset($_POST['actif']) && $_POST['mdp'] == $_SESSION["mdpUser"]) {
    $actif = 1;
    require_once("fonctions.php");
    // var_dump($_POST['idUser']);
    updateUser($_POST['idUser'], $_POST['prenom'], $_POST['mdp'], $_POST['pseudo'], $_POST['mail'], $actif);
    //Redirection
    //header('refresh:3;url=deconnexion.php');
    //echo "Mise à jour effectuée, merci de vous reconnecter";
    //sinon, modification $_SESSION
    $_SESSION["mdpUser"] = $_POST["mdp"];
    $_SESSION["emailUser"] = $_POST["mail"];
    header('refresh:3;url=compte.php');
    if ($_POST['mdp1'] != $_POST['mdp2']){
        echo "Mise à jour partiellement effectuée, mot de passe non modifié, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
    }else{
        echo "Mise à jour effectuée, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
    }

} elseif (!isset($_POST['actif']) && $_POST['mdp'] == $_SESSION["mdpUser"]) {
    $actif = 0;
    require_once("fonctions.php");
    // var_dump($_POST['idUser']);
    updateUser($_POST['idUser'], $_POST['prenom'], $_POST['mdp'], $_POST['pseudo'], $_POST['mail'], $actif);
    //Redirection
    //header('refresh:3;url=deconnexion.php');
    //echo "Mise à jour effectuée, merci de vous reconnecter";
    //sinon, modification $_SESSION
    $_SESSION["mdpUser"] = $_POST["mdp"];
    $_SESSION["emailUser"] = $_POST["mail"];
    header('refresh:3;url=compte.php');
    echo "Mise à jour effectuée, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
} else {
    
    //Si le mot de passe est incorrectement modifié, on redirige sans mise à jour
    header('refresh:3;url=compte.php');
    echo "Erreur dans la saisie du mot de passe, vous allez être redirigé vers la page 'Mon compte' dans un instant!";
}


?>

</body>
</html>