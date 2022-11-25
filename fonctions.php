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
        $admin = 1;

        $insert_statement = $connexion->prepare($insert_query);

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
    }

    $connexion = deconnexion();
}

//Pour affichage des différentes histoires
function selectStory()
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
function updateUser()
{
    $connexion = connexion();

    $id = $_POST['id'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mdp'];
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];

    if (!isset($_POST['actif'])) {
        $actif = 0;
    } else {
        $actif = 1;
    }
    $insert_query = "UPDATE utilisateur SET prenomUser=:prenomUser, mdpUser=:mdpUser, actifUser=:actifUser, pseudoUser=:pseudoUser, emailUser=:emailUser WHERE Id_utilisateur=:Id_utilisateur;";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':prenomUser', $prenom);
    $insert_statement->bindParam(':mdpUser', $mdp);
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

    $insert_query = "SELECT * FROM perso WHERE Id_utilisateur=:Id_utilisateur";
    $insert_statement = $connexion->prepare($insert_query);

    $insert_statement->bindParam(':Id_utilisateur', $idUser);

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


?>