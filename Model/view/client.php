<?php
session_start();

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
<?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white">' . $_SESSION['success'] . '</h2>';     //affichage message en cas de reussite
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';     //affichage message en cas de reussite
                unset($_SESSION['status']);
            }

            ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
              <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
              <h5 class="card-title text-center mb-5 fw-light fs-5">Enregistrement</h5>
    
              <form action="../controller/code_client.php" method="POST" enctype="multipart/form-data">
  
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="nomc" placeholder="nom utilisateur"  require>
                  <label >Nom</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="profc" placeholder="name@example.com" name="profc"  require>
                    <label >Profession</label>
                  </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="emailc" placeholder="nom@xyz.com" name="emailc">
                  <label >Email </label>
                </div>
 
                <div class="form-floating mb-3">
                    <input type="file" name="imagec" class="form-control">
                    <label >Ajouter une image</label>
                </div>
                <hr>
  
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="Passwordc" name="passwordc" placeholder="mot de passe" >
                  <label >mot de passe</label>
                </div>
  
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="PasswordConfirmc" name="confpasswordc" placeholder="Confirmer mot de passe" >
                  <label >Confirmer mot de Passe</label>
                </div>
  
                <div class="d-grid mb-2">
                  <button type="submit" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" name="enregistreclient">Valider</button>
                </div>
  
                <a class="d-block text-center mt-2 small" href="#">Vous avez déja un compte? Connectez vous ici</a> 
  
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

</body>
</html>