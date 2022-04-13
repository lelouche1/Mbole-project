<?php
//require 'conexion.php';


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

<?php
class Utilisateur{
    private int $id_recla;
    private string $nom_user;
    private string $age_user;
    private string $email_user;
    private string $cat_user;


    public function __construct(string $nom_user,string $age_user, $email_user, $cat_user){
        $this->nom_user = $nom_user;
        $this->age_user = date('y-m-d');
        $this->email_user = $email_user;
        $this->cat_user = $cat_user;
    }




    public function get_nom_user() :string{
        return $this->nom_user;
    }

    public function get_age_user() :string{
        return $this->date;
    }

    public function get_email_user() :string{
        return $this->email_user;
    }

    public function set_nom_user(int $nom):void{
        $this->nom_user = $nom;
    }

    public function set_email(string $email):void{
        $this->email_user = $email;
    }

    public function set_date(string $age):void{
        $this->age_user = $age;
    }

    public function set_text(string $cat):void{
        $this->cat_user = $cat;
    }


    function ajouter_utilisateur(PDO $pdo){

        $reussit = null;
        try{
            $query=$pdo->prepare('INSERT INTO utilisateur(nom, age, email_user, cathegorie)
                                    VALUE(:nom , :age, :email, :cat)'); 
     
             $query->execute(['nom'=>$this->nom_user,
                        'age'=>$this->age_user,
                        'email'=>$this->email_user,
                        'cat'=>$this->cat_user]);
        }
        catch (PDOException $e) {
            $reussit= $e->getMessage();
        }
    
         return $reussit;     
    }

    function recherchel_utilisateur($valeur , $tab){
        $query = "SELECT * FROM sujet WHERE ";
    } 
    
}



class  Admin extends Utilisateur{

   
     
}


class Client extends Utilisateur{

   
}
?>