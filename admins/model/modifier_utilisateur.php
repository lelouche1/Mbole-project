<?php
include '/xampp/htdocs/mbole/connexion.php';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container-fluid">
    <!-- Data exemple-->
    <div class="card shadow mb-4">
        <div class="card-hearder py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modifier Le Profile</h6>
        </div>

        <div class="card-body">
            <!--   debut -->

            <!--   affichage des donnée a modifier -->
            <?php if (isset($_POST['edit_id'])) : ?>
                <?php $id = $_POST['edit_id']; ?>
                <?php $query = $pdo->prepare("SELECT * FROM utilisateur WHERE id=:id "); ?>
                <?php $query->execute(['id' => $id]); ?>
                <?php $query_run = $query->fetchAll(); ?>

                <?php foreach ($query_run as $row) : ?>

                     <!--   formulaire de saisie pour la modification des informations informations  -->
                    <form action="../control/code_utilisateur.php" method="POST" id="form_edit">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label>nom d'utilisateur</label>
                            <input type="text" name="edit_nom" value="<?php echo $row['nom'] ?>" class="form-control" placeholder="entrer le nom " id="nom_us">
                            <span id="nom_erre"></span>
                        </div>
                        <div class="form-group">
                            <label>date de naissance</label>
                            <input type="date" name="edit_date" value="<?php echo $row['age'] ?>" class="form-control" placeholder="entrer date ">
                            <br>
                        <div>
                            <span id="error_date"></span>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="entrer email " id="mail">
                            <br>
                        <div>
                            <span id="error_email"></span>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>mot de passe</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="entrer le mot de passe " id="mdp">
                            <br>
                        <div>
                            <span id="spanmdp"></span>
                        </div>
                        </div>
                        <a href="../pages/utilisateur.php" class="btn btn-danger"> ANNULER </a>
                        <button type="submit" name="updatebtn" class="btn btn-primary" id="edit_submit"> VALIDER </button>
                    </form>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
     </div>
  </div>
</div>
<?php
include '../includes/footer.php';
?>