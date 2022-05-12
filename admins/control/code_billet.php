<?php
session_start();
include '/xampp/htdocs/connexion.php';

// enregistrement dune entite dans la base de donnée
if(isset($_POST['enregistrerbtn']))
{
    $vol = $_POST['vol'];
    $date_d = $_POST['date_d'];
    $pays_d=$_POST['pays_d'];
    $pays_a=$_POST['pays_a'];
    $numero_siege = $_POST['numero_siege'];
    $nom = $_POST['nom'];

        $reussit = null;
        try{
    
        $query = "INSERT INTO billet(nom, date_depart , lieu_depart ,lieu_arrivee, numero_siege, vol, reserver)VALUE(:nom ,:date_depart, :lieu_depart, :lieu_arrivee, :numero_siege, :vol, :reserver)";
        $add=$pdo->prepare($query); 
        $add->execute(
        ['nom'=>$nom,
        'date_depart'=>$date_d,
        'lieu_depart'=>$pays_d,
        'lieu_arrivee'=>$pays_a,
        'numero_siege'=>$numero_siege,
        'vol'=>$vol
            ]);
        }
        catch (PDOException $e) {
            $reussit= $e->getMessage();
        }
    
         if(empty($reussit))
         {
            $_SESSION['success']="Billet ajouté";
            header('location: ../pages/billet.php');
         }
         else{
            $_SESSION['status']="billet non enregistré  $reussit";
            header('location: ../pages/billet.php');
         }  
 
 
}



// modification dune entite dans la base de donnée
if(isset($_POST['updatebtn']))
{
    $reussit=null;
    $id = $_POST['edit_id'];
    $nom = $_POST['edit_nom'];
    $date_de=$_POST['edit_date'];
    $lieu_dep= $_POST['edit_dep'];
    $lieu_arr= $_POST['edit_arr'];
    $vol= $_POST['edit_vol'];
    $siege= $_POST['siege'];

    try{
        $query = $pdo->prepare("UPDATE billet SET nom=:nom , date_depart=:date_dep , lieu_depart=:lieu_d, lieu_arrivee=:lieu_arr, vol=:vol, numero_siege=:siege  WHERE id=:id");
        $query->execute(['nom'=>$nom,
                        'date_dep'=>$date_de,
                         'lieu_d'=>$lieu_dep,
                         'lieu_arr'=>$lieu_arr,
                         'vol'=>$vol,
                         'siege'=>$siege,
                         'id'=>$id
    ]);
    }
    catch (PDOException $e){
        $reussit=$e->getMessage();
    }
    if($reussit==NULL)
    {
        $_SESSION['success'] = "vos données on été mis a jour ";
        header('location: ../pages/billet.php');
    }
    else
    {
        $_SESSION['status'] = "échec de mise à jours de données";
        header('location: ../pages/billet.php'); //pour renvoyer a la page vols
    }   

}


// suppression dune entite dans la base de donnée
if(isset($_POST['delete_id']))
{
    $reussit=null;
    try{
        $id = $_POST['delete_id'];
    $query=$pdo->prepare("DELETE FROM billet WHERE id=:id");
    $query->execute(['id'=>$id]);
    }
    catch (PDOException $e){
        $reussit = $e->getMessage();
    }
    if($reussit==NULL){
        $_SESSION['success']="Vos Données on été supprimé";
        header('location: ../pages/billet.php');
    }
    else{
        $_SESSION['status']="Erreur Données non supprimé";
        header('location: ../pages/billet.php');
    }
    
}



$From = $_POST['emaildest'];
$to = $_POST['emailsource'];
$sujet = $_POST['objet'];
$message = $_POST['message'];



// envoie email
if(isset($_POST['envoyerMes']))
{

    $From = $_POST['emaildest'];
    $to = $_POST['emailsource'];
    $sujet = $_POST['objet'];
    $message = $_POST['message'];


    $header = [
        "From" => "mboleprojet@esprit.tn",
        "Reply-To" => "mboleprojet@esprit.tn",
        "Content-Type" => "text/html ; charset=utf-8"
    ];
  
    $message = wordwrap($message,70,"\r\n");
    mail($to,$sujet,$message,$header);
    $_SESSION['success']="Votre message a bien on été envoyé";
        header('location: ../pages/billet.php');
    
}

//deconnexion 


 
