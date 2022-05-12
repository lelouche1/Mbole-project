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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!------ Include the above in your HEAD tag ---------->
    <title>profil utilisateur</title>
</head>
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

<body>


<div>
        <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
            echo '<h2 class="text-center top-space text-primary ">' . $_SESSION['success'] . '</h2>';     //affichage message en cas de reussite
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            echo '<h2 class="text-center top-space text-danger ">' . $_SESSION['status'] . '</h2>';     //affichage message en cas de reussite
            unset($_SESSION['status']);
        }
        ?>

<!-- Button trigger modal -->
<div class="container emp-profile bg-danger text-white">
    <br>
    <h1> Espace Premium Mbolé</h1>
    <div class="warming"><h2>Bienvenue   <button class="btn btn-warning"><h2><?= $row['nom_client'] ?> </h2></button></h2></div>
    </div>

    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <?php echo '<img src="../upload/' . $row['image'] . '" width="100px;" height="100px;" alt="image">' ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            <?= $row['nom_client'] ?>
                        </h5>
                        <h6>
                            <?= $row['profession'] ?>
                        </h6>
                        <p class="proile-rating"><h4>Points Bonus :  <?= $row['bonus'] ?></h4></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">A propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="graphique.php" role="tab" aria-controls="profile" aria-selected="false">Statistique</a>
                            </li><li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="message_client.php" role="tab" aria-controls="profile" aria-selected="false">Message</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <!------------lancer modal ------------->                 
                        <a class="btn btn-danger" href="editer_client.php">editer profil</a>
                </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>INFOS UTILE</p>
                            <a href=""></a><br />
                            <a href=""></a><br />
                            <a href=""></a>
                            <p>COMPETENCES</p>
                            <a href=""></a><br />
                            <a href=""></a><br />
                            <a href=""></a><br />
                            <a href=""></a><br />
                            <a href=""></a><br />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Identifiant</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['id'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nom</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['nom_client'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Profession</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['profession'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['email'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Cathegorie de client</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Premium</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Experience</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Hourly Rate</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>10$/hr</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Projects</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>230</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>English Level</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Availability</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>6 months</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br />
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>


</body>

</html>