<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<form action="../control/code_billet.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"><h5>From:</h5> </label>
    <input type="email" name="emailsource" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email expediteur...">
  </div>

  <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label"><h5>To:</h5> </label>
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


<?php
include '../includes/footer.php';
?>