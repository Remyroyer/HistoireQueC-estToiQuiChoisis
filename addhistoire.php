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
<?php
 include_once("head.php");
 ?>
    <title>Ajout histoire</title>
</head>
<body>
    
<?php
echo "<br>";
echo "Histoire : ".$_POST['histoireNom']."<br> Auteur : ".$_POST['histoireAuteur']."<br> Description : ".$_POST['histoireDescription']."<br> Genre : ".$_POST['histoireGenre'];
echo "<br>_____________________________________</br>";

for ($n=1;$n<=$_POST['nbEvent'];$n++){
echo "Lieu : ".$_POST['lieuNom'.$n]."<br>".
"Event : ".$_POST['eventNom'.$n]."<br>";

if (isset($_POST['eventHistoireIdEvenement1'.$n])){
echo "Action1 : ".$_POST['eventHistoireIdEvenement1'.$n]."<br>"; 
if($_POST['action'.$n]=='1'){
    echo " Valide : " . $_POST['action'.$n]."<br>";
}

echo "Action2 : ".$_POST['eventHistoireIdEvenement2'.$n]."<br>";
if($_POST['action'.$n]=='2'){
    echo " Valide : " . $_POST['action'.$n]."<br>";
}

echo "Action3 : ".$_POST['eventHistoireIdEvenement3'.$n]."<br>";
if($_POST['action'.$n]=='3'){
    echo " Valide : " . $_POST['action'.$n]."<br>";
}

echo "Action4 : ".$_POST['eventHistoireIdEvenement4'.$n]."<br>";
if($_POST['action'.$n]=='4'){
    echo " Valide : " . $_POST['action'.$n]."<br>";
}
echo "_______________________________________</br>";
}
}

//AJOUT HISTOIRE
include('fonctions.php');
$connexion = connexion();

try {

        $insert_query = "INSERT INTO histoire (nomHistoire, auteurHistoire, descriptionHistoire, genreHistoire, actif) 
VALUES (:nomHistoire, :auteurHistoire, :descriptionHistoire, :genreHistoire, :actif);";
        
        $insert_statement = $connexion->prepare($insert_query);

        $actif= 1;
        $insert_statement->bindParam(':nomHistoire', $_POST['histoireNom']);
        $insert_statement->bindParam(':auteurHistoire', $_POST['histoireAuteur']);
        $insert_statement->bindParam(':descriptionHistoire', $_POST['histoireDescription']);
        $insert_statement->bindParam(':genreHistoire', $_POST['histoireGenre']);
        $insert_statement->bindParam(':actif', $actif);

        $insert_statement->execute();
        $id_histoire= $connexion->lastInsertId();
        $insert_statement = null;
      
    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
        //header('Location: lieuhistoire.php');
        //Erreur dans la création du compte...
    }
    $connexion = deconnexion();



    //AJOUT LIEUX
    try {

        $connexion = connexion();

        for ($n=1;$n<=$_POST['nbEvent'];$n++){
        $insert_query = "INSERT INTO lieu (nomLieu, imgLieu, couleurLieu) 
VALUES (:nomLieu, :imgLieu, :couleurLieu);";
        
        $insert_statement = $connexion->prepare($insert_query);

        $insert_statement->bindParam(':nomLieu', $_POST['lieuNom'.$n]);
        $insert_statement->bindParam(':imgLieu', $_POST['lieuImg'.$n]);
        $insert_statement->bindParam(':couleurLieu', $_POST['lieuCouleur'.$n]);
      
        $insert_statement->execute();   
        $id_Lieu= $connexion->lastInsertId();


            //Début Ajout Evenement
            $connexion2 = connexion();

            try {
                    $insert_query2 = "INSERT INTO evenement (nomEvent, Id_lieu) 
            VALUES (:nomEvent, :Id_lieu);";
                    
                    $insert_statement2 = $connexion2->prepare($insert_query2);
            
                    $insert_statement2->bindParam(':nomEvent', $_POST['eventNom'.$n]);
                    $insert_statement2->bindParam(':Id_lieu', $id_Lieu);
                        
                    $insert_statement2->execute();
                    $Id_evenement=$connexion2->lastInsertId();
                    $insert_statement2 = null;
                  
                } catch (Exception $e) {
                    //Gestion d'erreur
                    // die();
                    //header('Location: lieuhistoire.php');
                    //Erreur dans la création du compte...
                }
                $connexion2 = deconnexion();
            //fin Ajout Evenement

 //Début Ajout EventHistoire
 $connexion3 = connexion();

 try {
         $insert_query3 = "INSERT INTO eventhistoire (Id_histoire, Id_evenement) 
 VALUES (:Id_histoire, :Id_evenement);";
         
         $insert_statement3 = $connexion3->prepare($insert_query3);
 
         $insert_statement3->bindParam(':Id_histoire', $id_histoire);
         $insert_statement3->bindParam(':Id_evenement', $Id_evenement);
             
         $insert_statement3->execute();
         $insert_statement3 = null;
       
     } catch (Exception $e) {
         //Gestion d'erreur
         // die();
         //header('Location: lieuhistoire.php');
         //Erreur dans la création du compte...
     }
     $connexion3 = deconnexion();
 //fin Ajout Evenement

//Ajout des actions
$connexion4 = connexion();
if(isset($_POST['eventHistoireIdEvenement1'.$n])){
try {
        $insert_query4 = "INSERT INTO actions (nomAction) 
VALUES (:nomAction);";
        
        $insert_statement4 = $connexion4->prepare($insert_query4);
        //1ere action
        $insert_statement4->bindParam(':nomAction', $_POST['eventHistoireIdEvenement1'.$n]);
        $insert_statement4->execute();
        $id_action=$connexion4->lastInsertId();
        //Ajout ActionEvent
        if(isset($_POST['action'.$n])){
        $connexion5 = connexion();
        try {
                $insert_query5 = "INSERT INTO actionevent (ok, Id_evenement,Id_actions) 
        VALUES (:ok, :Id_evenement, :Id_actions);";
                
                $insert_statement5 = $connexion5->prepare($insert_query5);


                if($_POST['action'.$n]=='1'){
                    $_ok='1';
                }else{
                    $_ok='0';
                }
                $insert_statement5->bindParam(':ok', $_ok);
                $insert_statement5->bindParam(':Id_evenement', $Id_evenement);
                $insert_statement5->bindParam(':Id_actions', $id_action);  
                $insert_statement5->execute();
                $insert_statement5 = null;
              
            } catch (Exception $e) {
                //Gestion d'erreur
                // die();
                //header('Location: lieuhistoire.php');
                //Erreur dans la création du compte...
            }
            $connexion5 = deconnexion();
        }
        //Fin Ajout ActionEvent
        $insert_statement4 = null;
      
        $insert_statement4 = $connexion4->prepare($insert_query4);
        //2ème action
        $insert_statement4->bindParam(':nomAction', $_POST['eventHistoireIdEvenement2'.$n]);
        $insert_statement4->execute();
        $id_action=$connexion4->lastInsertId();
        //Ajout ActionEvent
        if(isset($_POST['action'.$n])){
        $connexion5 = connexion();

        try {
                $insert_query5 = "INSERT INTO actionevent (ok, Id_evenement,Id_actions) 
        VALUES (:ok, :Id_evenement, :Id_actions);";
                
                $insert_statement5 = $connexion5->prepare($insert_query5);

                if($_POST['action'.$n]=='2'){
                    $_ok='1';
                }else{
                    $_ok='0';
                }
                $insert_statement5->bindParam(':ok', $_ok);
                $insert_statement5->bindParam(':Id_evenement', $Id_evenement);
                $insert_statement5->bindParam(':Id_actions', $id_action);  
                $insert_statement5->execute();
                $insert_statement5 = null;
              
            } catch (Exception $e) {
                //Gestion d'erreur
                // die();
                //header('Location: lieuhistoire.php');
                //Erreur dans la création du compte...
            }
            $connexion5 = deconnexion();
        }
        //Fin Ajout ActionEvent
        $insert_statement4 = null;

        $insert_statement4 = $connexion4->prepare($insert_query4);
        //3ème action
        $insert_statement4->bindParam(':nomAction', $_POST['eventHistoireIdEvenement3'.$n]);
        $insert_statement4->execute();
        $id_action=$connexion4->lastInsertId();
        //Ajout ActionEvent
        if(isset($_POST['action'.$n])){
        $connexion5 = connexion();

        try {
                $insert_query5 = "INSERT INTO actionevent (ok, Id_evenement,Id_actions) 
        VALUES (:ok, :Id_evenement, :Id_actions);";
                
                $insert_statement5 = $connexion5->prepare($insert_query5);

                if($_POST['action'.$n]=='3'){
                    $_ok='1';
                }else{
                    $_ok='0';
                }
                $insert_statement5->bindParam(':ok', $_ok);
                $insert_statement5->bindParam(':Id_evenement', $Id_evenement);
                $insert_statement5->bindParam(':Id_actions', $id_action);  
                $insert_statement5->execute();
                $insert_statement5 = null;
              
            } catch (Exception $e) {
                //Gestion d'erreur
                // die();
                //header('Location: lieuhistoire.php');
                //Erreur dans la création du compte...
            }
            $connexion5 = deconnexion();
        }
        //Fin Ajout ActionEvent
        $insert_statement4 = null;

        $insert_statement4 = $connexion4->prepare($insert_query4);

             //4ème action
             $insert_statement4->bindParam(':nomAction', $_POST['eventHistoireIdEvenement4'.$n]);
             $insert_statement4->execute();
             $id_action=$connexion4->lastInsertId();

        //Ajout ActionEvent
        if(isset($_POST['action'.$n])){
        $connexion5 = connexion();

        try {
                $insert_query5 = "INSERT INTO actionevent (ok, Id_evenement,Id_actions) 
        VALUES (:ok, :Id_evenement, :Id_actions);";
                
                $insert_statement5 = $connexion5->prepare($insert_query5);

                if($_POST['action'.$n]=='4'){
                    $_ok='1';
                }else{
                    $_ok='0';
                }
                $insert_statement5->bindParam(':ok', $_ok);
                $insert_statement5->bindParam(':Id_evenement', $Id_evenement);
                $insert_statement5->bindParam(':Id_actions', $id_action);  
                $insert_statement5->execute();
                $insert_statement5 = null;
              
            } catch (Exception $e) {
                //Gestion d'erreur
                // die();
                //header('Location: lieuhistoire.php');
                //Erreur dans la création du compte...
            }
            $connexion5 = deconnexion();
        }
        //Fin Ajout ActionEvent
   
        $insert_statement4 = null;
    
    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
        //header('Location: lieuhistoire.php');
        //Erreur dans la création du compte...
    }
}
    $connexion4 = deconnexion();


//Fin de l'ajout des actions


        $insert_statement = null;
        }     

    } catch (Exception $e) {
        //Gestion d'erreur
        // die();
        //header('Location: lieuhistoire.php');
        //Erreur dans la création du compte...
    }
    $connexion = deconnexion();

header('refresh:3;url=modifhistoire.php');
echo "<br>" . "Vous allez être redirigé vers la liste des histoires... ";

?>

</body>
</html>