<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
 include_once("head.php");
 ?>
    <title>Formulaire de connexion</title>
</head>
<body>
<header>
<!-- Navigation -->
<?php
  include_once("menu.php");  
?>
</header>

<div class="container-fluid">
	<div class="row">
    <div class="col-5 col-sm-5 col-md-8 col-lg-8 col-xl-8 p-2"><h1 class="m-2 text-white">Le site des histoires que c'est toi qui choisis!!!</h1></div>
		<div class="titleframe col-7 col-sm-7 col-md-4 col-lg-4 col-xl-4 order-1 p-1 shadow border">
            
    
    <div class="container">
    <h5>Je n'ai pas de compte,</h5>
        <form action="validerinscription.php" method='POST'>
            <div>
                <label for="nomUser">Nom :</label>
                <input class="inputshadow w-100" type="text" id="nomUser" name="nomUser" required>
            </div>
            <br>
            <div>
                <label for="prenomUser">Prenom :</label>
                <input class="inputshadow w-100" type="text" id="prenomUser" name="prenomUser" required>
            </div>
            <br>
            <div>
                <label for="mdpUser">Mot de passe :</label>
                <input class="inputshadow w-100" type="password" id="mdpUser" name="mdpUser" required>
            </div>
            <br>
            <div>
                <label for="pseudoUser">Pseudo :</label>
                <input class="inputshadow w-100" type="text" id="pseudoUser" name="pseudoUser" required>
            </div>
            <br>
            <div>
                <label for="emailUser">E-mail&nbsp;:</label>
                <input class="inputshadow w-100" type="email" id="emailUser" name="emailUser" required>
            </div>
            <button class="bottom rounded-1 border border-none m-1" type="submit" value="envoyer">S'inscrire</button>
            <br>
        </form>
        <br>
        <h5>J'ai déjà un compte,</h5>
        <form action="index.php" method="POST">
        <input class="bottom rounded-1 border border-none m-1" type="submit" value="Je veux me connecter">
    </form>

    </div>
</div>
</div></div></div>



<style>
                    body {
                    background: url("img/equipiers.png") no-repeat center center fixed;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    background-size: cover;
                    -o-background-size: cover;
                    }

                    .titleframe{
                        background-color: rgba(255,255,255,.50);
                        border-top-left-radius: 15px;
                    }
              
        .inputshadow{
    box-shadow: inset 8px 8px 16px #d1d1d1, inset -8px -8px 16px #e9e9e9;
    border: none;
    border-radius: 3px;
        }   
    </style>


</body>
</html>