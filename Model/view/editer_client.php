<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php'; // ajout connexion bdd 
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

// On récupere les données de l'utilisateur
try {
    $req = $pdo->prepare('SELECT * FROM client WHERE nom_client = ?');
    $req->execute(array($_SESSION['user']));
    $row = $req->fetch();
} catch (PDOException $e) {
    $erreur = $e->getMessage();
    echo $erreur;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/enregistrerstyle.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
    <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="text center text-primary">' . $_SESSION['success'] . '</h2>';     //affichage message en cas de reussite
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="text-danger text-center">' . $_SESSION['status'] . '</h2>';     //affichage message en cas de reussite
                unset($_SESSION['status']);
            }

            ?>
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
              <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
              <h5 class="card-title text-center mb-5 fw-light fs-5">Modification</h5>
    
              <form action="../controller/code_client.php" method="POST" enctype="multipart/form-data">
              
              <input type="hidden" name="editer_id" value="<?php echo $row['id'] ?>">

                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="enomc" value="<?php echo $row['nom_client'] ?>">
                  <label >Nom</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="<?php echo $row['profession'] ?>" name="eprofc" >
                    <label >Profession</label>
                  </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" value="<?php echo $row['email'] ?>" name="eemailc" required>
                  <label >Email </label>
                </div>
 
                <div class="form-floating mb-3">
                    <input type="file" name="imagec" value="<?php echo '<img src="../upload/'.$row['image'].'" width="100px;" height="100px;" alt="image">' ?>" class="form-control">        
                    <label >Ajouter une image</label>
                    <input type="file" name="efacimage" class="form-control" >
                </div>
                <hr>
  
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="Passwordc" name="epasswordc" placeholder="mot de passe" >
                  <label >mot de passe</label>
          </div>
  
                <div class="d-grid mb-2">
                  <button type="submit" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="editclient">Valider</button>
                </div>
  
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

</body>
</html>