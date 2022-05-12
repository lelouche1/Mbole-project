<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php';
?>

<?php

if (isset($_POST['but'])) {

    //control de saisie
    $nom = htmlspecialchars($_POST['nom']);
    $aller = htmlspecialchars($_POST['aller']);
    $adulte = htmlspecialchars($_POST['adulte']);
    $enfant = htmlspecialchars($_POST['enfant']);
    $dated = htmlspecialchars($_POST['date_d']);
    $lieud = htmlspecialchars($_POST['lieud']);
    $lieua = htmlspecialchars($_POST['lieua']);
    $classe = htmlspecialchars($_POST['classe']);

    $reussit = null;

    try {
        $query = "INSERT INTO reserver (nom,aller,classe,adulte, enfant,relieu_depart,relieu_ar,date_depart) VALUE(:nom, :aller, :classe, :adulte, :enfant, :relieu_dep, :relieu_ar, :date_depart)";
        //   $query = "INSERT INTO utilisateur(nom, age, email, password)VALUE(:nom ,:age, :email, :pass)";
        $add = $pdo->prepare($query);
        $add->execute([
            'nom' => $nom,
            'aller' => $aller,
            'classe' => $classe,
            'relieu_dep' => $lieud,
            'relieu_ar' => $lieud,
            'date_depart' => $dated,
            'adulte' => $adulte,
            'enfant' => $enfant

        ]);
    } catch (PDOException $e) {
        $reussit = $e->getMessage();
    }
    if (empty($reussit)) {
        $_SESSION['reserv'] = [
            'nom' => $nom,
            'aller' => $aller,
            'classe' => $classe,
            'relieu_dep' => $lieud,
            'relieu_ar' => $lieud,
            'date_depart' => $dated,
            'adulte' => $adulte,
            'enfant' => $enfant
        ];
        echo "echec ajour erreur: $reussit";
        
        $_SESSION['success'] = "votre résevation a bien été enregistrer";
        //----------------------------------------------------------------------
        if(isset($_SESSION['idc'])){     //si la reservation a reussit on verifie si elle est liée a un compte por ajouter le bonus
            $id=$_SESSION['idc'];
            $check = $pdo->prepare('SELECT * FROM client WHERE id =:id');
            $check->execute(['id' => $id]);
            $bonu = $check->fetch();
            $bonus = (int)$bonu['bonus'];
            $bonus = $bonus+5;

            //----------------------------on ajoute le bonus-----------------------------//            

            $query = $pdo->prepare("UPDATE client SET bonus=:bonus WHERE id=:id");
            $query->execute(['bonus'=>$bonus,
                             'id'=>$id
        ]);
    }

        //-----------------------------------------------------------------------------
       
        header('location: ../View/affichage_reservation.php');
    }//---------------------------------------------------------------------- 
    else {
        echo "echec ajour erreur:  $reussit";
        $_SESSION['status'] = "erreur sur le remplissage du ticket reservation non effectuer " . $reussit . "";
        header('location: ../View/vol.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styleres.css">
    <title>reservation billet d'avions</title>
     <link rel="stylesheet" href="styleres.css">
    <!--BOOTSTRAP LINK-->
</head>

<body>
<header>
<div class="container mt-5" id="navprof">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Accueil</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="vols.php">Vols</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="reclamation.php">Reclamation</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
</header>
<br>
<?php if(isset($user)): ?>
<div>   
    <button type="button" class="btn btn-info" name="but"><h4><?= $user ?></h4></button>
</div>
<?php endif; ?>
<?php if(isset($_SESSION['idc'])) : ?>
   <?php $id=$_SESSION['idc']; ?>
<h1> <?php echo "voici l'id "."$id"; ?> </h1>
<?php endif ?>
    <!-------------------------------------------------->
    <div class="container text-center">
        <div class="btn btn-primary">
        <?php if(isset($_SESSION['user'])) : ?>
             <h4><?=$_SESSION['user']; ?> </h4> 
        <?php endif ?>
    

        </div>
        <div >
          
                <div class="Signup-head">
                    <h1>Reserve votre Ticket</h1>
              
            </div>
        </div>
        </div>
            <div class="container">
            <form action="" method="post" id="form_bill">
                <button type="submit " class="btn btn-danger" name="but">valider le tiket</button>
                <br> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="aller" id="inlineRadio1" value="Allez-simple" require>
                    <label class="form-check-label" for="inlineRadio1">Allez-simple</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="aller" id="inlineRadio2" value="Aller-retour">
                    <label class="form-check-label" for="inlineRadio2">Aller-retour</label>
                </div>


                 <div class="row g-2">
                    <div class="col-6">
                        <label for="">
                            <h5> Nom </h5>
                        </label>
                        <div class="p-3 border bg-light">
                            <input type="text" class="form-control" placeholder="nom complet" name="nom" id="nom_voy">
                        </div>
                        <div>
                            <span id="error_voy"></span>
                        </div>
                    </div>
                

                    <?php if (isset($_POST['edit_id'])) : ?>
                        <?php $id = $_POST['edit_id']; ?>
                        <?php $_SESSION['id'] = $id ?>
                        <?php $query = $pdo->prepare("SELECT * FROM vols WHERE id_vol=:id "); ?>
                        <?php $query->execute(['id' => $id]); ?>
                        <?php $query_run = $query->fetchAll(); ?>
                        <?php foreach ($query_run as $row) : ?>

                 <div class="col-6">-
                     <label for="">
                        <h5> Date de départ </h5>
                    </label>
                    <div class="p-3 border bg-light">
                        <input type="text" class="form-control" value="<?php echo $row['date_depart'] ?>" name="date_d">
                     </div>
                 </div>
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <label for="">
                            <h5> Pays de départ </h5>
                        </label>
                        <div class="p-3 border bg-light">
                            <input type="text" class="form-control" value="<?php echo $row['lieu_depart'] ?>" name="lieud">
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="">
                            <h5> Pays d'arrivée </h5>
                        </label>
                        <div class="p-3 border bg-light">
                            <input type="text" class="form-control" value="<?php echo $row['lieu_arrivee'] ?>" name="lieua">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <!----------------------------->
        <br>
        <h5>Nombre de personnes</h5>
        <div class="form-check form-check-inline">
            <input class="form-control" type="number" name="adulte" id="nbplaceb" required>
            <label class="form-check-label" for="inlineRadio1">
                <h5>Adulte</h5>
            </label>
            <div>
            <span id="error_placeb"></span>
            </div>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-control" type="number" name="enfant" id="nbplace" required>
            <label class="form-check-label" for="inlineRadio2">
                <h5>Enfant</h5>
            </label>
            <div>
            <span id="error_place"></span>
            </div>
        </div>
        <br><br>


        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Choisir la classe</label>
            </div>
            <select class="custom-select" name="classe">
                <option value="Classe affaire">Classe affaire</option>
                <option value="Premiere Classe">Premiere Classe</option>
                <option value="Deuxieme classe">Deuxieme classe</option>
                <option value="Classe économie">Classe économie</option>
                <option value="General">General</option>
            </select>
        </div>

            </form>
        </div>
        <!-------------------------------------------------->
    </div>
    <script src="assets/js/control_billet.js"></script>
</body>

</html>