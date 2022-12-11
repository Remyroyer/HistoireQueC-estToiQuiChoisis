<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}

if(!isset($_POST['Id_utilisateur'])){
    //    var_dump($_COOKIE['modifhistoire']);
        $_POST['Id_utilisateur']=$_COOKIE['modifcompte'];
        setcookie('modifcompte', '', time() + 3600 * 24, '/', '', false,false);
    }
    
    if (!isset($_POST['Id_utilisateur'])&&!isset($_COOKIE['modifcompte'])){
        header('Location: admincompte.php');
    }

    include_once("fonctions.php");
    $result=selectIdutilisateur($_POST['Id_utilisateur']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Visualisation des comptes utilisateurs</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>

<div class="container">
<form action="saveadmincompte.php" method="post">
<div>
<div class="row w-75 p-2">
    <div class="col-2">
    </div>
    <div class="lapinou col-6 border border-warning">
        <?php    
        if($result[0]['admin']==1){
            echo "COMPTE ADMIN : <br>";
            echo "<input type='checkbox' name='admin' checked='on'><small class='p-1'>Sélectionner pour passer ce compte en utilisateur classique!</small><br>";
        }else{
            echo "COMPTE UTILISATEUR : <br>";
            echo "<input type='checkbox' name='admin'><small class='p-1'>Déselectionner pour passer ce compte en Administrateur!</small><br>";
        }
        ?>
    </div>
    </div>
    </div>

    <div class="row w-75 p-2">
        <div class="col-2">
    <label for="nomUser">Nom : </label>
    </div>
        <div class="col-10">
    <input class="form-control" type="text" name="nomUser" value="<?php echo $result[0]['nomUser']; ?>"required>
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    <label for="prenomUser">Prénom : </label>
    </div>
    <div class="col-10">
    <input class="form-control" type="text" name="prenomUser" value="<?php echo $result[0]['prenomUser']; ?>"required>
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    <label for="mdpUser">Mot de passe : </label>
    </div>
    <div class="col-10">
    <input class="form-control" type="text" name="mdpUser" value="">
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    <label for="dateCreationUser">Date de création du compte : </label>
    </div>
    <div class="col-10">
    <input class="form-control" type="text" name="dateCreationUser" value="<?php echo $result[0]['dateCreationUser']; ?>" disabled>
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    </div>
    <div class="lapinou col-6 border border-warning">
        ETAT DU COMPTE :
        <?php
    if($result[0]['actifUser']==1){
    echo "<br><input type='checkbox' name='actifUser' checked='on'><small class='p-1'>Sélectionner pour désactiver ce compte!</small><br>";
}else{
    echo "<br><input type='checkbox' name='actifUser'><small class='p-1'>Déselectionner pour réactiver ce compte!</small><br>";
}
?>
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    <label for="pseudoUser">Pseudo : </label>
    </div>
    <div class="col-10">
    <input class="form-control" type="text" name="pseudoUser" value="<?php echo $result[0]['pseudoUser']; ?>"required>
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    <label for="emailUser">Email : </label>
    </div>
    <div class="col-10">
    <input class="form-control" type="text" name="emailUser" value="<?php echo $result[0]['emailUser']; ?>"required>
    </div>
    </div>

    <div class="row w-75 p-2">
    <div class="col-2">
    <label for="imgUser">Nom du fichier image : </label>
    </div>
    <div class="col-10">
    <input class="form-control" type="text" name="imgUser" value="<?php echo $result[0]['imgUser']; ?>">
    </div>
    </div>
    <div class="w-75 p-2">
    <div class="w-25 p-2">
    <input class="form-control bg-info" type="submit"><input type="text" name="Id_utilisateur" value="<?php echo $result[0]['Id_utilisateur']; ?>" hidden>
    </div>
    </div>

    </form>
    </div>





</body>
</html>