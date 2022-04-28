<?php
include 'security.php';
include '/xampp/htdocs/connexion.php';

// enregistrement dune entite dans la base de donnée
if(isset($_POST['enregistrerbtn']))
{
    $username = $_POST['nom_utilisateur'];
    $email = $_POST['email_utilisateur'];
    $age=$_POST['age_utilisateur'];
    $password = $_POST['mdp_utilisateur'];
    $confirmpassword = $_POST['confirme_mdp'];


    if($password === $confirmpassword) //le mot de passe est confirme on essaie un ajout
    {
        $reussit = null;
        try{
    
        $query = "INSERT INTO utilisateur(nom, age, email, password)VALUE(:nom ,:age, :email, :pass)";
        $add=$pdo->prepare($query); 
        $add->execute(['nom'=>$username,
        'age'=>$age,
        'email'=>$email,
        'pass'=>$password,
            ]);
        }
        catch (PDOException $e) {
            $reussit= $e->getMessage();
        }
    
         if(empty($reussit))
         {
            echo "enregistrer";
            $_SESSION['success']="profile admin ajouté";
            header('location: ../pages/utilisateur.php');
         }
         else{
            echo "echec ajour erreur:  $reussit";
            $_SESSION['status']="profile non admin enregistré";
            header('location: ../pages/utilisateur.php');
         }  
    }
    else
    {
        $_SESSION['status']="profile non ajouté les mots de passes saisies ne sont pas identiques";
        header('location: ../pages/utilisateur.php');
    } 
 
}



// modification dune entite dans la base de donnée
if(isset($_POST['updatebtn']))
{
    $reussit=null;
    $id = $_POST['edit_id'];
    $age=$_POST['edit_date'];
    $nom= $_POST['edit_nom'];
    $email= $_POST['edit_email'];
    $password= $_POST['edit_password'];

    try{
        $query = $pdo->prepare("UPDATE utilisateur SET nom=:nom , age=:age ,  email=:email, password=:password WHERE id=:id");
        $query->execute(['nom'=>$nom,
                        'age'=>$age,
                         'email'=>$email,
                         'password'=>$password,
                         'id'=>$id
    ]);
    }
    catch (PDOException $e){
        $reussit=$e->getMessage();
    }
    if($reussit==NULL)
    {
        $_SESSION['success'] = "vos données on été mis a jour ";
        header('location: ../pages/utilisateur.php');
    }
    else
    {
        $_SESSION['status'] = "échec de mise à jours de données $reussit";
        header('location: ../pages/utilisateur.php'); //pour renvoyer a la page register
    }   

}


// suppression dune entite dans la base de donnée
if(isset($_POST['delete_id']))
{
    $reussit=null;
    try{
        $id = $_POST['delete_id'];
    $query=$pdo->prepare("DELETE FROM utilisateur WHERE id=:id");
    $query->execute(['id'=>$id]);
    }
    catch (PDOException $e){
        $reussit = $e->getMessage();
    }
    if($reussit==NULL){
        $_SESSION['success']="Vos Données on été supprimé";
        header('location: ../pages/utilisateur.php');
    }
    else{
        $_SESSION['status']="Erreur Données non supprimé $reussit";
        header('location: ../pages/utilisateur.php');
    }
    
}

// connexion a la page d'accueil 
if(isset($_POST['login-btn']))
{
    $reussit=null;
    try{
    $nom_login = $_POST['nom'];
    $password_login = $_POST['password'];
    $sql="SELECT * FROM utilisateur WHERE nom='".$nom_login."' AND password='".$password_login."'";
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
        header('location: ../pages/login.php');
    }
    else{
        $_SESSION['nom']=$nom_login;
        header('location: ../pages/utilisateur.php');
    }
}

//deconnexion 

 
