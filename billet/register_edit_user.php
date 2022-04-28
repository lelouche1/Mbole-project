<?php
include 'security.php';
include './includes/header.php';
include './includes/navbar.php';
include 'entete.php';
//include '../connexion.php';
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
                <?php $query = $pdo->prepare("SELECT * FROM administrateur WHERE id=:id "); ?>
                <?php $query->execute(['id' => $id]); ?>
                <?php $query_run = $query->fetchAll(); ?>

                <?php foreach ($query_run as $row) : ?>

                     <!--   formulaire de saisie pour la modification des informations informations  -->
                    <form action="code.php" method="POST">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label>nom d'utilisateur</label>
                            <input type="text" name="edit_nom" value="<?php echo $row['nom'] ?>" class="form-control" placeholder="entrer le nom ">
                        </div>
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="entrer email ">
                        </div>
                        <div class="form-group">
                            <label>mot de passe</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="entrer le nom ">
                        </div>
                        <a href="register.php" class="btn btn-danger"> ANNULER </a>
                        <button type="submit" name="updatebtn" class="btn btn-primary"> VALIDER </button>
                    </form>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
     </div>
  </div>
</div>
<?php
include './includes/script.php';
include './includes/footer.php';
?>