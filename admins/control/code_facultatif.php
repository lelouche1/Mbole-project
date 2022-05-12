
<?php
session_start();
include '/xampp/htdocs/connexion.php';

if(isset($_POST['enregistrefacul']))
{
    
    $nom = $_POST['facnom'];
    $poste = $_POST['poste'];
    $description = $_POST['description'];
    $image= $_FILES["facimage"]['name'];
    $reussit=null;
    
  /*  if (file_exists("/xampp/htdocs/mat/upload/".$_FILES["facimage"]["nom"])) {
        $store = $_FILES["facimage"]['nom'];
        $_SESSION['status'] = "c'est image existe déja. '.$store.' '.$nom.'";
        header('location: ../pages/facultatif.php');
    } 
    else { */
        try {
            $query = "INSERT INTO facultatif (nom,poste,description,image) VALUE(:nom ,:poste,:descript,:image)";
         //   $query = "INSERT INTO utilisateur(nom, age, email, password)VALUE(:nom ,:age, :email, :pass)";
            $add = $pdo->prepare($query);
            $add->execute([
                'nom' => $nom,
                'poste' => $poste,
                'descript' => $description,
                'image' => $image
            ]);
        } catch (PDOException $e) {
            $reussit = $e->getMessage();
        }
        if (empty($reussit)) {
            move_uploaded_file($_FILES["facimage"]["tmp_name"], "../upload/" . $_FILES["facimage"]['name']);
            $_SESSION['success'] = "informations facultative  ajouté";
            header('location: ../pages/facultatif.php');
        } else {
            echo "echec ajour erreur:  $reussit";
            $_SESSION['status'] = "informations facultative non enregistré ".$reussit."";
            header('location: ../pages/facultatif.php');
        }
   // }
}


?>