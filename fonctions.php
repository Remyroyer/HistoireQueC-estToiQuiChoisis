<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

function connexion(){
    try{
        // Connexion à la base de données
        $connexion = new PDO('mysql:host=localhost;dbname=histoire_que_cest_toi_qui_decide;charset=utf8', 'root', '');
        // echo "Connexion Bdd Réussi";
    
    } catch(Exception $e){
        //Gestion d'erreur
        die("Erreur: ".$e->getMessage());
    } 
    return $connexion;
}

function deconnexion(){
$connexion = null;
return $connexion;
}

function selectUser($mdpUser, $emailUser){
    $connexion=connexion();

$insert_query = "SELECT pseudoUser FROM utilisateur WHERE mdpUser=:mdpUser AND emailUser=:emailUser;";
        $insert_statement = $connexion->prepare($insert_query);

        $insert_statement->bindParam(':mdpUser', $mdpUser);
        $insert_statement->bindParam(':emailUser', $emailUser);
       
        $insert_statement->execute();
       
        $result = $insert_statement->fetchAll(PDO::FETCH_ASSOC);

        if($result!=false){
            return $result['0']['pseudoUser'];
        }

        $insert_statement = null;

$connexion=deconnexion();
}
function addUser($nomUser, $prenomUser, $mdpUser, $pseudoUser, $emailUser){
    $connexion=connexion();
    // echo $nomUser . " " . $prenomUser . " " .  $mdpUser . " " .  $pseudoUser . " " . $emailUser;
    try{
$insert_query = "INSERT INTO utilisateur (nomUser, prenomUser, mdpUser, dateCreationUser, actifUser, pseudoUser, emailUser, admin) 
VALUES (:nomUser, :prenomUser, :mdpUser, :dateCreationUser, :actifUser, :pseudoUser, :emailUser, :admin);";
// $nomUser=$_POST['nomUser'];
        // $prenomUser=$_POST['prenomUser'];
        // $mdpUser=$_POST['mdpUser'];
        $dateCreationUser=date("Y-n-j");
        $actifUser=1;
        // $pseudoUser=$_POST['pseudoUser'];
        // $emailUser=$_POST['emailUser'];
        $admin=1;
                
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

    } catch(Exception $e){
        //Gestion d'erreur
        // die();
    } 
    
$connexion=deconnexion();
}





?>