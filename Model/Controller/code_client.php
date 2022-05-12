
<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php';

echo "hello";
// insertion dans table client
if (isset($_POST['enregistreclient'])){   

    $password = htmlspecialchars($_POST['passwordc']);
    $confirmpassword = htmlspecialchars($_POST['confpasswordc']);


       if($password == $confirmpassword) //le mot de passe est confirme on essaie un ajout
        {
            $nom = htmlspecialchars($_POST['nomc']);
            $email = htmlspecialchars($_POST['emailc']);
            $prof= htmlspecialchars($_POST['profc']);
            $image= $_FILES["imagec"]['name'];
            $reussit=null;
           
             // On vérifie si l'utilisateur existe
            $check = $pdo->prepare('SELECT nom_client, email, password FROM client WHERE email = ?');
            $check->execute(array($email));
            $data = $check->fetch();
            $row = $check->rowCount();

            $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter les problemes de casse

            // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
            if($row == 0){ 
            try {
                $query = "INSERT INTO client (nom_client,email,profession,password,image) VALUE(:nom ,:email,:prof,:pass,:image)";
            //   $query = "INSERT INTO utilisateur(nom, age, email, password)VALUE(:nom ,:age, :email, :pass)";
                $add = $pdo->prepare($query);
                $add->execute([
                'nom' => $nom,
                'email' => $email,
                'prof' => $prof,
                'image' => $image,
                'pass' => $password
            ]);
            } catch (PDOException $e) {
                $reussit = $e->getMessage();
            }
            if (empty($reussit)) {
                // On stock l'adresse IP
                $ip = $_SERVER['REMOTE_ADDR']; 
                move_uploaded_file($_FILES["imagec"]["tmp_name"], "../upload/" . $_FILES["imagec"]['name']);
                $_SESSION['success'] = "informations facultative  ajouté";
                $_SESSION['user'] = $nom;
                header('location: ../View/profil.php');
            } else {
                echo "echec ajour erreur:  $reussit";
                $_SESSION['status'] = "michel ici informations facultative non enregistré ".$reussit."";
                header('location: ../View/client.php');
            }
            }else{
                $_SESSION['status'] = "cet utilisateur existe déja ";
                header('location: ../View/login.php');
            }
    
        }else{
            $_SESSION['status'] = "les deux mot de passe saisie ne sont pas identique ";
            header('location: ../View/login.php');
        }
}




// modification dune entite dans la base de donnée
if(isset($_POST['editclient']))
{
    $reussit=null;
    $id = $_POST['editer_id'];
    $prof=$_POST['eprofc'];
    $nom= $_POST['enomc'];
    $email= $_POST['eemailc'];
    $password= $_POST['epasswordc'];
    $image= $_FILES["efacimage"]['name'];

    try{
        $query = $pdo->prepare("UPDATE client SET nom_client=:nom , profession=:prof ,  email=:email, image=:image, password=:password WHERE id=:id");
        $query->execute(['nom'=>$nom,
                        'prof'=>$prof,
                         'email'=>$email,
                         'password'=>$password,
                         'image'=>$image,
                         'id'=>$id
    ]);
    }
    catch (PDOException $e){
        $reussit=$e->getMessage();
    }
    if($reussit==NULL)
    {   
        $_SESSION['user'] = $nom;
        $ip = $_SERVER['REMOTE_ADDR']; 
        move_uploaded_file($_FILES["efacimage"]["tmp_name"], "../upload/" . $_FILES["efacimage"]['name']);
        $_SESSION['success'] = "informations client  mis a jour";
        header('location: ../View/profil.php');
    }
    else
    {
        $_SESSION['status'] = "échec de mise à jours de données $reussit";
        header('location: ../View/profil.php'); //pour renvoyer a la page register
    }   

}


//---------------connexion --------------------------------------
if((isset($_POST['btn_login']))) // Si il existe les champs email, password et qu'il sont pas vident
{
    
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['logpassword']);
    
    $email = strtolower($email); // email transformé en minuscule
    
    // On regarde si l'utilisateur est inscrit dans la table utilisateurs
    $check = $pdo->prepare('SELECT nom_client, id, email, password FROM client WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();
    

    // Si > à 0 alors l'utilisateur existe
    if($row > 0)
    {
        // Si le mail est bon niveau format
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            // Si le mot de passe est le bon
            if(($password == $data['password']))
            {
                // On créer la session et on redirige sur landing.php
                $_SESSION['idc']= $data['id'];
                $_SESSION['user'] = $data['nom_client'];
                $_SESSION['email_user']= $data['email'];
                header('Location: ../View/profil.php');
            }else{
                $_SESSION['status'] = "mot de passe inccorect ";
                header('Location: ../View/login.php'); die(); }
        }else{ 
            $_SESSION['status'] = "email non valide ";
            header('Location: ../View/login.php'); die(); }
    }else{ 
        $_SESSION['status'] = "ce compte n'existe pas ";
        header('Location: ../View/login.php'); die(); }
}


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
        header('location: ../View/profil.php');
    
}

?>