<?php
//Ouverture SESSION
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//Vérification compte utilisateur sinon redirection
if (!isset($_SESSION['ADMIN'])) {
    header('Location: index.php');
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout histoire</title>
</head>
<body>
    
<?php
// include('fonctions.php');
// $connexion = connexion();

// try {

//         $insert_query = "INSERT INTO histoire (nomHistoire, auteurHistoire, descriptionHistoire, genreHistoire, actif) 
// VALUES (:nomHistoire, :auteurHistoire, :descriptionHistoire, :genreHistoire, :actif);";
        
//         $insert_statement = $connexion->prepare($insert_query);

//         $actif= 1;
//         $insert_statement->bindParam(':nomHistoire', $_SESSION['histoireNom']);
//         $insert_statement->bindParam(':auteurHistoire', $_SESSION['histoireAuteur']);
//         $insert_statement->bindParam(':descriptionHistoire', $_SESSION['histoireDescription']);
//         $insert_statement->bindParam(':genreHistoire', $_SESSION['histoireGenre']);
//         $insert_statement->bindParam(':actif', $actif);

//         $insert_statement->execute();
//         $insert_statement = null;

//     } catch (Exception $e) {
//         //Gestion d'erreur
//         // die();
//         header('Location: lieuhistoire.php');
//         //Erreur dans la création du compte...
//     }
//     $connexion = deconnexion();

?>

//Requête Lieu


//Requete pour connaitre Id du lieu
//Ajout Id dans session
//$_SESSION['lieuIdNom']=




//Requête evenementNom
//Requête pour connaitre Id de evenement
//Ajout des 1 Id dans session
//$_SESSION['evenementId']



</body>
</html>