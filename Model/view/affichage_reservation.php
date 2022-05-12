<?php
session_start();

$tab = $_SESSION['reserv'];
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <!--<link rel="stylesheet" href="assets/css/styleaff.css">-->
   <link rel="stylesheet" href="styleres.css">
  
   <title>Document</title>
</head>
<body>
  <header>  
  <nav class="navbar navbar-dark bg-dark navbar-expand-md">
  <div class="container">
    <button class="navbar-toggler d-none" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navcol-1">
      <ul class="nav navbar-nav w-100 justify-content-between">
        <li class="nav-item dropdown"><a class=" nav-link" data-toggle="dropdown" href="index.php">Accueil</a>
        </li>
        <li class="nav-item dropdown"><a class=" nav-link" data-toggle="dropdown" href="vols.php">Vols</a>   </li>
        <li class="nav-item dropdown"><a class=" nav-link" data-toggle="dropdown" href="Reclamation.php">Reclamation</a>   </li>
        <?php if(isset($_SESSION['user'])) : ?>
        <li class="nav-item dropdown active"><a class=" nav-link" data-toggle="dropdown" href="profil.php"><?= $_SESSION['user'] ?></a>   </li>
          <?php else : ?>
        <li class="nav-item dropdown"><a class=" nav-link" data-toggle="dropdown" href="login.php">connexion</a>   </li>
        <?php endif ?>

      </ul>
    </div>
  </div>
  
</nav>
<div class="text-center mt-4">
  <form action="" method="GET">
  <a href="pdf.php" class="btn btn-lg btn-danger">Imprimer</a>
  </form>
  <hr class="my-4">
</header>
<script>
    let meg = document.getElementById('ide');
    alert('votre reservation a bien été effectué');
</script>


<div class="container">

<div class="Signup-head bg-primary text-white text-center">
                    <h1>Merci pour votre confiance</h1>
                </div>
<table class="table">

<th class="table-primary">
<td class="table-primary"><h5>Nom passagé</h5> </td>
<td class="table-primary"><h5>Pays de départ</h5></td>
<td class="table-primary"><h5>Pays d'arrivée</h5> </td>
<td class="table-primary"><h5>Date de départ</h5></td>
<td class="table-primary"><h5>Classe</h5> </td>
<td class="table-primary"><h5>Nombre d'adulte</h5> </td>
<td class="table-primary"><h5>Nombre d'enfents </h5></td>
<td class="table-primary"><h5>Type voyage </h5></td>
</th>
<tr class="table-danger">
<td><h6>#</h6></td>  
<td><h6><?= $tab['nom'] ?></h6></td>  
<td ><h6><?= $tab['relieu_dep'] ?></h6></td>  
<td ><h6><?= $tab['relieu_ar'] ?></h6></td>  
<td ><h6><?= $tab['date_depart'] ?></h6></td>  
<td ><h6><?= $tab['classe'] ?></h6></td>  
<td ><h6><?= $tab['adulte'] ?></h6></td>  
<td ><h6><?= $tab['enfant'] ?></h6></td>  
<td ><h6><?= $tab['aller'] ?></h6></td>  
</tr >

</table>
</div>


<script src="assets/js/navbar.js"></script>
</body>
</html>