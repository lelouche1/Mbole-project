<?php
include '../control/security.php';
include '../includes/header.php';
include '/xampp/htdocs/connexion.php';
include '../includes/navbar.php';
?>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="facultatifmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter des informations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../control/code_facultatif.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label" >Nom propre</label>
                        <input type="text" name="facnom" class="form-control" placeholder="entrer le nom" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Poste Occupé</label>
                        <input type="text" name="poste" class="form-control" placeholder="entrer le nom" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">description</label>
                        <input type="text" name="description" class="form-control" placeholder="donnée plus d'information sur vous" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ajouter une image</label>
                        <input type="file" name="facimage" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="enregistrefacul" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--------------------------------->
<div class="container-fluid">
    <!-- Button trigger modal -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Faccultatif
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#facultatifmodal">
                    Ajouter des informations
                </button>
            </h6>
        </div>
        <div class="card-body">
        
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
    <?php
    $erreur=null;
        try {
            $query = $pdo->prepare("SELECT * FROM facultatif");
            $query->execute();
            $result = $query->fetchAll();
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    ?>

            <div class="table-responsive">

                <table class="table table-bordered" id="datatale" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"> ID </th>
                            <th scope="col"> Nom complet </th>
                            <th scope="col"> poste </th>
                            <th scope="col"> description </th>
                            <th scope="col"> image</th>
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
                            <td><?= $row['poste'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td><?php echo '<img src="../upload/'.$row['image'].'" width="100px;" height="100px;" alt="image">' ?></td>
                            <td><a href="#" class="btn btn-success"> EDITER </a></td>
                            <td><a href="#" class="btn btn-danger"> SUPPRIMER </a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
include '../includes/footer.php';
?>