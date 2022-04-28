<?php
session_start();
//include 'security.php';
include '/xampp/htdocs/connexion.php';

// enregistrement dune entite dans la base de donnée
if(isset($_POST['enregistrerbtn']))
{
    $compagnie = $_POST['compagnie'];
    $date_d = $_POST['date_d'];
    $pays_d=$_POST['pays_d'];
    $pays_a=$_POST['pays_a'];
    $prix = $_POST['prix'];

        $reussit = null;
        try{
    
        $query = "INSERT INTO vols(compagnie, date_depart , lieu_depart ,lieu_arrivee, prix)VALUE(:compagnie ,:date_depart, :lieu_depart, :lieu_arrivee, :prix)";
        $add=$pdo->prepare($query); 
        $add->execute(['compagnie'=>$compagnie,
        'date_depart'=>$date_d,
        'lieu_depart'=>$pays_d,
        'lieu_arrivee'=>$pays_a,
        'prix'=>$prix,
            ]);
        }
        catch (PDOException $e) {
            $reussit= $e->getMessage();
        }
    
         if(empty($reussit))
         {
            echo "enregistrer";
            $_SESSION['success']="Vol ajouté";
            header('location: ../pages/vols.php');
         }
         else{
            echo "echec ajour erreur:  $reussit";
            $_SESSION['status']="Vol non enregistré";
            header('location: ../pages/vols.php');
         }  
 
 
}



// modification dune entite dans la base de donnée
if(isset($_POST['updatebtn']))
{
    $reussit=null;
    $id = $_POST['edit_id'];
    $comp = $_POST['edit_com'];
    $date_de=$_POST['edit_date'];
    $lieu_dep= $_POST['edit_dep'];
    $lieu_arr= $_POST['edit_arr'];
    $prix= $_POST['prix'];

    try{
        $query = $pdo->prepare("UPDATE vols SET compagnie=:comp , date_depart=:date_dep , lieu_depart=:lieu_d, lieu_arrivee=:lieu_arr, prix=:prix WHERE id_vol=:id");
        $query->execute(['comp'=>$comp,
                        'date_dep'=>$date_de,
                         'lieu_d'=>$lieu_dep,
                         'lieu_arr'=>$lieu_arr,
                         'prix'=>$prix,
                         'id'=>$id
    ]);
    }
    catch (PDOException $e){
        $reussit=$e->getMessage();
    }
    if($reussit==NULL)
    {
        $_SESSION['success'] = "vos données on été mis a jour ";
        header('location: ../pages/vols.php');
    }
    else
    {
        $_SESSION['status'] = "échec de mise à jours de données $reussit $id $comp  $date_de  $lieu_dep $lieu_arr $prix";
        header('location: ../pages/vols.php'); //pour renvoyer a la page vols
    }   

}


// suppression dune entite dans la base de donnée
if(isset($_POST['delete_id']))
{
    $reussit=null;
    try{
        $id = $_POST['delete_id'];
    $query=$pdo->prepare("DELETE FROM vols WHERE id_vol=:id");
    $query->execute(['id'=>$id]);
    }
    catch (PDOException $e){
        $reussit = $e->getMessage();
    }
    if($reussit==NULL){
        $_SESSION['success']="Vos Données on été supprimé";
        header('location: ../pages/vols.php');
    }
    else{
        $_SESSION['status']="Erreur Données non supprimé";
        header('location: ../pages/vols.php');
    }
    
}

// connexion a la page d'accueil 
if(isset($_POST['login-btn']))
{
    $reussit=null;
    try{
    $nom_login = $_POST['nom'];
    $password_login = $_POST['password'];
    $sql="SELECT * FROM administrateur WHERE nom='".$nom_login."' AND password='".$password_login."'";
    $query =$pdo->prepare($sql);
    $query->execute();
    $count=$query->rowCount();

    }catch (PDOException $e)
    {
        $reussit = $e->getMessage();
    }
    if(($count == 0))
    {
        $_SESSION['status']= "Nom tilisateur ou Mot de passe incorrect";
        header('location: /material/pages/login.php');
    }
    else{
        $_SESSION['nom']=$nom_login;
        header('location: /material/utilisateur.php');
    }
}

//deconnexion 


 
