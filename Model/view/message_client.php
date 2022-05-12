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
    <title>Document</title>
</head>

<body>


<!-- Button trigger modal -->
<div class="container emp-profile bg-danger text-white">
    <h1>Client Premium Mbolé</h1>
    <div class="warming"><h2>Vos Messages <button class="btn btn-warning"><h2><?= $row['nom_client'] ?></h2></button></h2></div>
    </div>

    <div class="container emp-profile">

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
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br />
                            <a href="">Bootsnipp Profile</a><br />
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br />
                            <a href="">Web Developer</a><br />
                            <a href="">WordPress</a><br />
                            <a href="">WooCommerce</a><br />
                            <a href="">PHP, .Net</a><br />
                        </div>
                    </div>
                    <div class="col-md-8">
                       <div>
                       <form action="../controller/code_client.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"><h5>Expediteur:</h5> </label>
                                <input type="email" name="emailsource" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email expediteur...">
                            </div>

                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><h5>destinateur:</h5> </label>
                                <input type="email" name="emaildest" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email destinataire...">
                            </div>
                            

                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><h5>Objet</h5> </label>
                                <input type="text" name="objet" class="form-control"  placeholder="Saisir objet...">
                            </div>

                            <div class="">
                            <label for="floatingTextarea"><h5>message</h5></label>
                            <textarea class="form-control" placeholder="Votre message..." name="message" style="height: 150px"></textarea>
                            
                            </div>

                            <button type="submit" class="btn btn-dark" name="envoyerMes" >Envoyer</button>
                            </form>

                       </div>
                    </div>
                </div>
    </div>


</body>

</html>