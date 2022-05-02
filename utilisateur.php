=<?php
//require 'conexion.php';
function ajouter_utilisateur(string $nom , $age,string $email,string $cathe, PDO $pdo){

    $reussit = null;
    try{
        $query=$pdo->prepare('INSERT INTO utilisateur(nom, age, email_user, cathegorie)
                                VALUE(:nom , :age, :email, :cat)'); 
 
         $query->execute(['nom'=>$nom,
                    'age'=>$age,
                    'email'=>$email,
                    'cat'=>$cathe]);
    }
    catch (PDOException $e) {
        $reussit= $e->getMessage();
    }

     return $reussit;     
}

function recherchel_utilisateur($valeur , $tab){
    $query = "SELECT * FROM sujet WHERE ";
} 

function afficher_utilisateur( PDO $pdo){
    $query = "SELECT * FROM sujet WHERE ";
$params = [];
$query = "SELECT * FROM utilisateur";
$etat = $pdo->prepare($query);
$etat->execute($params);
$produits = $etat->fetchAll();
return $produits;
}

function supprimer_utilisateur($valeur , $tab){
    $query = "SELECT * FROM sujet WHERE ";
} 

?>