<?php
session_start();
//include 'security.php';
include './includes/header.php';
include './includes/navbar.php';
include 'entete.php'; 
//include '../connexion.php';
?>


<!-- Modal -->
<div class="modal fade" id="adminprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ajouter administrateur de donnée</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <!--   formulaire de saisie des differentes informations -->
      <form action="code.php" method="POST">
          <div class="modal-body">

            <div class="form-group">
                <label>nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" placeholder="entrer votre nom">
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="email" name="email" class="form-control" placeholder="entrer votre email">
            </div>
            <div class="form-group">
                <label>mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="entrer le mot de passe">
            </div>
            <div class="form-group">
                <label>confirmez mot de passe</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="confirmer le mot de passe">
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">quitter</button>
        <button type="submit" class="btn btn-primary" name="enregistrerbtn">enregistrer</button>
      </div>
      </form>
     <div class="modal-body">  
        ...
      </div>
      
    </div>
  </div>
</div>

<div class="container-fluid">
<!-- Button trigger modal -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">profile administrateur
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adminprofile">
    cliquez ici pour vous enregistrer
    </button>
           </h6>
        </div>
        <div class="card-body">

        <?php
        if(isset($_SESSION['success']) && $_SESSION['success'] != '')
        {
            echo '<h2 class="bg-primary text-white">' .$_SESSION['success']. '</h2>';     //affichage message en cas de reussite
            unset($_SESSION['success']);
        }
        if(isset($_SESSION['status']) && $_SESSION['status'] != '')
        {
            echo '<h2 class="bg-danger text-white">' .$_SESSION['status']. '</h2>';     //affichage message en cas de reussite
            unset($_SESSION['status']);
        }

        ?>


                <div class="table-responsive">
                <?php

                try {
                    $query = $pdo->prepare("SELECT * FROM administrateur");
                    $query->execute();
                    $result = $query->fetchAll();
                } catch (PDOException $e) {
                    $erreur = $e->getMessage();
                }

                ?>
                <table class="table table-bordered" id="datatale" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"> ID </th>
                            <th scope="col"> Nom d'utilisateur </th>
                            <th scope="col"> email </th>
                            <th scope="col"> EDITER </th>
                            <th scope="col"> SUPPRIMER </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--   affichage des donnée de votre base de donnée -->
                        <?php foreach ($result as $row) : ?>

                            <tr>
                                <td><?= $row['id'] ?></td>
                                
                                <td><?= $row['nom'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td>
                                    <form action="register_edit_user.php" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-success" name="edit_btn">MODIFIER</button>
                                </td>
                                    </form>
                                <td>
                                    <form action="code.php" method="POST">
                                        <input type="text" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger" name="delete_btn">SUPPRIMER</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include './includes/script.php';
include './includes/footer.php';
?>