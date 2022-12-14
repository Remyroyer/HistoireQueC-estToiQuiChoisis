<?php
//Ouverture de la connexion à la BDD
function connexion()
{
    try {
        // Connexion à la base de données
        $connexion = new PDO('mysql:host=localhost;dbname=histoire_que_cest_toi_qui_decide;charset=utf8', 'root', '');
        // echo "Connexion Bdd Réussi";

    } catch (Exception $e) {
        //Gestion d'erreur
        die("Erreur: " . $e->getMessage());
    }
    return $connexion;
}

//Fermeture de la connexion à la BDD
function deconnexion()
{
    $connexion = null;
    return $connexion;
}

//Affichage du pseudo du joueur uniquement (trop restrictive!)
function selectUser($mdpUser, $emailUser)
{

    $mdpUser = md5($mdpUser);

    $connexion = connexion();

    $insert_query = "SELECT pseudoUser FROM utilisateur WHERE mdpUser=:mdpUser AND emailUser=:emailUser;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':mdpUser', $mdpUser);
    $insert_statement->bindParam(':emailUser', $emailUser);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result['0']['pseudoUser'];
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Ajout nouvel utilisateur
function addUser($nomUser, $prenomUser, $mdpUser, $pseudoUser, $emailUser)
{
    $connexion = connexion();
    $mdpUser = md5($mdpUser);
    // echo $nomUser . " " . $prenomUser . " " .  $mdpUser . " " .  $pseudoUser . " " . $emailUser;
    try {
        $insert_query = "INSERT INTO utilisateur (nomUser, prenomUser, mdpUser, dateCreationUser, actifUser, pseudoUser, emailUser, admin) 
VALUES (:nomUser, :prenomUser, :mdpUser, :dateCreationUser, :actifUser, :pseudoUser, :emailUser, :admin);";
// $nomUser=$_POST['nomUser'];
        // $prenomUser=$_POST['prenomUser'];
        // $mdpUser=$_POST['mdpUser'];
        $dateCreationUser = date("Y-n-j");
        $actifUser = 1;
        // $pseudoUser=$_POST['pseudoUser'];
        // $emailUser=$_POST['emailUser'];
        $admin = 0;

        $insert_statement = $connexion->prepare($insert_query);

//Restreindre les infos suivant les paramêtres de la BDD
        //nomUser->varchar(50)
        // $nomUser=
        //prenomUser->varchar(50)
        // $prenomUser=
        //mdpUser->varchar(200)
        // $mdpUser=
        //dateCreationUser, actifUser, admin
        //AUTOMATIQUES
        //pseudoUser->varchar(50)
        // $pseudoUser=
        //emailUser->varchar(100)
        // $emailUser=

        $insert_statement->bindParam(':nomUser', $nomUser);
        $insert_statement->bindParam(':prenomUser', $prenomUser);
        $insert_statement->bindParam(':mdpUser', $mdpUser);
        $insert_statement->bindParam(':dateCreationUser', $dateCreationUser);
        $insert_statement->bindParam(':actifUser', $actifUser);
        $insert_statement->bindParam(':pseudoUser', $pseudoUser);
        $insert_statement->bindParam(':emailUser', $emailUser);
        $insert_statement->bindParam(':admin', $admin);

        $insert_statement->execute();
        $insert_statement = null;

    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
        header('Location: forminscription.php');
        //Erreur dans la création du compte...
    }

    $connexion = deconnexion();
}

//Pour affichage histoire
function affichagehistoire($idhistoire){
    $connexion = connexion();
    try {
        $insert_query = "SELECT * FROM histoire WHERE Id_histoire=:Id_histoire";

        $insert_statement = $connexion->prepare($insert_query);

        $insert_statement->bindParam(':Id_histoire', $idhistoire);

        $insert_statement->execute();
        $result = $insert_statement->fetchAll();

        if ($result != false) {
            return $result;
        }

        $insert_statement = null;


    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
    }

    $connexion = deconnexion();


}



//Pour affichage des différentes histoires
function selectStory()
{
    $connexion = connexion();
    try {
        $insert_query = "SELECT * FROM histoire WHERE actif='1'";

        $insert_statement = $connexion->prepare($insert_query);

        $insert_statement->execute();
        $result = $insert_statement->fetchAll();


        if ($result != false) {
            return $result;
        }

        $insert_statement = null;


    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
    }

    $connexion = deconnexion();
}

function selectStoryADMIN()
{
    $connexion = connexion();
    try {
        $insert_query = "SELECT * FROM histoire";

        $insert_statement = $connexion->prepare($insert_query);

        $insert_statement->execute();
        $result = $insert_statement->fetchAll();


        if ($result != false) {
            return $result;
        }

        $insert_statement = null;


    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
    }

    $connexion = deconnexion();
}

//Connaitre le lien entre l'histoire et les events de l'histoire
function selecteventhistoire($idhistoire)
{
    $connexion = connexion();

    $insert_query = "SELECT Id_evenement FROM eventhistoire WHERE id_histoire=:id_histoire;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':id_histoire', $idhistoire);
    $insert_statement->execute();

    $result = $insert_statement->fetchAll();

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Affichage des events
function selectEvent($idEvent)
{
    $connexion = connexion();

    $insert_query = "SELECT * FROM evenement WHERE Id_evenement=:Id_evenement;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_evenement', $idEvent);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll();

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Affichage du lieu
function selectLieu($idlieu)
{
    $connexion = connexion();

    $insert_query = "SELECT * FROM lieu WHERE Id_lieu=:Id_lieu;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_lieu', $idlieu);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll();

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();

}

//Connaitres le lien entre les events et les actions 
function selectaction($idEvenement)
{
    $connexion = connexion();

    $insert_query = "SELECT * FROM actionevent WHERE Id_evenement=:Id_evenement;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_evenement', $idEvenement);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll();

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Affichage des actions
function selectActions($idaction)
{
    $connexion = connexion();

    $insert_query = "SELECT nomAction FROM actions WHERE Id_actions=:Id_actions;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_actions', $idaction);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll();

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Affichage des infos du compte utilisateur
function selectCompte($mdpUser, $emailUser)
{
    $connexion = connexion();
    $mdpUser = md5($mdpUser);

    $insert_query = "SELECT * FROM utilisateur WHERE mdpUser=:mdpUser AND emailUser=:emailUser;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':mdpUser', $mdpUser);
    $insert_statement->bindParam(':emailUser', $emailUser);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Mise à jour du compte utilisateur
function updateUser($id, $prenom, $mdpUser, $pseudo, $mail, $actif)
{
    $connexion = connexion();
    $mdpUser = md5($mdpUser);

    $insert_query = "UPDATE utilisateur SET prenomUser=:prenomUser, mdpUser=:mdpUser, actifUser=:actifUser, pseudoUser=:pseudoUser, emailUser=:emailUser WHERE Id_utilisateur=:Id_utilisateur;";
    $insert_statement = $connexion->prepare($insert_query);


    $insert_statement->bindParam(':prenomUser', $prenom);
    $insert_statement->bindParam(':mdpUser', $mdpUser);
    $insert_statement->bindParam(':actifUser', $actif);
    $insert_statement->bindParam(':pseudoUser', $pseudo);
    $insert_statement->bindParam(':emailUser', $mail);
    $insert_statement->bindParam(':Id_utilisateur', $id);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();
}

//Affichage des différents persos dispo pour un utilisateur
function selectPerso($idUser)
{
    $connexion = connexion();

    $insert_query = "SELECT * FROM perso WHERE Id_utilisateur=:Id_utilisateur AND actifPerso=:actifPerso";
    $insert_statement = $connexion->prepare($insert_query);

    $actifPerso = 1;

    $insert_statement->bindParam(':Id_utilisateur', $idUser);
    $insert_statement->bindParam(':actifPerso', $actifPerso);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

//Ajouter un nouveau perso pour un utilisateur
function insertPerso($nomPerso, $sexePerso, $idUtilisateur)
{
    $connexion = connexion();
    try {
        $insert_query = "INSERT INTO perso (nomPerso, sexePerso, Id_utilisateur) 
VALUES (:nomPerso, :sexePerso, :Id_utilisateur);";

        $insert_statement = $connexion->prepare($insert_query);

        $insert_statement->bindParam(':nomPerso', $nomPerso);
        $insert_statement->bindParam(':sexePerso', $sexePerso);
        $insert_statement->bindParam(':Id_utilisateur', $idUtilisateur);
        $insert_statement->execute();
        $insert_statement = null;

    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
    }
    $connexion = deconnexion();
}

//Désactiver un perso
function desactiveperso($idperso)
{
    $connexion = connexion();

    $insert_query = "UPDATE perso SET actifPerso=:actifPerso WHERE Id_perso=:Id_perso;";
    $insert_statement = $connexion->prepare($insert_query);

    $actifPerso = 0;

    $insert_statement->bindParam(':Id_perso', $idperso);
    $insert_statement->bindParam(':actifPerso', $actifPerso);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();

}

//Afficher le perso selectionné
function selectOnePerso($idPerso)
{
    $connexion = connexion();

    $insert_query = "SELECT * FROM perso WHERE Id_perso=:Id_perso";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_perso', $idPerso);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();
}

function updateperso($idPerso, $nomPerso, $sexePerso)
{
    $connexion = connexion();

    $insert_query = "UPDATE perso SET nomPerso=:nomPerso, sexePerso=:sexePerso WHERE Id_perso=:Id_perso;";
    $insert_statement = $connexion->prepare($insert_query);

    $sexe = substr($sexePerso, 0, 15);

    $insert_statement->bindParam(':Id_perso', $idPerso);
    $insert_statement->bindParam(':nomPerso', $nomPerso);
    $insert_statement->bindParam(':sexePerso', $sexe);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();
}

function modifhistoire($id_histoire,$nomHistoire,$auteurHistoire,$descriptionHistoire,$genreHistoire,$actif){
    $connexion = connexion();

    $insert_query = "UPDATE histoire SET nomHistoire=:nomHistoire, auteurHistoire=:auteurHistoire, descriptionHistoire=:descriptionHistoire,
    genreHistoire=:genreHistoire, actif=:actif WHERE Id_histoire=:Id_histoire;";
    $insert_statement = $connexion->prepare($insert_query);

 if ($actif=='on'){
    $actif2=1;
 }else{
    $actif2=0;
 }

    $insert_statement->bindParam(':Id_histoire', $id_histoire);
    $insert_statement->bindParam(':nomHistoire', $nomHistoire);
    $insert_statement->bindParam(':auteurHistoire', $auteurHistoire);
    $insert_statement->bindParam(':descriptionHistoire', $descriptionHistoire);
    $insert_statement->bindParam(':genreHistoire', $genreHistoire);
    $insert_statement->bindParam(':actif', $actif2);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();
}

function updateLieu($Id_lieu,$nomLieu,$imgLieu,$couleurLieu){
    $connexion = connexion();

    $insert_query = "UPDATE lieu SET nomLieu=:nomLieu ,imgLieu=:imgLieu ,couleurLieu=:couleurLieu WHERE Id_lieu=:Id_lieu";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':nomLieu', $nomLieu);
    $insert_statement->bindParam(':imgLieu', $imgLieu);
    $insert_statement->bindParam(':couleurLieu', $couleurLieu);
    $insert_statement->bindParam(':Id_lieu', $Id_lieu);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();
}

function updateEvent($Id_evenement,$nomEvent){
    $connexion = connexion();

    $insert_query = "UPDATE evenement SET nomEvent=:nomEvent WHERE Id_evenement=:Id_evenement";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_evenement', $Id_evenement);
    $insert_statement->bindParam(':nomEvent', $nomEvent);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();


}

function updateActions($Id_actions,$nomAction){
    $connexion = connexion();

    $insert_query = "UPDATE actions SET nomAction=:nomAction WHERE Id_actions=:Id_actions";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_actions', $Id_actions);
    $insert_statement->bindParam(':nomAction', $nomAction);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();
}

function updateactionevent($Id_actions,$radio,$i){


    $connexion = connexion();

    $insert_query = "UPDATE actionevent SET ok=:ok WHERE Id_actions=:Id_actions";
    
    $insert_statement = $connexion->prepare($insert_query);

if($radio==$i){
    $ok='1';
}else{
    $ok='0';
}

    $insert_statement->bindParam(':Id_actions', $Id_actions);
    $insert_statement->bindParam(':ok', $ok);

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();

}

function selectutilisateur(){
    $connexion = connexion();

    $insert_query = "SELECT * FROM utilisateur;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();  
}

function selectIdutilisateur($Id_utilisateur){
    $connexion = connexion();

    $insert_query = "SELECT * FROM utilisateur WHERE Id_utilisateur=:Id_utilisateur;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_utilisateur', $Id_utilisateur);

    $insert_statement->execute();

    $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result;
    }

    $insert_statement = null;

    $connexion = deconnexion();  
}

function adminUpdateUser($Id_utilisateur,$admin,$nomUser,$prenomUser,$mdpUser,$actifUser,$pseudoUser,$emailUser,$imgUser)
{
    $connexion = connexion();


    if($mdpUser!=''){
        $mdpUser = md5($mdpUser);
    $insert_query = "UPDATE utilisateur SET nomUser=:nomUser,prenomUser=:prenomUser,mdpUser=:mdpUser,actifUser=:actifUser,pseudoUser=:pseudoUser,emailUser=:emailUser,admin=:admin,imgUser=:imgUser WHERE Id_utilisateur=:Id_utilisateur;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':mdpUser', $mdpUser);
    $insert_statement->bindParam(':Id_utilisateur', $Id_utilisateur);
    $insert_statement->bindParam(':admin', $admin);
    $insert_statement->bindParam(':nomUser', $nomUser);
    $insert_statement->bindParam(':prenomUser', $prenomUser);
    $insert_statement->bindParam(':actifUser', $actifUser);
    $insert_statement->bindParam(':pseudoUser', $pseudoUser);
    $insert_statement->bindParam(':emailUser', $emailUser);
    $insert_statement->bindParam(':imgUser', $imgUser);

    }else{
    $insert_query = "UPDATE utilisateur SET nomUser=:nomUser,prenomUser=:prenomUser,actifUser=:actifUser,pseudoUser=:pseudoUser,emailUser=:emailUser,admin=:admin,imgUser=:imgUser WHERE Id_utilisateur=:Id_utilisateur;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_utilisateur', $Id_utilisateur);
    $insert_statement->bindParam(':admin', $admin);
    $insert_statement->bindParam(':nomUser', $nomUser);
    $insert_statement->bindParam(':prenomUser', $prenomUser);
    $insert_statement->bindParam(':actifUser', $actifUser);
    $insert_statement->bindParam(':pseudoUser', $pseudoUser);
    $insert_statement->bindParam(':emailUser', $emailUser);
    $insert_statement->bindParam(':imgUser', $imgUser);
    }

    $insert_statement->execute();
    $insert_statement = null;

    $connexion = deconnexion();
}

?>

<!-- Fonction JS -->
<script>
    function JSConfDesact() {
        const checked = document.querySelector('#actif:checked') !== null;
        alert ("Vous avez fait une modification sur votre compte, il risque d'être supprimé");
    }
</script>