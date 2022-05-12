<?php
include '/xampp/htdocs/mbole/connexion.php';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container-fluid">
    <!-- Data exemple-->
    <div class="card shadow mb-4">
        <div class="card-hearder py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modifier Le Billet</h6>
        </div>

        <div class="card-body">
            <!--   debut -->

            <!--   affichage des donnée a modifier -->
            <?php if (isset($_POST['edit_id'])) : ?>
                <?php $id = $_POST['edit_id']; ?>
                <?php $query = $pdo->prepare("SELECT * FROM billet WHERE id=:id "); ?>
                <?php $query->execute(['id' => $id]); ?>
                <?php $query_run = $query->fetchAll(); ?>

                <?php foreach ($query_run as $row) : ?>

                     <!--   formulaire de saisie pour la modification des informations informations  -->
                    <form action="../control/code_billet.php" method="POST" id="form_ed">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label><h5>Nom passagé</h5></label>
                            <input type="text" name="edit_nom" value="<?php echo $row['nom'] ?>" class="form-control" placeholder="entrer le nom ">
                            <span id="nom_erreur"></span>
                        </div>
                        <div class="form-group">
                            <label><h5>Date de départ</h5> </label>
                            <input type="date" name="edit_date" value="<?php echo $row['date_depart'] ?>" class="form-control" placeholder="entrer date départ">
                        </div>
                        <div class="form-group">
                            <label><h5> Pays de depart</h5></label>
                            <input type="text" name="edit_dep" value="<?php echo $row['lieu_depart'] ?>" class="form-control" placeholder="pays de départ ">
                        </div>
                        <div class="form-group">
                            <label><h5>Pays de d'arrivée</h5></label>
                            <input type="text" name="edit_arr" value="<?php echo $row['lieu_arrivee'] ?>" class="form-control" placeholder="entrer le pays d'arrive ">
                        </div>
                        <div class="form-group">
                        <div class="form-group">
                            <label><h5>Vol</h5></label>
                            <input type="text" name="edit_vol" value="<?php echo $row['vol'] ?>" class="form-control" placeholder="entrer le vol ">
                        </div>
                        <div class="form-group">
                            <label><h5>numero de siege</h5></label>
                            <input type="number" name="siege" value="<?php echo $row['numero_siege'] ?>" class="form-control" placeholder="saisir numero de siege ">
                        </div>
                        <a href="vols.php" class="btn btn-danger"> ANNULER </a>
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