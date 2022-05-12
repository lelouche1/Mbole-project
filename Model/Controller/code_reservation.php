<?php
session_start();
$id = $_SESSION['id'];
include '/xampp/htdocs/connexion.php';




if (isset($_POST['but']))
{   
    echo "JE SUIS A CE NIVEAU2";
    if((!empty($_POST['age'])) && (!empty($_POST['aller']))){
       
        if(!empty($_POST['nom']) && !empty($_POST['lieud']) && !empty($_POST['lieua']) && !empty($_POST['classe']))
        { //control de saisie
        $nom = htmlspecialchars($_POST['nom']);
        $aller = htmlspecialchars($_POST['aller']);
        $age= htmlspecialchars($_POST['age']);
        $dated= htmlspecialchars($_POST['date_d']);
        $lieud= htmlspecialchars($_POST['lieud']);
        $lieua= htmlspecialchars($_POST['lieua']);
        $classe= htmlspecialchars($_POST['classe']);
        echo "JE SUIS A CE NIVEAU4";
        $reussit=null;

        $lieud = strtolower($lieud); // on transforme toute les lettres majuscule en minuscule pour éviter les problemes de casse
        $lieua = strtolower($lieua); // on transforme toute les lettres majuscule en minuscule pour éviter les problemes de casse

        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
      
        try {
            echo "JE SUIS A CE NIVEAU5";
            $query = "INSERT INTO reserver (nom,aller,classe,cat_age,relieu_dep,relieu_ar,date_depart) VALUE(:nom, :aller, :classe, :cat_age, :relieu_dep, :relieu_ar, :date_depart)";
        //   $query = "INSERT INTO utilisateur(nom, age, email, password)VALUE(:nom ,:age, :email, :pass)";
            $add = $pdo->prepare($query);
            $add->execute([
            'nom' => $nom,
            'aller' => $aller,
            'classe' => $classe,
            'relieu_dep' => $lieud,
            'relieu_ar' => $lieud,
            'date_depart' => $dated,
            'cat_age' => $age
        ]);
        } catch (PDOException $e) {
            $reussit = $e->getMessage();
        }
        if (empty($reussit)) {
            // On stock l'adresse IP
            $ip = $_SERVER['REMOTE_ADDR']; 
            move_uploaded_file($_FILES["imagec"]["tmp_name"], "../upload/" . $_FILES["imagec"]['name']);
            $_SESSION['success'] = "votre résevation a bien été enregistrer";

            if(isset($id)){     //si la reservation a reussit on verifie si elle est liée a un compte por ajouter le bonus
                $check = $pdo->prepare('SELECT bonus FROM client WHERE id =:id');
                $check->execute(['id' => $id]);
                $bonus = (int)$check->fetch();
                $bonus += 5;
    
                //----------------------------on ajoute le bonus-----------------------------//
                $query = "INSERT INTO client (bonus) VALUE(:bonus) where id=:id";
                //   $query = "INSERT INTO utilisateur(nom, age, email, password)VALUE(:nom ,:age, :email, :pass)";
                $add = $pdo->prepare($query);
                $add->execute([
                    'bonus' => $bonus,
                    'id' => $id
                ]);
            }
            header('location: ../View/affichage_reservation.php');
        } else {
            echo "echec ajour erreur:  $reussit";
            $_SESSION['status'] = "désolé votre reservation n'a pas été prise en compte ".$reussit."";
            header('location: ../View/reserver.php');
        
         }
       
    }  else{
        $_SESSION['status'] = "vous avez laissez des champs vides ";
        header('location: ../View/reserver.php');
    }
    }else
    {
        $_SESSION['status'] = "veuiller cocher toute les options";
        header('location: ../View/reserver.php');
    }

}
?>

