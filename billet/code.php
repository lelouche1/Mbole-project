<?php
include 'security.php';
include '../connexion.php';

// enregistrement dune entite dans la base de donnée
if(isset($_POST['enregistrerbtn']))
{
    $id_client = $_POST['id_client'];
    $nom_client = $_POST['nom_client'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];
    $ville_depart = $_POST['ville_depart'];
    $ville_arrivee = $_POST['ville_ariivee'];



    if($date === $confirmdate) //le mot de passe est confirme on essaie un ajout
    {
        $reussit = null;
        try{
    
        $query = "INSERT INTO billet(id_client,nom_client,date,prix,ville_depart,ville_arrivee,numero_vol )VALUE(:id_client, :nom_client , :date, :prix, :ville_depart, :ville_arrivee, :numero_vol)";
        $add=$pdo->prepare($query); 
        $add->execute(['id_client'=>$id_client,
        'nom_client'=>$nom_client,
        'date'=>$date,
        'prix'=>$prix,
        'ville_depart'=>$ville_depart,
        'ville_arrivee'=>$ville_arrivee,
        'numro_vol'=>$numero_vol,




            ]);
        }
        catch (PDOException $e) {
            $reussit= $e->getMessage();
        }
    
         if(empty($reussit))
         {
            echo "enregistrer";
            $_SESSION['success']="profile billet ajouté";
            header('location: register_user.php');
         }
         else{
            echo "echec ajour erreur:  $reussit";
            $_SESSION['status']="profile non billet enregistré";
            header('location: register_user.php');
         }  
    }
    else
    {
        $_SESSION['status']="profile non ajouté l'id nest pas identiques";
        header('location: register_user.php');
    } 
 
}



// modification dune entite dans la base de donnée
if(isset($_POST['updatebtn']))
{
    $reussit=null;
    $id_client = $_POST['edit_id_client'];
    $nom_client= $_POST['edit_nom_client'];
    $date= $_POST['edit_date'];
    $prix= $_POST['edit_prix'];
    $ville_depart= $_POST['edit_ville_depart'];
    $ville_arrivee= $_POST['edit_ville_arrivee'];
    $numero_vol= $_POST['edit_numero_vol'];




    try{
        $query = $pdo->prepare("UPDATE billet SET id_client=:id_client, nom_client=:nom_client, date=:date, prix=:prix, ville_depart=:ville_depart,villearrivee=:ville_arrivee,numero_vol=:numero_vol WHERE id_client=:id_client");
        $query->execute(['id_client'=>$id_client,
                        'nom_client'=>$nom_client,
                         'date'=>$date,
                         'prix'=>$prix,
                         'ville_depart'=>$ville_depart,
                         'ville_arrivee'=>$ville_arrivee,
                         'numero_vol'=>$numero_vol,


                         
    ]);
    }
    catch (PDOException $e){
        $reussit=$e->getMessage();
    }
    if($reussit==NULL)
    {
        $_SESSION['success'] = "vos données on été mis a jour ";
        header('location: register_user.php');
    }
    else
    {
        $_SESSION['status'] = "échec de mise à jours de données ";
        header('location: register_user.php'); //pour renvoyer a la page register
    }   

}


// suppression dune entite dans la base de donnée
if(isset($_POST['delete_id_client']))
{
    $reussit=null;
    try{
        $id = $_POST['delete_id_client'];
    $query=$pdo->prepare("DELETE FROM billet WHERE id_client=:id_client");
    $query->execute(['id_client'=>$id_client]);
    }
    catch (PDOException $e){
        $reussit = $e->getMessage();
    }
    if($reussit==NULL){
        $_SESSION['success']="Vos Données on été supprimé";
        header('location: register_user.php');
    }
    else{
        $_SESSION['status']="Erreur Données non supprimé";
        header('location: register_user.php');
    }
    
}

// connexion a la page d'accueil 
if(isset($_POST['login-btn']))
{
    $reussit=null;
    try{
    $id_client_login = $_POST['id_client'];
    $nom_client_login = $_POST['nom_client'];
    $sql="SELECT * FROM billet WHERE id_client='".$id_client_login."' AND nom_client='".$nom_client_login."'";
    $query =$pdo->prepare($sql);
    $query->execute();
    $count=$query->rowCount();

    }catch (PDOException $e)
    {
        $reussit = $e->getMessage();
    }
    if(($count == 0))
    {
        $_SESSION['status']= "id_client ou nom_client incorrect";
        header('location: login.php');
    }
    else{
        $_SESSION['nom']=$email_login;
        header('location: register_user.php');
    }
}

//deconnexion 

 
